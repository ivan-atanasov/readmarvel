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

        $deleteModal.find('.confirm-btn').on('click', function (e) {
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
                success: function () {
                    $deleteModal.modal('hide');
                    $pressedButton.closest('tr').slideUp();
                }
            });
        });
    });

    $('.list-item-edit').on('click', function (evn) {
        evn.preventDefault();

        var $modal = $('.add-to-list');

        $.ajax({
            url: '/series/series',
            data: {
                'itemId': $(this).data('itemId')
            },
            method: 'post',
            success: function (response) {
                var $startedAt = $modal.find('input[name="started_at"]'),
                    $finishedAt = $modal.find('input[name="finished_at"]');
                $modal.find('input[name="progress"]').attr('value', response.progress);
                $modal.find('input[name="item_id"]').attr('value', response.id);
                $modal.find('select[name="score"]').val(response.score);
                $modal.find('select[name="reread_value"]').val(response.reread_value);
                $modal.find('select[name="list_id"]').val(response.list_id);

                $startedAt.val(getCorrectDate(response.started_at));
                $finishedAt.val(getCorrectDate(response.finished_at));

                $startedAt.datetimepicker({format: 'yyyy/mm'});
                $finishedAt.datetimepicker({format: 'yyyy/mm'});
            }
        });

    });

    $("#copy-list-url-to-clipboard").on("click", function (evn) {
        evn.preventDefault();

        var elem = document.getElementById("share-hash"),
            origSelectionStart,
            origSelectionEnd;

        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;

        // select the content
        var currentFocus = document.activeElement;
        target.focus();
        target.setSelectionRange(0, target.value.length);

        // copy the selection
        document.execCommand("copy");

        // restore original focus
        if (currentFocus && typeof currentFocus.focus === "function") {
            currentFocus.focus();
        }

        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    });
});

/**
 * Returns properly formatted date or an empty string
 *
 * @param dateToCheck
 * @returns string
 */
function getCorrectDate(dateToCheck) {
    if (dateToCheck == null || dateToCheck == 'undefined' || dateToCheck.length == 0) {
        return '';
    }

    var startedAtDate = new Date(dateToCheck),
        monthStarted = startedAtDate.getMonth().toString().length > 1 ?
            startedAtDate.getMonth() + 1 :
            '0' + (startedAtDate.getMonth() + 1);

    return startedAtDate.getFullYear() + '/' + monthStarted;
}