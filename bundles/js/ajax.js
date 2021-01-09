(function ($) {
    $(document).ready(function () {
        var $body = $('body');
        $body.on('click', '.ajax a', function (event) {
            if (!event.currentTarget.hasAttribute('target')) {
                event.preventDefault();
                if ($('html').hasClass('reload')) {
                    if (!$(event.currentTarget).find('button').hasClass('history-back')) {
                        $('html').removeClass('reload')
                    }
                    $(this).parents('.ajax').load($(event.currentTarget).attr('href'));
                } else {
                    if ($(event.currentTarget).find('button').hasClass('history-back')) {
                        window.history.back();
                    } else {
                        $(this).parents('.ajax').load($(event.currentTarget).attr('href'));
                    }
                }
            }
        });
        $body.on('submit', '.ajax form', function (event) {
            event.preventDefault();
            $(this).parents('.ajax').submit(this);
        });
        $('.ajax.onload').load();
    });
}(jQuery));





