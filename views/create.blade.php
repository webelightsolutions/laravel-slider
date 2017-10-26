 @extends('layouts.app') @section('content')
<div class="col-sm-8 col-md-offset-2 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-4 heading color-black">Add Slider</div>
                <div class="col-md-8 text-right">
                    <a href='{{ url("slider") }}' class="btn btn-default color-black">List of Sliders</a>
                </div>
            </div>
        </div>
        <form method="POST" action="/slider" enctype="multipart/form-data" id="multiple_upload_form">
            <div class="panel-body">
                <div class="form-group">
                    <label class="color-black">Slider Name </label>
                    <input type="text" name="name" class="form-control" value="Lravel Slider">
                </div>
                <div class="form-group">
                    <label class="color-black"> Slider Type </label>
                    <select name="slider_type" class="form-control color-black">
                        <option value="banner">Banner</option>
                        <option value="slider">Slider</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class="color-black m-left-16">Start Date</label>
                    <input type="date" name="start_date" class="form-control m-left-16 ">
                </div>
                <div class="form-group col-md-6">
                    <label class="color-black"> End Date</label>
                    <input type="date" name="end_date" class="form-control">
                </div>
                <div class="form-group">
                    <label class="color-black"> Slides Per Page</label>
                    <input type="text" name="slides_per_page" class="form-control">
                </div>
                <div class="form-group">
                    <label class="color-black">Auto play </label>
                    <select class="form-control color-black" name="auto_play">
                        <option value="0">Off</option>
                        <option value="1">On</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="color-black"> Is_Active </label>
                    <br/>
                    <label class="radio-inline color-black">
                        <input type="radio" name="is_active" value="1"> Yes
                    </label>
                    <label class="radio-inline color-black">
                        <input type="radio" name="is_active" value="0"> No
                    </label>
                </div>
                <div class="form-group">
                    <label class="color-black"> Select Slider Images</label>
                    <input type="file" name="image_name[]" class="form-control" id="gallery-photo-add" multiple/>
                    <div class="gallery">
                        <div class="image-action" onclick="removeImage(this)"><a class="btn btn-danger btn-sm"> X </a></div>
                    </div>
                    <script type="text/javascript">

                    $(function() {
                        // Multiple images preview in browser
                        var imagesPreview = function(input, placeToInsertImagePreview) {
                            if (input.files) {
                                var filesAmount = input.files.length;
                                for (i = 0; i < filesAmount; i++) {
                                    var reader = new FileReader();
                                    reader.onload = function(event) {
                                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                                    }
                                    reader.readAsDataURL(input.files[i]);
                                }
                            }

                        };

                        $('#gallery-photo-add').on('change', function() {
                            imagesPreview(this, 'div.gallery');
                        });
                    });

                    function removeImage(id) {

                        $(id).parent().remove();

                    }
                    </script>
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
</div>
@endsection