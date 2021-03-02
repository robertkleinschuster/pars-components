(function ($) {
    $.fn.submit = function (form, href = null, history = false, id = null, component = null, remote = false) {
        if (!href) {
            href = $(form).attr('action');
        }
        var method = $(form).attr('method');
        if (!href) {
            href = window.location.href;
        }
        var $ajax = $(this);
        if (id == null) {
            id = $ajax.attr('id');
        }
        if (component == null) {
            component = $ajax.data('component');
        }
        if (!remote) {
            remote = $ajax.hasClass('remote');
        }
        if (!history) {
            history = $ajax.hasClass('history');
        }
        if (href && id && component) {
            submit(form, href, id, component, history, remote, method);
        }
        return this;
    };

    var clickedButton = null;
    $('body').on('click', '[type="submit"]', function (event) {
        clickedButton = this;
    });
    function submit(form, href, id, component, history, remote, method)
    {
        var hrefcomponent = '';
        if (href.includes('?')) {
            hrefcomponent = href + '&component=' + component + '&componentonly=1';
        } else {
            hrefcomponent = href + '?component=' + component + '&componentonly=1';
        }
        var modal = $(form).parents('#ajax-modal').length > 0;
        var fd = new FormData(form);
        var $clickedButton = $(clickedButton);
        if (!$clickedButton.hasClass('confirm-modal') || $clickedButton.hasClass('confirmed')) {
            $clickedButton.removeClass('confirmed')
            if (clickedButton) {
                fd.append(clickedButton.name, clickedButton.value)
            }
            $.ajaxSetup({
                error: function(xhr, status, err) {
                    if (xhr.responseJSON.html) {
                        inject(xhr.responseJSON, href, id, component, remote, history, modal);
                    } else {
                        console.error('ajax error: ' + err);
                    }
                }
            });
            $.ajax({
                url: hrefcomponent,
                type: method ?? 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function (data) {
                    inject(data, href, id, component, remote, history, modal);
                }
            });
        }

    }

    function inject(data, href, id, component, remote, history, modal)
    {
        if (data && data.attributes && data.attributes.redirect_url) {
            load(data.attributes.redirect_url, id, component, history, remote, modal);
            $('html').addClass('reload');
        } else if (data && data.html) {
            if (remote) {
                id = component;
            }
            if (modal && $('#ajax-modal').hasClass('show')) {
                var $destination = $('#ajax-modal').find('#' + id);
            } else {
                var $destination = $('#' + id);
            }
            if ($destination) {
                if (history) {
                    $.fn.history(data, id, href, true);
                }
                var $source = $(data.html);
                $source.attr('id', id);
                $source.attr('class', $destination.attr('class'));
                $source.attr('data-component', component);
                $source.attr('data-href', href);
                $destination.replaceWith($source);
                var $body = $('body');
                if ($body.find('form').length) {
                    $body.find('form').attr('action', href);
                }
            }
        }
    }

    function load(href, id, component, history, remote, modal)
    {
        var hrefcomponent = '';
        if (href.includes('?')) {
            hrefcomponent = href + '&component=' + component + '&componentonly=1';
        } else {
            hrefcomponent = href + '?component=' + component + '&componentonly=1';
        }
        $.get(hrefcomponent, function (data) {
            if (data && data.attributes && data.attributes.redirect_url) {
                load(data.attributes.redirect_url, id, component, history, remote, modal);
            } else if (data && data.html) {
                if (remote) {
                    id = component;
                }
                if (modal && $('#ajax-modal').hasClass('show')) {
                    var $destination = $('#ajax-modal').find('#' + id);
                } else {
                    var $destination = $('#' + id);
                }
                if ($destination) {
                    if (history) {
                        $.fn.history(data, id, href, true);
                    }
                    var $source = $(data.html);
                    $source.attr('id', id);
                    $source.attr('class', $destination.attr('class'));
                    $source.attr('data-component', component);
                    $source.attr('data-href', href);
                    $destination.replaceWith($source);
                    var $body = $('body');
                    if ($body.find('form').length) {
                        $body.find('form').attr('action', href);
                    }
                }
            }
        });
    }
}(jQuery));
