(function ($) {
    let open = XMLHttpRequest.prototype.open;
    XMLHttpRequest.prototype.open = function () {
        this.addEventListener("loadend", function (event) {
            try {
                inject(JSON.parse(event.target.response));
            } catch (e) {
                console.error('inject error: ' + e);
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
                    if (!script.unique || $('script[src=' + script.script + ']').length === 0) {
                        $('body').append('<script src="' + script.script + '"></script>');
                    }
                });
            }
        }
    }
}(jQuery));
