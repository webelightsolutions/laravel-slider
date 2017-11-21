$(function() {

    // Variable to store your files
    var files;
    var text;
    var startDate;
    var sliderName;

    // Add events
    $('input[type=file]').on('change', function(event) {
        files = event.target.files;

        // Create a formdata object and add the files
        var data = new FormData();



        $.each(files, function(key, value) {
            data.append(key, value);
        });



        $sliderImageRequest = $.ajax({
            url: '/slides/preview',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'html',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a
        });

        $sliderImageRequest.then(function(response) {
            $("#gallery").html(response);

        });

    });
});

