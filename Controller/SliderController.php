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
        $path = $data['name'].'/';
        $newSlider = Slider::create($data);
        if ($files = $request->file('image_name')) {
            foreach ($files as $file) {
                $originalName = $file->getClientOriginalName();
                $result = $this->resizeActualImage($originalName, $file, $path);
                $data['image_name'] = $originalName;
                $data['slider_id'] = $newSlider['id'];
                $data['start_date'] = $data['start_date'];
                $data['end_date'] = $data['end_date'];
                SliderImage::create($data);
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
        $slider = Slider::where('id', $id)->first();
        return view('laravel-slider::show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::where('id', $id)->first();
        return view('laravel-slider::edit', compact('slider'));
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
        try {
            Slider::where('id', $id)->update($data);
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
            return redirect('laravel-slider::edit')->with('error', $e->getMessage())->withInput();
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

        $status = Slider::where('id', $id)->pluck('is_active')->first();
        if ($status == 1) {
            Slider::find($id)->update(['is_active' => "0"]);
            return redirect('/slider');
        } else {
            Slider::find($id)->update(['is_active' => "1"]);
            return redirect('/slider');
        }
    }

    function resizeActualImage($originalName, $file, $path)
    {
       $img = Image::make($file)->resize(270, 270, function ($constraint) {
               $constraint->aspectRatio();
           });
           $img->resizeCanvas(300, 300, 'center', false, '#ffffff')->save();

           $directory = Storage::disk('slider')->makeDirectory($path.'original');
           Storage::disk('slider')->put($path.'original'.'/'.$originalName, $img);

           $img = Image::make($file)->resize(150, 150, function ($constraint) {
               $constraint->aspectRatio();
           });
           $img->resizeCanvas(200, 200, 'center', false, '#ffffff')->save();

           $directory = Storage::disk('slider')->makeDirectory($path.'thumbnail');
           Storage::disk('slider')->put($path.'thumbnail'.'/'.$originalName, $img);
    }
}
