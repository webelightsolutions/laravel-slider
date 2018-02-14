@extends(Config::get('slider.appFileLocation')) 
@section('content') @component('admin.components.page') @slot('pageHeading')
Slider @endslot @slot('panelHeadingLeft') Create New Slider @endslot @slot('panelHeadingRight')
<a href='{{ route("slider.index") }}' class="btn btn-primary btn-sm float-right">List of Slider</a> @endslot @slot('panelContent')
<form method="POST" action="/slider" enctype="multipart/form-data" id="multiple_upload_form">
    <div class="panel-body">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label class="color-black">Slider Name </label>
                    <input type="text" name="name" class="form-control" id="sliderName">
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
                    <input type="text" name="slides_per_page" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="color-black"> Slider Width (%)</label>
                    <input type="text" name="slider_width" class="form-control">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="color-black"> Slider Height (%)</label>
                    <input type="text" name="slider_height" class="form-control">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="color-black">Images</label>
                    <input type="file" name="image_name[]" class="form-control" id="gallery-photo-add" multiple/>
                </div>
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
@endslot @endcomponent
@endsection