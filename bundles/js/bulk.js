(function( $ ) {
    $(document).ready(function () {
        $('body').on('click', '.bulk', function () {
            $('input[name="' + $(this).data('name') + '"]').prop('checked', $(this).prop('checked'));
        });
    });
}( jQuery ));
