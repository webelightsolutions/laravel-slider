@extends(Config::get('slider.appFileLocation')) 
@section('content') @component('admin.components.page') @slot('pageHeading')
Slider @endslot @slot('panelHeadingLeft') Edit Slider - {{ $slider->name }} @endslot @slot('panelHeadingRight')
<a href='{{ route("admission.index") }}' class="btn btn-primary btn-sm float-right">List of Slider</a> @endslot @slot('panelContent')
<form method="POST" action="/slider/{{$slider->id}}" enctype="multipart/form-data" id="multiple_upload_form">
    {{ csrf_field() }} {{ method_field('PUT') }}
    <div class="panel-body">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="color-black">Slider Name </label>
                    <input type="text" name="name" class="form-control" id="sliderName" value="{{ $slider->name}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="color-black"> Slider Type </label>
                    <select name="slider_type" class="form-control color-black">
                                <option value="banner">Banner</option>
                                <option value="slider">Slider</option>
                            </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="color-black">Auto play </label>
                    <select class="form-control color-black" name="auto_play">
                                <option value="0">Off</option>
                                <option value="1">On</option>
                            </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="color-black"> Slides Per Page</label>
                    <input type="text" name="slides_per_page" class="form-control" value="{{ $slider->slides_per_page}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="color-black"> Slider Width (%)</label>
                    <input type="text" name="slider_width" class="form-control" value="{{ $slider->slider_width}}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="color-black"> Slider Height (%)</label>
                    <input type="text" name="slider_height" class="form-control" value="{{ $slider->slider_height}}">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="color-black">Images</label>
                    <input type="file" name="image_name[]" class="form-control" id="gallery-photo-add" multiple/>
                </div>
            </div>
            <div class="col-sm-12">
                @foreach($slider['slides'] as $imageKey => $slide)
                <div class="col-sm-3 m-top-15">
                    <img src="{{ asset('storage/'.$slider->name.'/original/'.$slide->image_name)}}" class="img img-thumbnail" name="image_name"
                        style="width: 100%; height: 130px;">
                    <div class="image-action" onclick="removeImage(this)"><a class="btn btn-danger btn-sm"> X </a></div>
                    <input type="hidden" name="oldSlides[{{$imageKey}}][image_name]" value="{{ $slide->image_name }}">
                    <input type="hidden" name="oldSlides[{{$imageKey}}][id]" value="{{ $slide->id }}">
                    <label class="color-black">Start Date</label>
                    <input type="date" name="oldSlides[{{$imageKey}}][start_date]" class="form-control" value="{{ date('Y-m-d', strtotime($slide->start_date)) }}">
                    <label class="color-black">End Date</label>
                    <input type="date" name="oldSlides[{{$imageKey}}][end_date]" class="form-control" value="{{ date('Y-m-d', strtotime($slide->end_date)) }}">
                    <label>Title</label>
                    <input type="text" name="oldSlides[{{$imageKey}}][title]" class="form-control" value="{{ $slide->title }}">
                    <label>Description</label>
                    <input type="text" name="oldSlides[{{$imageKey}}][description]" class="form-control" value="{{ $slide->description }}">
                    <label class="color-black">Is Active</lable>
                                <input type="checkbox" class="form-control" name="oldSlides[{{$imageKey}}][is_active]" value="1" @if ($slide->is_active == 1) checked @endif>
                        </div>
                        @endforeach
                        <div class="row" id="gallery">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    function removeImage(id){
        $(id).parent().remove();
    } 
 </script>
@endslot @endcomponent
@endsection