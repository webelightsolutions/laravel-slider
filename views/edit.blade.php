 @extends('layouts.app') @section('content')
<div class="col-sm-3"></div>
<div class="col-sm-6">
    <div class="panel panel-default">
        <div class="panel-heading">
            Slider Edit
        </div>
        <form method="POST" action="/slider/{{$slider->id}}" enctype="multipart/form-data">
            <div class="panel-body">
               {{ csrf_field() }} {{ method_field('PUT') }}
                <div class="form-group">
                    <label class="color-black">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $slider->name }}">
                </div>

                <div class="form-group">
                    <label class="color-black"> Slider Type </label>
                    <input type="text" name="slider_type" class="form-control" value=" {{ $slider->slider_type}}">
                </div>

               <div class="form-group col-md-6">
                   <label class="color-black">Start Date</label>
                   <input type="date" name="start_date" class="form-control" value="{{ $slider->start_date }}">
               </div>
               <div class="form-group col-md-6">
                   <label class="color-black"> End Date</label>
                   <input type="date" name="end_date" class="form-control" value="{{ $slider->end_date }}">
               </div>
                
                <div class="form-group">
                    <label class="color-black"> Slides Per Page</label>
                    <select class="form-control color-black" name="slides_per_page"> 
                    @for($i=1; $i<=10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                    </select>

                </div>
                <div class="form-group">
                    <label class="color-black">Auto play </label>
                    <select class="form-control color-black" name="auto_play"> 
                        <option value="0">Off</option>
                        <option value="1">On</option>
                    </select>
                </div>

            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">
                    Update
                </button>
        </form>
        </div>
    </div>
</div>
<div class="col-sm-3"></div>
@endsection