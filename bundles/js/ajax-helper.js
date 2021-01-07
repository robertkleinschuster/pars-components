$(document).ready(function () {
    var $body = $('body');
    $body.on('click', '.ajax a', function (event) {
        event.preventDefault();
        var data = {
            html: $('#components').clone().wrap('<div/>').parent().html()
        };
        var href = $(event.currentTarget).attr('href');
        window.history.replaceState(data, '', window.location.href);
        ajaxreplace(href);
    });
    window.addEventListener('popstate', (event) => {
        $('#components').replaceWith(event.state.html);
    });
    $body.on('submit', 'form', function () {
        showOverlay();
    });
    $body.on('click', 'a', function (event) {
        if (event.currentTarget.getAttribute('href').trim() !== '#') {
            showOverlay();
        }
    });
});

function ajaxreplace(url) {
    if (url.includes('?')) {
        var href = url + '&component=components&componentonly=1';
    } else {
        var href = url + '?component=components&componentonly=1';
    }
    $.get(href, function (data) {
            if (data && data.attributes && data.attributes.redirect_url) {
                ajaxreplace(data.attributes.redirect_url);
            } else if (data && data.html) {
                window.history.pushState(data, '', url);
                if (data.attributes && data.attributes.component) {
                    $('#' + data.attributes.component).replaceWith(data.html);
                } else {
                    $('#components').replaceWith(data.html);
                }
                hideOverlay();
            } else {
                window.location.href = url;
            }
        }
    ).fail(function () {
        window.location.href = url;
    });
}

function showOverlay() {
    $('body').append('<div class="overlay text-center ajax-overlay"><div style="width: 7rem; height: 7rem;" class="spinner-grow text-light shadow-lg" role="status">\n' +
        '  <span class="sr-only">Loading...</span>\n' +
        '</div></div>');
}

function hideOverlay() {
    $('.ajax-overlay').replaceWith('');
}

function handleInject(data) {
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
                if (!script.unique || $('script[src=' +  script.script + ']').length === 0 ) {
                    $('body').append('<script src="' + script.script + '"></script>');
                }
            });
        }
    }
}

let open = XMLHttpRequest.prototype.open;
XMLHttpRequest.prototype.open = function() {
    this.addEventListener("loadend", function (event) {
        try {
            handleInject(JSON.parse(event.target.response));
        } catch (e) {
            console.error('inject error: ' + e);
        }
    }, false);
    open.apply(this, arguments);
};
