@extends('layouts.app')
@section('content')
<div class="container">
<script async src="https://cdn.ampproject.org/v0.js"></script>
<script async custom-element="amp-carousel" src="https://cdn.ampproject.org/v0/amp-carousel-0.1.js"></script>

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
</div>
@endsection