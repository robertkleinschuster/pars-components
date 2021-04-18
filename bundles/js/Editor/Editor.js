import pell from 'pell';
import "pell/dist/pell.min.css"

export class Editor {

    static init(element) {
        if(element.matches(".wysiwyg-wrap")) {
            this.#initEditor(element);
        } else {
            element.querySelectorAll(".wysiwyg-wrap")
                .forEach(this.#initEditor);
        }
    }

    static #initEditor(wrapper) {
        const editor = wrapper.querySelector('.wysiwyg-editor');
        const textarea = wrapper.querySelector('.wysiwyg-textarea');
        editor.classList.remove("d-none");
        textarea.classList.add("d-none");
        // Initialize pell on an HTMLElement
        const pellEditor = pell.init({
            // <HTMLElement>, required
            element: editor,

            // <Function>, required
            // Use the output html, triggered by element's `oninput` event
            onChange: html => textarea.innerHTML = html,

            // <string>, optional, default = 'div'
            // Instructs the editor which element to inject via the return key
            defaultParagraphSeparator: 'div',

            // <boolean>, optional, default = false
            // Outputs <span style="font-weight: bold;"></span> instead of <b></b>
            styleWithCSS: false,

            // <Array[string | Object]>, string if overwriting, object if customizing/creating
            // action.name<string> (only required if overwriting)
            // action.icon<string> (optional if overwriting, required if custom action)
            // action.title<string> (optional)
            // action.result<Function> (required)
            // Specify the actions you specifically want (in order)

            // classes<Array[string]> (optional)
            // Choose your custom class names
            classes: {
                actionbar: 'pell-actionbar',
                button: 'pell-button',
                content: 'pell-content h-auto border',
                selected: 'pell-button-selected'
            }
        });

        pellEditor.content.innerHTML = textarea.innerText
    }

}