import '../scss/component.scss';
//import Quill from "quill/quill";
import 'bootstrap/dist/css/bootstrap.css';
/*
document.addEventListener("DOMContentLoaded", () => initWysiwyg());
function initWysiwyg() {
    document.querySelectorAll('.wysiwyg-wrap').forEach(
        function (element) {
            element.querySelectorAll('.wysiwyg-textarea').forEach(element => element.classList.add('d-none'));
            element.querySelectorAll('.wysiwyg-editor').forEach(element => element.classList.remove('d-none'));
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
            if (typeof Quill != 'undefined') {
                let q = new Quill('.wysiwyg-editor', {
                    modules: {
                        toolbar: toolbarOptions
                    },
                    theme: 'snow'
                });
                q.on('text-change', function (delta, oldDelta, source) {
                    element.querySelectorAll('.wysiwyg-textarea').forEach(element => element.innerText = q.root.innerHTML);
                });
            }
        }
    );
}
*/
