$(document).ready(function() {
    var $add = $('#add-to-favourites'),
        $remove = $('#remove-from-favourites');

    $add.on('click', function (evn) {
        evn.preventDefault();

        $.ajax({
            'url' : '/characters/favourite/' + $(this).data('characterId'),
            success: function (response) {
                $add.addClass('hide');
                $remove.removeClass('hide');
            }
        });
    });

    $remove.on('click', function (evn) {
        evn.preventDefault();

        $.ajax({
            'url' : '/characters/unfavourite/' + $(this).data('characterId'),
            success: function (response) {
                $add.removeClass('hide');
                $remove.addClass('hide');
            }
        });
    });
});