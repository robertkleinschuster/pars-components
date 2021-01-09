(function ($) {
    var cache = [];
    $.fn.load = function (href = null, history = false, id = null, component = null, remote = false) {
        this.each(function () {
            if (href == null) {
                href = $(this).data('href');
            }
            if (id == null) {
                id = $(this).attr('id');
            }
            if (component == null) {
                component = $(this).data('component');
            }
            if (!remote) {
                remote = $(this).hasClass('remote');
            }
            if (!history) {
                history = $(this).hasClass('history');
            }
            if (href && id && component) {
                load(href, id, component, history, remote);
            }
        })
        return this;
    };

    function load(href, id, component, history, remote) {
        var hrefcomponent = '';
        if (href.includes('?')) {
            hrefcomponent = href + '&component=' + component + '&componentonly=1';
        } else {
            hrefcomponent = href + '?component=' + component + '&componentonly=1';
        }
        $.ajaxSetup({
            error: function (xhr, status, err) {
                if (xhr.responseJSON.html) {
                    inject(xhr.responseJSON, href, id, component, remote, false);
                } else {
                    console.error('ajax error: ' + err);
                }
            }
        });
        $.get(hrefcomponent, function (data) {
            if (data && data.attributes && data.attributes.redirect_url) {
                load(data.attributes.redirect_url, id, component, false, remote);
                $('html').addClass('reload');
            } else if (data && data.html) {
                inject(data, href, id, component, remote, history);
            }
        });
    }

    function inject(data, href, id, component, remote, history)
    {
        if (remote) {
            id = component;
        }
        var $destination = $('#' + id);
        if ($destination) {
            if (history) {
                $.fn.history(data, id, href);
            } else {
                $.fn.history(data, id, href, true);
            }
            var $source = $(data.html);
            $source.attr('id', id);
            $source.attr('class', $destination.attr('class'));
            $source.attr('data-component', component);
            $source.attr('data-href', href);
            $destination.replaceWith($source);
        }
    }
}(jQuery));
