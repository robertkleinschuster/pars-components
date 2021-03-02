(function ($) {
    $.fn.history = function (data, id, href, replace = false) {
        if (data.html && data.attributes && data.attributes.component) {
            var $destination = $('#' + id);
            if ($destination.length) {
                data.href = href;
                if (replace) {
                    window.history.replaceState(data, '', href);
                } else {
                    window.history.replaceState(formatdata($destination.clone().wrap('<div/>').parent().html(), id, window.location.href), '', window.location.href);
                    window.history.pushState(data, '', href);
                }
            }
        }
        return this;
    };

    window.addEventListener('popstate', (event) => {
        if ($('#ajax-modal').hasClass('show')) {
            $('#ajax-modal').modal('hide');
        }
        $('#' + event.state.attributes.component).load({href: event.state.href, history: false});
    });

    function formatdata(html, component, href) {
        return {
            html: html,
            attributes: {
                component: component
            },
            href: href,
            inject: {
                html: [
                    {
                        html: document.getElementById('subnavigation').outerHTML,
                        mode: 'replace',
                        selector: '#subnavigation'
                    }
                ]
            }
        };
    }
}(jQuery));
