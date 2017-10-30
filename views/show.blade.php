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
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Slides</h4>
            </div>
            <div class="modal-body">
                @foreach($previewSlides->slides as $slide)
                <amp-carousel height="300"
                  layout="fixed-height"
                  type="carousel">
                  <amp-img src=""
                    width="400"
                    height="300"
                    alt="a sample image"></amp-img>
                </amp-carousel>

                @endforeach
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
