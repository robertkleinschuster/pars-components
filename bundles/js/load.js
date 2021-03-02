(function ($) {
    var datacache = [];
    $.fn.load = function (href = null, cache = false, history = false, id = null, component = null, remote = false, modal = false) {
        this.each(function () {
            if (href === Object(href)) {
                id = href.id;
                component = href.component ?? component;
                remote = href.remote ?? remote;
                cache = href.cache ?? cache;
                history = href.history ?? history;
                modal = href.modal ?? modal;
                href = href.href;
            }
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
            if (href === '#') {
                href = null;
            }
            if (href && id && component) {
                load(href, id, component, history, remote, cache, modal);
            }
        })
        return this;
    };

    function load(href, id, component, history, remote, cache, modal) {
        var hrefcomponent = '';
        if (href.includes('?')) {
            hrefcomponent = href + '&component=' + component + '&componentonly=1';
        } else {
            hrefcomponent = href + '?component=' + component + '&componentonly=1';
        }
        $.ajaxSetup({
            error: function (xhr, status, err) {
                if (xhr.responseJSON.html) {
                    inject(xhr.responseJSON, href, id, component, remote, false, modal);
                } else {
                    console.error('ajax error: ' + err);
                }
            }
        });
        cacheget(hrefcomponent, (cache && !$('html').hasClass('reload')), function (data) {
            if (data && data.attributes && data.attributes.redirect_url) {
                load(data.attributes.redirect_url, id, component, false, remote, false, modal);
                $('html').addClass('reload');
            } else if (data && data.html) {
                inject(data, href, id, component, remote, history, modal);
            }
        });
    }


    function cacheget(hrefcomponent, cache, callback) {
        if (datacache[hrefcomponent] && cache) {
            callback(datacache[hrefcomponent]);
            $.fn.injector(datacache[hrefcomponent]);
        } else {
            if (!cache) {
                datacache = [];
            }
            $.get(hrefcomponent, function (data) {
                datacache[hrefcomponent] = data;
                callback(data);
            });
        }
    }

    function inject(data, href, id, component, remote, history, modal) {
        if (modal) {
            var $source = $(data.html);
            if (history) {
                $.fn.history(data, id, href);
            } else {
                $.fn.history(data, id, href, true);
            }
            $body = $('#ajax-modal .modal-body');
            $('#ajax-modal .modal-title').html($(modal).data('modal-title') ?? '');
            $body.empty();
            $body.append($source);
            $body.find('#components').removeClass('container-fluid');
            if ($body.find('form').length) {
                $body.find('form').attr('action', href);
            }
            $('#ajax-modal').modal({backdrop: 'static', keyboard: false});
            $('#ajax-modal').on('click.closeModal', '.close-modal', function () {
                $('#ajax-modal').modal('hide');
            });
            $(document).trigger('injected');
        } else {
            if (remote) {
                id = component;
            }
            if ($('#ajax-modal').hasClass('show')) {
                var $destination = $('#ajax-modal').find('#' + id);
            } else {
                var $destination = $('#' + id);
            }
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
                $(document).trigger('injected');
            }
        }
    }
}(jQuery));
