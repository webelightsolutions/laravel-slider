 @extends('layouts.app') @section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-4 heading">Slider</div>
            <div class="col-md-8 text-right">
                <a href='{{ url("slider/create") }}' class="btn btn-default btn-sm">+ Add New</a>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered task-table">
                <thead>
                    <th>Sr.No.</th>
                    <th>Name</th>
                    <th>Slider Type </th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Slides Per Page</th>
                    <th>Auto Play</th>
                    <th>Is Active</th>
                    <th class="text-center">Actions</th>
                </thead>
                @if (count($sliders) > 0)
                <tbody>
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
                            {{--
                            <div>{{ $slider->slides[0]['start_date'] }}</div> --}}
                        </td>
                        <td class="table-text">
                            {{--
                            <div>{{ $slider->slides[0]['end_date'] }}</div> --}}
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
                        <td class="text-center">
                            {{-- <a href='{{ url("slider/$slider->id") }}' class="btn btn-success btn-sm btn btn-info" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">View</a> --}}
                            <a href='{{ url("slider/$slider->id/edit") }}' class="btn btn-default">Edit</a> @if($slider->is_active == 0)
                            <a name="is_active" class="btn btn-primary btn-sm" href='{{ url("slider/changeStatus/$slider->id")}}'> Active </a> @else
                            <a name="is_active" class="btn btn-primary btn-sm" href='{{ url("slider/changeStatus/$slider->id")}}'> Deactive </a> @endif
                            <form action="/slider/{{ $slider->id }}" method="POST">
                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button class="btn btn-danger btn-sm ">Delete</button>
                            </form>
                            <button type="button" class="btn btn-default previewSlides" value="{{ $slider->id }}">Preview</button>
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
            <script type="text/javascript">
            $(function() {

                var $jQuery = jQuery;
                var $sliderId;
                var sliderIdRequest;

                $('.previewSlides').on('click', function() {
                    var $sliderId = $(this).val();
                    sliderIdRequest = $.ajax({
                        type: 'GET',
                        url: '/slider/preview',
                        data: {
                            'sliderId': $sliderId,
                        },

                    });
                });
                $('#demoModal').modal('show');

                sliderIdRequest.done(function(response) {
                    $('div.modal-body').html(response);
                });
            });

            </script>
        </div>
    </div>
</div>


{{-- <div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Slides</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> --}}

@endsection