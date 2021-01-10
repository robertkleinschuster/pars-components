(function ( $ ) {
    $(document).ready(function () {
        var $body = $('body');
        $body.on('click', '.bulk-all', function () {
            $(this).parents('form').find('input[name="' + $(this).data('name') + '"]').prop('checked', $(this).prop('checked'));
        });
        $body.on('click', '.bulk', function () {
            if ($(this).parents('form').find('.bulk:checked').length) {
                $(this).parents('form').find('[type="submit"]').removeClass('d-none');
            } else {
                $(this).parents('form').find('[type="submit"]').addClass('d-none');
            }
        });
    });
}( jQuery ));
