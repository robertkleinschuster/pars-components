(function ($) {
    $.fn.submit = function (href = null, history = false, id = null, component = null, remote = false) {
        this.each(function () {
            if (!href) {
                href = window.location.href;
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
                $(this).find('form').each(function () {
                    submit(this, href, id, component, history, remote);
                });
            }
        })
        return this;
    };

    window.addEventListener('popstate', (event) => {
        $('#' + event.state.attributes.component).replaceWith(event.state.html);
    });
    var clickedButton = null;
    $('body').on('click', '[type="submit"]', function (event) {
        clickedButton = this;
    })

    function formatdata(html ,component)
    {
        return {
            html: html,
            attributes: {
                component: component
            }
        };
    }

    function submit(form, href, id, component, history, remote)
    {
        var hrefcomponent = '';
        if (href.includes('?')) {
            hrefcomponent = href + '&component=' + component + '&componentonly=1';
        } else {
            hrefcomponent = href + '?component=' + component + '&componentonly=1';
        }
        var fd = new FormData(form);
        var $clickedButton = $(clickedButton);
        if (!$clickedButton.hasClass('confirm-modal') || $clickedButton.hasClass('confirmed')) {
            $clickedButton.removeClass('confirmed')
            fd.append(clickedButton.name, clickedButton.value)
            $.ajax({
                url: hrefcomponent,
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data && data.attributes && data.attributes.redirect_url) {
                        load(data.attributes.redirect_url, id, component, history, remote);
                    } else if (data && data.html) {
                        if (remote) {
                            id = component;
                        }
                        var $destination = $('#' + id);
                        if ($destination) {
                            if (history) {
                                window.history.replaceState(formatdata($destination.clone().wrap('<div/>').parent().html(), id), '', window.location.href);
                                window.history.pushState(data, '', href);
                            }
                            var $source = $(data.html);
                            $source.attr('id', id);
                            $source.attr('class', $destination.attr('class'));
                            $source.attr('data-component', component);
                            $source.attr('data-href', href);
                            $destination.replaceWith($source);
                        }
                    }

                },
            });
        }

    }

    function load(href, id, component, history, remote)
    {
        var hrefcomponent = '';
        if (href.includes('?')) {
            hrefcomponent = href + '&component=' + component + '&componentonly=1';
        } else {
            hrefcomponent = href + '?component=' + component + '&componentonly=1';
        }
        $.get(hrefcomponent, function (data) {
            if (data && data.attributes && data.attributes.redirect_url) {
                load(data.attributes.redirect_url, id, component, history, remote);
            } else if (data && data.html) {
                if (remote) {
                    id = component;
                }
                var $destination = $('#' + id);
                if ($destination) {
                    if (history) {
                        window.history.replaceState(formatdata($destination.clone().wrap('<div/>').parent().html(), id), '', window.location.href);
                        window.history.pushState(data, '', href);
                    }
                    var $source = $(data.html);
                    $source.attr('id', id);
                    $source.attr('class', $destination.attr('class'));
                    $source.attr('data-component', component);
                    $source.attr('data-href', href);
                    $destination.replaceWith($source);
                }
            }
        });
    }
}(jQuery));
