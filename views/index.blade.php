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
                       {{--      <a class="previewSlides btn btn-default" data-toggle="modal" data-target="#exampleModal" href='{{ $slider->id }}'>Preview Slider</a> --}}

                       {{-- <a class="previewSlides btn btn-default" name='{{ $slider->id }}'>Preview Slider</a> --}}
                       <button type="button" class="btn btn-default previewSlides" value="{{ $slider->id }}" data-toggle="modal" data-target="#exampleModal">Preview</button>
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

                $('.previewSlides').on('click', function() {
                    var sliderId = $(this).val();

                    var sliderIdRequest = $.ajax({
                        type: 'GET',
                        url: '/slider/preview',
                        data: {
                            'sliderID': sliderId,
                        },

                    });

                });
                    sliderIdRequest.done(function(response) {
                        console.log(response);
                        $jQuery('.modal-body').html(response);
                    });
            });
                </script>
        </div>
    </div>
</div>

<div class="model-body"></div>

{{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog model-width " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div> --}}
@endsection