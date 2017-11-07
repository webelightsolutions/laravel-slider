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
use Webelightdev\LaravelSlider\Helpers\EloquentHelpers;
use Webelightdev\LaravelSlider\Helpers\IOHelpers;

class SliderController extends Controller
{

    protected $slider;
    
    protected $sliderImage;


    public function __construct(Slider $slider, SliderImage $sliderImage)
    {
        $this->slider = $slider;
        $this->sliderImage = $sliderImage;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = $this->slider->orderBy('id', 'desc')->with('slides')->get();
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
        $resultFiles = moveAllFiles($sliderImages, $oldPath, $targetPath, $sliderName);

        $path = $data['name'].'/';
        try {
            $newSlider = $this->slider->create($data);
        } catch (Exception $e) {
            return redirect('laravel-slider::create')->with('error', $e->getMessage())->withInput();
        }
        $date = $request->image_name;

        foreach ($data['slides'] as $slide) {
            $slide['slider_id'] = $newSlider->id;
            try {
                $this->sliderImage->create($slide);
            } catch (Exception $e) {
                return redirect('laravel-slider::create')->with('error', $e->getMessage())->withInput();
            }
        }

        return redirect('slider')->with('success', 'Slider saved successfully');
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

        $slider = $this->slider->where('id', $id)->where('is_active', 1)->first();
        if ($slider) {
            $slides = \DB::select("
            SELECT * from slider_images 
            where is_active = 1 AND slider_id = ? AND ? BETWEEN DATE_FORMAT(start_date, '%Y-%m-%d') AND DATE_FORMAT(end_date, '%Y-%m-%d')", [$slider->id, $currentFormatedDate]);
            return view('laravel-slider::show', compact('slides', 'slider'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = $this->slider->where('id', $id)->with('slides')->first();
        return view('laravel-slider::edit', compact('slider'));
    }

    public function preview(Request $request)
    {
        $selectedFiles = $request->all();
        $folderName = 'sliders';
        $path = 'temp/'.$folderName. '/';

        foreach ($selectedFiles as $file) {
            $images[] = uploadFile($path, $file, 'public');
        }
        return view('laravel-slider::preview', compact('selectedFiles', 'folderName', 'images'));
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
        $result = [];
        $slider = $this->slider->where('id', $id)->first();
        
        if (!$slider) {
            $result['error'] = 'Slider details does not exists.';
            return $result;
        }

        $data = $request->all();
        $data = $request->except(['_token', '_method']);

        if ($slider) {
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
        $existingSlidesIds = $this->sliderImage->where('slider_id', $id)->pluck('id')->all();

        //get Difference between input and existing slides id
        $toBeDeletedSlidesIds = array_diff($existingSlidesIds, $inputSlidesIds);

        // Delete those slides which are found in the above difference
        $this->sliderImage->where('slider_id', $id)->whereIn('id', $toBeDeletedSlidesIds)->delete();
        
        foreach ($data['oldSlides'] as $slide) {
            $slides = $this->sliderImage->where('slider_id', $id)->where('id', $slide['id'])->first();
            if ($slides) {
                $slides->fill($slide);
                try {
                    $slides->save();
                } catch (QueryException $e) {
                    return redirect('laravel-slider::edit')->with('error', $e->getMessage())->withInput();
                }
            } else {
                try {
                    $this->sliderImage->create($slide);
                } catch (QueryException $e) {
                     return redirect('laravel-slider::index')->with('error', $e->getMessage());
                }
            }
        }

        //New Slide Added druing edit methode
        if (array_has($data, 'slides')) {
            // Get list of file names from request as array [temp storage]
            $sliderImages = $data['image_name'];

            $sliderName = $data['name'];
            // Move SliderImages from temp storage to original storage
            $oldPath ='temp/'.$sliderName.'/';
            $targetPath = 'slide';
            $resultFiles = moveAllFiles($sliderImages, $oldPath, $targetPath, $sliderName);

            foreach ($data['slides'] as $slide) {
                $slide['slider_id'] = $id;
                try {
                    $this->sliderImage->create($slide);
                } catch (Exception $e) {
                    return redirect('laravel-slider::edit')->with('error', $e->getMessage())->withInput();
                }
            }
        }
        return redirect('slider')->with('success', 'Slider details updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $this->slider->findOrFail($id)->delete();
        return redirect('/slider');
    }

    public function formActions($id)
    {

        $status = $this->slider->where('id', $id)->pluck('is_active')->first();
        if ($status == 1) {
            $this->slider->find($id)->update(['is_active' => false]);
            return redirect('/slider');
        } else {
            $this->slider->find($id)->update(['is_active' => true]);
            return redirect('/slider');
        }
    }
}
