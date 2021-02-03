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
        let data = null;
        $body.on('change', '.ajax > select', function (event) {
            let value = $(this).val();
            let name = $(this).attr('name');
            let pathHelper = new PathHelper();
            let parameter = new Parameter('data');
            parameter.setAtttribute(name, value);
            pathHelper.addParamter(parameter);
            let path = pathHelper.getPath();
            data = $(this).parents('form').serializeArray();
            $(this).parents('.ajax').load(path);
        });
        $(document).on('injected', function () {
            if (data !== null) {
                data.forEach(function (item) {
                    if (item.value) {
                        $('input#' + item.name).val(item.value);
                        let $checkbox = $('input[type=checkbox]#' + item.name);
                        if ($checkbox.val() === 'true') {
                            $checkbox.attr('checked', 'checked');
                        } else if ($checkbox.val() === 'false') {
                            $checkbox.removeAttr('checked', 'checked');
                        }
                        let $select = $('select#' + item.name);
                        $select.find('option').removeAttr('checked');
                        $select.find('option').removeAttr('selected');
                        $select.find('option[value='+ item.value +']').attr('selected', 'selected');
                    }
                });
            }
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





