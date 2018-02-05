@extends(Config::get('slider.appFileLocation'))
@section('content')
<div class="container">
<script async src="https://cdn.ampproject.org/v0.js"></script>
<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>

@if($slider['slider_type'] == 'slider')
<amp-carousel  height="320" layout="fixed-height" type="carousel">
    @foreach ($slides as $key => $slide)
        <a href="#">
            <amp-img src="{{ asset('storage/'.$slider->name.'/original/'.$slide->image_name) }}"
              width="400"
              height="300"
              alt="a sample image"></amp-img>
        </a> 
    @endforeach
</amp-carousel>
@endif

@if($slider['slider_type'] == 'banner')
	<amp-carousel width="500" height="300" layout="responsive" type="slides">
	<?php $i = 0;?>
    @foreach ($slides as $key => $slide)
	  <amp-img src="{{ asset('storage/'.$slider->name.'/original/'.$slide->image_name) }}"
	    width="500"
	    height="300"
	    layout="responsive"
	    alt="a sample image"></amp-img>
	    <?php $i++;
	    if($i==1)break; ?>
    @endforeach
	</amp-carousel>
@endif

</div>
@endsection