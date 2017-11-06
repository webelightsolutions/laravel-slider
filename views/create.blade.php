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
                    <input type="text" name="name" class="form-control" id="sliderName">
                </div>
                <div class="form-group">
                    <label class="color-black"> Slider Type </label>
                    <select name="slider_type" class="form-control color-black">
                        <option value="banner">Banner</option>
                        <option value="slider">Slider</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="color-black">Auto play </label>
                    <select class="form-control color-black" name="auto_play">
                        <option value="0">Off</option>
                        <option value="1">On</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="color-black"> Slides Per Page</label>
                    <input type="text" name="slides_per_page" class="form-control">
                </div>
                <div class="form-group">
                    <label class="color-black"> Slider Width (%)</label>
                    <input type="text" name="slider_width" class="form-control">
                </div>
                <div class="form-group">
                    <label class="color-black"> Slider Height (%)</label>
                    <input type="text" name="slider_height" class="form-control">
                </div>
                <div class="form-group">
                    <label class="color-black"> Select Slider Images</label>
                    <input type="file" name="image_name[]" class="form-control" id="gallery-photo-add" multiple/>
                </div>

                <div class="row" id="gallery">
                </div>
                <script type="text/javascript">
                $(function() {

                    // Variable to store your files
                    var files;
                    var text;
                    var startDate;
                    var sliderName;
        
                    // Add events
                    $('input[type=file]').on('change', function(event) {
                        files = event.target.files;


                        // Create a formdata object and add the files
                        var data = new FormData();
                       
    

                        $.each(files, function(key, value) {
                           data.append(key, value);
                        });

                         

                       $sliderImageRequest = $.ajax({
                            url: '/slides/preview',
                            type: 'POST',
                            data: data,
                            cache: false,
                            dataType: 'html',
                            processData: false, // Don't process the files
                            contentType: false, // Set content type to false as jQuery will tell the server its a
                        });

                       $sliderImageRequest.then(function (response) {
                                $("#gallery").html(response);
                            
                        });

                    });
                });
                </script>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
@endsection