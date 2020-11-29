document.addEventListener("DOMContentLoaded", function (event) {
    let t = document.getElementById('{name}');
    t.classList.add('d-none');
    let e = document.getElementById('edit-{name}');
    e.classList.remove('d-none');
    let toolbarOptions = [
        [{'font': []}],
        [{'size': ['small', false, 'large', 'huge']}],
        ['bold', 'italic', 'underline', 'strike'],
        [{'list': 'ordered'}, {'list': 'bullet'}],
        [{'script': 'sub'}, {'script': 'super'}],
        [{'indent': '-1'}, {'indent': '+1'}],
        [{'align': []}],
        [{'color': []}, {'background': []}],
        ['blockquote', 'code-block'],
        ['link', 'image'],
        ['clean']
    ];
    let q = new Quill('#edit-{name}', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow'
    });
    q.on('text-change', function (delta, oldDelta, source) {
        document.getElementById('{name}').innerText = q.root.innerHTML;
    });
});
