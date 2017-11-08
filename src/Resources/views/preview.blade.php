
@foreach($images as $imageKey => $image)
<div class="image-div col-sm-3 m-top-15">
	<img src="{{ asset('storage/temp/sliders/'.$image['fileName'])}}" class="img img-thumbnail" name="image_name" style="width: 100%; height: 130px;">
	<div class="image-action" onclick="removeImage(this)"><a class="btn btn-danger btn-sm"> X </a></div>

	<input type="hidden" name="slides[{{$imageKey}}][image_name]" value="{{ $image['fileName'] }}">
	
	<label class="color-black">Start Date</label>
	<input type="date" name="slides[{{$imageKey}}][start_date]" class="form-control" required>
	
	<label class="color-black">End Date</label>
	<input type="date" name="slides[{{$imageKey}}][end_date]" class="form-control" required>
	
	<label>Title</label>
	<input type="text" name="slides[{{$imageKey}}][title]" class="form-control" required>
	
	<label>Description</label>
	<input type="text" name="slides[{{$imageKey}}][description]" class="form-control" required>
	
	<label class="color-black">Is Active</lable>
	<input type="checkbox" class="form-control" name="slides[{{$imageKey}}][is_active]" value="1">
</div>
@endforeach

<script type="text/javascript">

    function removeImage(id){
        $(id).parent().remove();
    } 
 </script>
