(function ($) {
    $.fn.history = function (data, id, href, replace = false) {
        if (data.html && data.attributes && data.attributes.component) {
            var $destination = $('#' + id);
            if ($destination.length) {
                if (replace) {
                    window.history.replaceState(data, '', href);
                } else {
                    window.history.replaceState(formatdata($destination.clone().wrap('<div/>').parent().html(), id, href), '', window.location.href);
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
        if ($('html').hasClass('reload')) {
            $('#' + event.state.attributes.component).load(event.target.location.href);
        } else {
            $('#' + event.state.attributes.component).replaceWith(event.state.html);
        }
    });

    function formatdata(html, component, href)
    {
        return {
            html: html,
            attributes: {
                component: component
            },
            href: href
        };
    }
}(jQuery));
