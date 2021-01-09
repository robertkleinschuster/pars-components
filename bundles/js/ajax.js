(function ($) {
    $(document).ready(function () {
        var $body = $('body');
        $body.on('click', '.ajax a', function (event) {
            if (!event.currentTarget.hasAttribute('target')) {
                event.preventDefault();
                $(this).parents('.ajax').load($(event.currentTarget).attr('href'));
            }
        });
        $('.ajax.onload').load();
        $body.on('submit', '.ajax form', function (event) {
            event.preventDefault();
            $(this).parents('.ajax').submit($(event.currentTarget).attr('action'));
        });
    });
}(jQuery));





