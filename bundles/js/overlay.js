(function ($) {
    $.fn.overlay = function (show = true) {
        this.each(function () {
            if (show) {
                if ($(this).find('.ajax-overlay').length === 0) {
                    $(this).append('<div class="overlay text-center ajax-overlay"><div style="width: 7rem; height: 7rem;" class="spinner-grow text-light shadow-lg" role="status">\n' +
                        '  <span class="sr-only">Loading...</span>\n' +
                        '</div></div>');
                }
            } else {
                $(this).find('.ajax-overlay').remove();
            }
        });
        return this;
    };
}(jQuery));
