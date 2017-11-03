
@foreach($images as $imageKey => $image)

<div class="image-div col-sm-3">
	<img src="{{ asset('storage/temp/sliders/'.$image['fileName'])}}" width="290" height="130" class="img img-thumbnail" name="image_name">
	<input type="hidden" name="slides[{{$imageKey}}][image_name]" value="{{ $image['fileName'] }}">
	
	<label class="color-black">Start Date</label>
	<input type="date" name="slides[{{$imageKey}}][start_date]" class="form-control">
	
	<label class="color-black">End Date</label>
	<input type="date" name="slides[{{$imageKey}}][end_date]" class="form-control">
	
	<label>Title</label>
	<input type="text" name="slides[{{$imageKey}}][title]" class="form-control">
	
	<label>Description</label>
	<input type="text" name="slides[{{$imageKey}}][description]" class="form-control">
	
	<label class="color-black">Is Active</lable>
	<input type="checkbox" class="form-control" name="slides[{{$imageKey}}][is_active]" value="1">
</div>

@endforeach
