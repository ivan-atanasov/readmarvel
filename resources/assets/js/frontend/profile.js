$('#upload-avatar').change(function () {
    // select the form and submit
    $('#upload-avatar-form').submit();
});

$(document).ready(function() {
    $('button[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        e.preventDefault();

        $('button[data-toggle="tab"]').removeClass('selected');
        var target = $(e.target);
        target.addClass('selected');
        // alert(target);
    });
});