$(document).ready(function() {
    $('#datatable-static-pages').DataTable();

    $('.btn-remove').on('click', function (evn) {
        evn.preventDefault();

        var $deleteModal = $('#delete-modal');
        $deleteModal.find('form').attr('action', $(this).data('url'));
    });
});
