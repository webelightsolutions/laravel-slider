@extends('layouts.app') @section('content')

<div class="col-sm-2"></div>
<div class="col-sm-8">
<div class="bs-example">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Carousel indicators -->
       {{--  <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>    --}}
        <!-- Wrapper for carousel items -->
        <div class="carousel-inner">

            @foreach ($slides as $key => $slide)
            <div class="item{{ $key == 0 ? ' active' : '' }}">
                <img src="{{ asset('storage/'.$slider->name.'/original/'.$slide->image_name) }}"
                width="100%">
                <div class="carousel-caption">
                  <h3 style="color: {{ $slide->settings }}; font-size: {{ $slide->caption_size }}px;">{{ $slide->title }}</h3> <br/>
                  <h4>{{ $slide->description }}</h4>
                </div>
            </div>
            @endforeach 
        </div>
        <!-- Carousel controls -->
        <a class="carousel-control left " href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</div>
</div>
<div class="col-sm-2"></div>
@endsection