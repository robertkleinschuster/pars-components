(function ($) {
    $.fn.history = function (data, id, href) {
        if (data.html && data.attributes && data.attributes.component) {
            var $destination = $('#' + id);
            if ($destination.length) {
                window.history.replaceState(formatdata($destination.clone().wrap('<div/>').parent().html(), id), '', window.location.href);
                window.history.pushState(data, '', href);
            }
        }
        return this;
    };

    window.addEventListener('popstate', (event) => {
        $('#' + event.state.attributes.component).replaceWith(event.state.html);
    });

    function formatdata(html, component)
    {
        return {
            html: html,
            attributes: {
                component: component
            }
        };
    }
}(jQuery));
