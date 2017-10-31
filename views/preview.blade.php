 @extends('layouts.app') @section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-4 heading">Slider</div>
            <div class="col-md-8 text-right">
                <button type="button" class="btn btn-default previewSlides">Preview</button>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="modal fade" id="demoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content model-width">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Slides</h4>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid hidden-xs">
                            <div class="row">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="item active">
                                                <div class="row">
                                                    <div class="col-md-12 slide-block">
                                                    @foreach ($previewSlides->slides as $slide)
                                                        <img src="{{ asset('storage/'.$previewSlides['name'].'/original/'.$slide['image_name']) }}">
                                                    @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <a class="left carousel-control carusel-icon " href="#carousel-example-generic" data-slide="prev">
                                          <span class="glyphicon glyphicon-chevron-left"></span></a>
                                            <a class="right carousel-control carusel-icon" href="#carousel-example-generic" data-slide="next"><span class="glyphicon glyphicon-chevron-right">
                                              </span></a>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(function() {
        $(".previewSlides").click(function() {
            $('#demoModal').modal('show');
        });
    });
    </script>
</div>


@endsection