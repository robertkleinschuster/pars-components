import pell from 'pell';
import "pell/dist/pell.min.css"
import {exec} from "pell/dist/pell";

export class Wysiwyg {

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

            actions: [
                'bold',
                'italic',
                'underline',
                'strikethrough',
                'olist',
                'ulist',
                {
                    name: 'heading',
                    icon: '<b>H</b>',
                    title: 'Heading',
                    result: () => exec('formatBlock', '<h4>')
                },
                {
                    name: 'heading',
                    icon: 'P',
                    title: 'Heading',
                    result: () => exec('formatBlock', '<p>')
                },
                {
                    name: 'div',
                    icon: 'DIV',
                    title: 'DIV',
                    result: () => exec('formatBlock', '<div>')
                },
            ],
            // classes<Array[string]> (optional)
            // Choose your custom class names
            classes: {
                actionbar: 'bg-light border border-bottom-0',
                button: 'btn btn-secondary',
                content: 'pell-content h-auto border',
                selected: 'active'
            }
        });

        pellEditor.content.innerHTML = textarea.innerText
    }

}
