$(document).ready(function() {
    $(".update_counter").click(function(event) {
        event.preventDefault();
        var file_id = $(this).data('file-id');
        var url = $(this).attr('href');
        var data = {};
        data.id = file_id;
        data.csrf_token = CSRF_TOKEN;
        $.post(BASE_URL+'mediafiles/ajax/update_counter', data, function(response) {
            var response_data = $.parseJSON(response);
            $('.file-count-'+file_id).text('Downloads: ' + response_data.count);
            window.location.href = url;
        });
        return false;
    });
});