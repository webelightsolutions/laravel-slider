<?php

namespace Webelightdev\LaravelSlider\Controller;

use App\Http\Controllers\Controller;
use Webelightdev\LaravelSlider\Requests\StoreSliderRequest;
use Webelightdev\LaravelSlider\Model\Slider;
use Webelightdev\LaravelSlider\Model\SliderImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Illuminate\Database\QueryException;


class SliderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
       $sliders = Slider::orderBy('id', 'desc')->with('slides')->get();
       return view('laravel-slider::index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('laravel-slider::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        // Get list of file names from request as array [temp storage]
        $sliderImages = $data['image_name'];

        $sliderName = $data['name'];
        // Move SliderImages from temp storage to original storage
        $oldPath ='temp/'.$sliderName.'/';
        $targetPath = 'slide';
        $resultFiles = $this->moveAllFiles($sliderImages, $oldPath, $targetPath, $sliderName);

        $path = $data['name'].'/';
        $newSlider = Slider::create($data);
        $date = $request->image_name;

        foreach ($data['slides'] as $slide) {
            $slide['slider_id'] = $newSlider['id'];
            SliderImage::create($slide);
        }

        return redirect('slider')->with('success', 'Slider saved successfully');
    }

    public function moveAllFiles($files, $oldPath, $targetPath, $sliderName)
    {
        $result = [];
        $hasErrorInS3 = false;
        $files = Storage::disk('public')->files('temp/sliders/');
        
        foreach ($files as $file) {
            $directory = Storage::disk('public')->makeDirectory($sliderName);
            Storage::disk('public')
                ->move($file, $sliderName.'/original/'.basename($file));

            /*$img = Image::make($file)->resize(100, 50, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->resizeCanvas(50, 22, 'center', false, '#ffffff')->save();

            Storage::disk('public')
                ->put($sliderName.'/thumbnail/'.basename($file), $img);*/

        }
        $result['success'] = "Files have been moved successfully.";
        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $currentDate = Carbon::now();
        $currentFormatedDate = $currentDate->format("Y-m-d");

        $slider = Slider::where('id', $id)->first();
        $slides = \DB::select("
            SELECT * from slider_images 
            where is_active = 1 AND slider_id = ? AND ? BETWEEN DATE_FORMAT(start_date, '%Y-%m-%d') AND DATE_FORMAT(end_date, '%Y-%m-%d')", [$slider->id, $currentFormatedDate]);
        return view('laravel-slider::show', compact('slides', 'slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::where('id', $id)->with('slides')->first();
        return view('laravel-slider::edit', compact('slider'));
    }

    public function preview(Request $request)
    {
        $selectedFiles = $request->all();
        $folderName = 'sliders';
        $path = 'temp/'.$folderName. '/';
        foreach ($selectedFiles as $file) {
           $images[] = $this->uploadFile($path, $file, 'public');
        }
        return view('laravel-slider::preview', compact('selectedFiles', 'folderName' , 'images'));
    }

    function uploadFile($path, $file, $storageName)
    {
        $result = [];
        $extension = $file->getClientOriginalExtension();
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = $this->cleanString($fileName);
        $fileName = time().'_'.$fileName;
        $finalFileName = $path.$fileName.'.'.$extension;
        Storage::disk($storageName)->put($finalFileName, File::get($file));
        $exists = Storage::disk($storageName)->exists($finalFileName);
        if ($exists) {
            $result['success'] = 'File has been uploaded successfully.';
        } else {
            $result['error'] = 'File upload failed.';
        }
        $result['fileName'] = $fileName.'.'.$extension;
        $result['mime'] = $file->getClientMimeType();
        $result['fileExtension'] = $extension;
        $result['slug'] = str_slug(str_random(10));
        $result['fileLocation'] = $path;
        return $result;
    }

    function cleanString($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data = $request->except(['_token', '_method']);

        $slider = Slider::where('id', $id)->first();
        
        if($slider){
           $slider->fill($data);

           try {
                $slider->save();    
           } catch (QueryException $e) {
                return redirect('laravel-slider::edit')->with('error', $e->getMessage())->withInput();
           }
        } else {
            return redirect('laravel-slider::index')->with('error', $e->getMessage());
        }
        
        //get list of slides id from request
        $inputSlidesIds = collect($data['oldSlides'])->pluck('id')->all();

        //get list of slides from the database for perticular slider
        $existingSlidesIds = SliderImage::where('slider_id',$id)->pluck('id')->all();

        //get Difference between input and existing slides id
        $toBeDeletedSlidesIds = array_diff($existingSlidesIds, $inputSlidesIds);

        // Delete those slides which are found in the above difference
        SliderImage::where('slider_id', $id)->whereIn('id', $toBeDeletedSlidesIds)->delete();
        
        foreach ($data['oldSlides'] as $slide) {
            $slides = SliderImage::where('slider_id', $id)->where('id', $slide['id'])->first();
            if($slides) {
               $slides->fill($slide);
               try {
                    $slides->save();
               } catch (QueryException $e) {
                    return redirect('laravel-slider::edit')->with('error', $e->getMessage())->withInput();
                 }
            } else {
                try {
                    SliderImage::create($slide);
                } catch (QueryException $e) {
                     return redirect('laravel-slider::index')->with('error', $e->getMessage());  
                }

            }
        }

        //New Slide Added druing edit methode
        if(array_has($data, 'slides')) {

            // Get list of file names from request as array [temp storage]
            $sliderImages = $data['image_name'];

            $sliderName = $data['name'];
            // Move SliderImages from temp storage to original storage
            $oldPath ='temp/'.$sliderName.'/';
            $targetPath = 'slide';
            $resultFiles = $this->moveAllFiles($sliderImages, $oldPath, $targetPath, $sliderName);

            foreach ($data['slides'] as $slide) {
             try {
                $slide['slider_id'] = $id;
                SliderImage::create($slide);
             } catch (Exception $e) {
                 return redirect('laravel-slider::edit')->with('error', $e->getMessage())->withInput();
             }
            } 
         }
        return redirect('slider')->with('success', 'Lookup details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Slider::findOrFail($id)->delete();
        return redirect('/slider');
    }

    public function formActions($id)
    {
        $status = SliderImage::where('id', $id)->pluck('is_active')->first();
        if ($status == 1) {
            SliderImage::find($id)->update(['is_active' => "0"]);
            return redirect('/slider');
        } else {
            SliderImage::find($id)->update(['is_active' => "1"]);
            return redirect('/slider');
        }
    }

    function resizeActualImage($originalName, $file, $path)
    {
            $img = Image::make($file);
           $img->save();

           $directory = Storage::disk('slider')->makeDirectory($path.'original');
           Storage::disk('slider')->put($path.'original'.'/'.$originalName, $img);

           $img = Image::make($file)->resize(env('SLIDES_WIDTH'), env('SLIDES_HEIGHT'), function ($constraint) {
               $constraint->aspectRatio();
           });
           $img->resizeCanvas(env('CANVAS_WIDTH'), env('CANVAS_HEIGHT'), 'center', false, '#ffffff')->save();

           $directory = Storage::disk('slider')->makeDirectory($path.'thumbnail');
           Storage::disk('slider')->put($path.'thumbnail'.'/'.$originalName, $img);
    }
}
