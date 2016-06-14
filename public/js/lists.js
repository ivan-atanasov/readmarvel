$('#upload-list-avatar').change(function () {
    // select the form and submit
    $('#upload-list-avatar-form').submit();
});

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();

    var $deleteModal = $('#delete-modal');
    $('.list-item-delete').on('click', function (evn) {
        evn.preventDefault();

        $deleteModal.modal('show');
        var resourceId = $(this).data('itemId'),
            $pressedButton = $(this);

        $deleteModal.find('.confirm-btn').on('click', function(e) {
            e.preventDefault();
            var submitUrl = $(this).data('submitUrl'),
                _token = $(this).data('csrf');

            $.ajax({
                url: submitUrl,
                data: {
                    'resourceId': resourceId,
                    '_token': _token
                },
                method: 'post',
                success: function() {
                    $deleteModal.modal('hide');
                    $pressedButton.closest('tr').slideUp();
                }
            });
        });
    });
});