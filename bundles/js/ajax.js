(function ($) {
    $(document).ready(function () {
        var $body = $('body');
        $body.on('click', '.ajax a', function (event) {
            if (!event.currentTarget.hasAttribute('target') && !$(event.currentTarget).hasClass('ql-action')
                && !$(event.currentTarget).hasClass('nav-link')
            ) {
                event.preventDefault();
                if ($('html').hasClass('reload')) {
                    if (!$(event.currentTarget).find('button').hasClass('history-back')) {
                        $('html').removeClass('reload')
                    }
                    $(this).parents('.ajax').load($(event.currentTarget).attr('href'));
                } else {
                    if ($(event.currentTarget).find('button').hasClass('history-back')) {
                        window.history.back();
                    } else {
                        $(this).parents('.ajax').load($(event.currentTarget).attr('href'), ($(event.currentTarget).find('.cache').length > 0));
                    }
                }
            }
            if ($(event.currentTarget).hasClass('nav-link')) {
                var $nav = $(event.currentTarget).parents('.nav-tabs')
                if ($nav.length) {
                    var $navItem = $(event.currentTarget).parents('.nav-item')
                    var navid = $nav.attr('id');
                    var navindex = $navItem.data('index');
                    var search = insertParam(document.location.search, 'nav' , 'id:' + navid + ';' + 'index:' + navindex);
                    var component = $(event.currentTarget).attr('href');
                    var id = component.substr(1);
                    var href = document.location.pathname + '?'  + search;
                    $(component).load(href, true, false, id, id);
                    $('html').removeClass('reload');
                }
            }
        });
        $body.on('submit', '.ajax form', function (event) {
            event.preventDefault();
            $(this).parents('.ajax').submit(this);
        });
        $('.ajax.onload').load();
    });

    function insertParam(search, key, value) {
        key = encodeURIComponent(key);
        value = encodeURIComponent(value);
        var kvp = search.substr(1).split('&');
        let i=0;
        for(; i<kvp.length; i++){
            if (kvp[i].startsWith(key + '=')) {
                let pair = kvp[i].split('=');
                pair[1] = value;
                kvp[i] = pair.join('=');
                break;
            }
        }
        if(i >= kvp.length){
            kvp[kvp.length] = [key,value].join('=');
        }
        let params = kvp.join('&');
        return params;
    }
}(jQuery));





