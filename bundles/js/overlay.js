(function ($) {
    $.fn.overlay = function (show = true) {
        this.each(function () {
            if (show) {
                if ($(this).find('.ajax-overlay').length === 0) {
                    $(this).append('<div class="overlay text-center ajax-overlay"><div style="width: 7rem; height: 7rem;" class="spinner-grow text-light shadow-lg" role="status">\n' +
                        '  <span class="sr-only">Loading...</span>\n' +
                        '</div></div>');
                }
                if(!$(this).find('.ajax-overlay').hasClass('show')) {
                    $(this).find('.ajax-overlay').addClass('show');
                }
            } else {
                $(this).find('.ajax-overlay').removeClass('show');
            }
        });
        return this;
    };
}(jQuery));
