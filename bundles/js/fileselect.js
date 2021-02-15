(function ($) {
    $(document).ready(function () {
        attatchEvent();
    });

    function attatchEvent() {
        $('body').on('click.fileselectModal mousedown.fileselectModal touchstart.fileselectModal', '.fileselect-modal', function (e) {
            e.preventDefault();
            var modal = $(this).parents('#ajax-modal').length > 0;
            if (modal) {
                $('#ajax-modal').modal('hide');
            }
            var data = $(this).data('fileselect-list');
            var element = createFolderListing(data);
            var parent = data;
            var that = this;
            handleActive($(this).val());
            if ($('#fileselect-folderlisting').length) {
                $('#fileselect-folderlisting').replaceWith(element);
            } else {
                document.querySelector('#fileselect-modal .modal-body').appendChild(element);
            }
            $('body').on('click.fileselect-element', '.fileselect-element', function (event) {
                let data = $(this).data('fileselect-list');
                if (data) {
                    var element = createFolderListing(data, $(this).data('fileselect-folder'), parent);
                    document.querySelector('#fileselect-folderlisting').replaceWith(element);
                    handleActive($(that).val());
                } else {
                    handleActive($(this).attr('id'));
                }
            });
            $('body').on('click.fileselect-modal-submit', '#fileselect-modal-submit', function () {
                var $modal = $('#fileselect-modal');
                var id = $modal.find('.fileselect-element.active').attr('id');
                $(that).val(id);
            });
            $('body').on('hidden.bs.modal', '#fileselect-modal', function (e) {
                if (modal) {
                    $('#ajax-modal').modal('show');
                    $('#ajax-modal').modal('handleUpdate');
                }
            });
            $('#fileselect-modal-title').text($(this).data('fileselect-title'));
            $('#fileselect-modal-cancel').text($(this).data('fileselect-cancel'));
        });
    }


    function handleActive(active) {
        var $modal = $('#fileselect-modal');
        $modal.find('.fileselect-element').removeClass('active');
        if (active) {
            $modal.find('#' + active + '.fileselect-element').addClass('active');
        } else {
            $modal.find('.fileselect-element.noselection').addClass('active');
        }
    }

    function createFolderListing(data, folder = null, parent = null) {
        var element = document.createElement('div');
        element.setAttribute('id', 'fileselect-folderlisting');
        element.classList.add('row');
        element.classList.add('row-cols-xl-5');
        element.classList.add('row-cols-l-4');
        element.classList.add('row-cols-2');

        if (parent) {
            element.appendChild(createParentFolderElement(parent));
        }
        for (var key in data) {
            if (data.hasOwnProperty(key)) {
                var value = data[key];
                if (value === Object(value)) {
                    element.appendChild(createFolderElement(value, key));
                } else {
                    element.appendChild(createFileElement(value, folder, key));
                }
            }
        }
        return element;
    }

    function createFolderElement(data, key) {
        var col = document.createElement('div');
        col.classList.add('col');
        var element = document.createElement('div');
        element.setAttribute('data-fileselect-list', JSON.stringify(data));
        element.setAttribute('data-fileselect-folder', key);
        element.classList.add('fileselect-element');
        element.classList.add('card');
        element.classList.add('mb-3');
        var image = document.createElement('span');
        image.classList.add('card-img-top');
        image.classList.add('m-auto');
        image.classList.add('pt-3');
        image.innerHTML = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"40\" height=\"40\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-folder\"><path d=\"M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z\"></path></svg>";
        element.appendChild(image);
        var body = document.createElement('div');
        body.classList.add('card-body');
        body.innerText = key;
        element.appendChild(body);
        col.appendChild(element);
        return col;
    }

    function createFileElement(name, folder, id) {
        var col = document.createElement('div');
        col.classList.add('col');
        var element = document.createElement('div');
        element.classList.add('fileselect-element');
        element.classList.add('card');
        element.classList.add('mb-3');
        if (id) {
            element.setAttribute('id', id);
            if (name.endsWith('.jpg') || name.endsWith('.png')) {
                var image = document.createElement('img');
                image.classList.add('card-img-top');
                image.classList.add('pt-3');
                image.src = folder + '/' + name;
                element.appendChild(image);
            } else {
                var image = document.createElement('span');
                image.classList.add('card-img-top');
                image.classList.add('m-auto');
                image.classList.add('pt-3');
                image.innerHTML = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"40\" height=\"40\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-file\"><path d=\"M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z\"></path><polyline points=\"13 2 13 9 20 9\"></polyline></svg>";
                element.appendChild(image);
            }
            var body = document.createElement('div');
            body.classList.add('card-body');
            body.innerText = folder + '/' + name;
            element.appendChild(body);
        } else {
            element.classList.add('noselection');
            var image = document.createElement('span');
            image.classList.add('card-img-top');
            image.classList.add('m-auto');
            image.classList.add('pt-3');
            image.innerHTML = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"40\" height=\"40\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-x\"><line x1=\"18\" y1=\"6\" x2=\"6\" y2=\"18\"></line><line x1=\"6\" y1=\"6\" x2=\"18\" y2=\"18\"></line></svg>";
            element.appendChild(image);
            var body = document.createElement('div');
            body.classList.add('card-body');
            body.innerText = name;
            element.appendChild(body);
        }
        col.appendChild(element);
        return col;
    }

    function createParentFolderElement(data) {
        var col = document.createElement('div');
        col.classList.add('col');
        var element = document.createElement('div');
        element.setAttribute('data-fileselect-list', JSON.stringify(data));
        element.classList.add('fileselect-element');
        element.classList.add('card');
        element.classList.add('mb-3');
        var image = document.createElement('span');
        image.classList.add('card-img-top');
        image.classList.add('m-auto');
        image.classList.add('pt-3');
        image.innerHTML = "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"40\" height=\"40\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"feather feather-arrow-up\"><line x1=\"12\" y1=\"19\" x2=\"12\" y2=\"5\"></line><polyline points=\"5 12 12 5 19 12\"></polyline></svg>";
        element.appendChild(image);
        var body = document.createElement('div');
        body.classList.add('card-body')
        body.innerText = '..';
        element.appendChild(body);
        col.appendChild(element);
        return col;
    }

}(jQuery));
