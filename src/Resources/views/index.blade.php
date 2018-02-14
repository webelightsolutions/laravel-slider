@extends(Config::get('slider.appFileLocation')) 
@section('content') @component('admin.components.page') @slot('pageHeading')
Slider @endslot @slot('panelHeadingLeft') List of Slider @endslot @slot('panelHeadingRight')
<a href='{{ route("slider.create") }}' class="btn btn-primary btn-sm float-right">Add New Slider</a> @endslot @slot('panelContent')
<div class="panel-body">
    @if (session('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Success</strong> {{ session('success') }}
    </div>
    @elseif (session('error'))
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Error!</strong> {{ session('error') }}
    </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped table-bordered task-table">
            <thead>
                <th class="text-center">Sr.No.</th>
                <th class="text-center">Name</th>
                <th class="text-center">Slider Type </th>
                <th class="text-center">Slides Per Page</th>
                <th class="text-center">Auto Play</th>
                <th class="text-center">Is Active</th>
                <th class="text-center">Actions</th>
            </thead>
            @if (count($sliders) > 0)
            <tbody>
    </div>
    <?php $counter = 1; ?> @foreach ($sliders as $slider)
    <tr>
        <td>{{ $counter++ }}</td>
        <td class="table-text">
            <div>{{ $slider->name }}</div>
        </td>
        <td class="table-text">
            <div>{{ $slider->slider_type }}</div>
        </td>
        <td class="table-text">
            <div>{{ $slider->slides_per_page }}</div>
        </td>
        <td class="table-text">
            @if($slider->auto_play == 1)
            <div> On </div>
            @else
            <div> Off </div>
            @endif
        </td>
        <td class="table-text">
            @if($slider->is_active == 1)
            <div> Yes </div>
            @else
            <div> No </div>
            @endif
        </td>
        <td class="td-actions text-center">
            <a href='{{ url("slider/$slider->id") }}' class="btn btn-default m-left-75" target="_blank">Preview</a>
            <a href='{{ url("slider/$slider->id/edit") }}' class="btn btn-default">Edit</a> @if($slider->is_active == 0)
            <a name="is_active" class="btn btn-primary btn-sm" href='{{ url("slider/changeStatus/$slider->id")}}'> Active </a>            @else
            <a name="is_active" class="btn btn-primary btn-sm" href='{{ url("slider/changeStatus/$slider->id")}}'> Inactive </a>            @endif
            <form action="/slider/{{ $slider->id }}" method="POST">
                {{ csrf_field() }} {{ method_field('DELETE') }}
                <button class="btn btn-danger btn-sm m-top-60">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
    @else
    <tbody>
        <tr>
            <td colspan="9" class="text-center">No Records Found.</td>
        </tr>
    </tbody>
    @endif
    </table>
</div>
</div>
</div>
</div>
@endslot @endcomponent
@endsection