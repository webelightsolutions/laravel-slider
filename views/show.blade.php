 @extends('layouts.app') @section('content')
<div class="panel-body">
    {{ csrf_field() }}
    <div class="panel panel-default">
        <div class="panel-heading">
            Slider
        </div>
        <div class="panel-body">
            <table class="table table-striped task-table table-bordered">
                <thead>
                   <th>Name</th>
                    <th>Slider Type </th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Slide Per Page</th>
                    <th>Auto Play</th>
                    <th>Is Active</th>
                </thead>
                @if (isset($slider))
                <tbody>
                    <tr>
                        <td class="table-text">
                            <div>{{ $slider->name }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $slider->slider_type }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $slider->slides[0]['start_date'] }}</div>
                        </td>
                        <td class="table-text">
                            <div>{{ $slider->slides[0]['end_date'] }}</div>
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
                    </tr>
                </tbody>
                @else
                <div class="alert alert-info">
                    No Details found.
                </div>
                @endif
            </table>
        </div>
    </div>
</div>
</div>
@endsection