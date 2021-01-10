(function ( $ ) {
    $(document).ready(function () {
        attatchEvent();
    });
    function attatchEvent()
    {
        $('body').one('click.confirmModal', '.confirm-modal', function (e) {
            e.preventDefault();
            $('#confirm-modal-title').text($(this).data('confirm-title'));
            $('#confirm-modal-cancel').text($(this).data('confirm-cancel'));
            var $submit = $('#confirm-modal-submit');
            $submit.html($(this).html());
            $submit.attr('class', $(this).attr('class'));
            $submit.removeClass('confirm-modal');
            $submit.removeClass('mr-1');
            $submit.removeClass('mb-4');
            let that = this;
            $submit.one('click.confirm', function (event) {
                $(that).addClass('confirmed');
                $(that).trigger('click');
                attatchEvent();
            });
        });
    }
}( jQuery ));
