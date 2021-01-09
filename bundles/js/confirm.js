(function( $ ) {
    $(document).ready(function () {
        $('body').on('click.confirmModal', '.confirm-modal', function (e) {
            e.preventDefault();
            $('#confirm-modal-title').text($(this).data('confirm-title'));
            $('#confirm-modal-cancel').text($(this).data('confirm-cancel'));
            var $submit = $('#confirm-modal-submit');
            $submit.html($(this).html());
            $submit.attr('class', $(this).attr('class'));
            $submit.removeClass('confirm-modal');
            $submit.removeClass('mr-1');
            let that = this;
            $submit.on('click', function () {
                $('body').off('click.confirmModal');
                $(that).addClass('confirmed');
                $(that).trigger('click');
            });
        });
    });
}( jQuery ));
