(function ($) {
    let datepickeroptions = {
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
        timePickerSeconds: true,
        showWeekNumbers: true,
        locale: {
            format: 'YYYY-MM-DDTHH:mm:ss'
        },
        autoApply: true
    };
    if (!Modernizr.inputtypes['datetime-local']) {
        $(document).ready(function () {
            $('input[type="datetime-local"]').daterangepicker(datepickeroptions);
        });
    }
    let open = XMLHttpRequest.prototype.open;
    XMLHttpRequest.prototype.open = function () {
        this.addEventListener("loadend", function (event) {
            try {
                inject(JSON.parse(event.target.response));
            } catch (e) {
                console.error('inject error: ' + e);
            }
            if (!Modernizr.inputtypes['datetime-local']) {
                $('input[type="datetime-local"]').daterangepicker(datepickeroptions);
            }
            $('body').overlay(false);
        }, false);
        this.addEventListener("loadstart", function (event) {
            $('body').overlay(true);
        }, false);
        this.addEventListener("error", function (event) {
            $('body').overlay(false);
        }, false);
        this.addEventListener("timeout", function (event) {
            $('body').overlay(false);
        }, false);
        this.addEventListener("abort", function (event) {
            $('body').overlay(false);
        }, false);
        open.apply(this, arguments);
    };
    $.fn.injector = function (data) {
        inject(data);
    };

    function inject(data)
    {
        if (data && data.inject) {
            if (data.inject.html) {
                data.inject.html.forEach(function (html) {
                    switch (html.mode) {
                        case 'replace':
                            $(html.selector).replaceWith(html.html);
                            break;
                        case 'append':
                            $(html.selector).append(html.html);
                            break;
                        case 'prepend':
                            $(html.selector).prepend(html.html);
                            break;
                    }
                })
            }
            if (data.inject.script) {
                data.inject.script.forEach(function (script) {
                    if (!script.unique || $('script[src=' + script.src + ']').length === 0) {
                        $('body').append('<script src="' + script.src + '"></script>');
                    }
                });
            }
        }
        if (data.debug) {
            if ($('#debug').length) {
                $('#debug .modal-body').html(data.debug);
            } else {
                $('#main').prepend("<div id='debug' class='modal'><div class='modal-dialog modal-dialog-scrollable'><div class='modal-content'>" +
                    " <div class=\"modal-header\">\n" +
                    "        " +
                    "        <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-label=\"Close\">\n" +
                    "          <span aria-hidden=\"true\">&times;</span>\n" +
                    "        </button>\n" +
                    "      </div>" +
                    "<div class=\"modal-body\"></div></div></div></div>")
                $('#debug .modal-body').html(data.debug);
            }
            $('#debug').modal();
        }
    }
}(jQuery));
