import pell from 'pell';
import "pell/dist/pell.min.css"
import {exec} from "pell/dist/pell";
import VanillaCaret from "vanilla-caret-js";
import "./Wysiwyg.css";
import {HtmlHelper} from "../../../../../pars-mvc/src/View/Event/ViewEvent/Helper/HtmlHelper";

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

        let actions = [
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
        ];

        let classes = {
            actionbar: 'actionbar bg-light btn-toolbar border border-bottom-0 rounded-top',
            button: 'btn btn-light',
            content: 'pell-content h-auto border rounded-bottom',
            selected: 'active'
        };

        let serverActions = JSON.parse(wrapper.dataset.actions);
        Object.entries(serverActions).forEach(([key, action]) => {
            if (action.name && !action.dropdown) {
                if (action.command && action.commandValue) {
                    action.result = () => exec(action.command, action.commandValue);
                }
                actions.push(action);
            }
        });

        // Initialize pell on an HTMLElement
        const pellEditor = pell.init({
            // <HTMLElement>, required
            element: editor,

            // <Function>, required
            // Use the output html, triggered by element's `oninput` event
            onChange: html => {
                textarea.innerHTML = html
                content.childNodes.forEach(element => {
                    let regex = new RegExp('\{.*?\}');
                    if (regex.exec(element.innerText) && regex.exec(element.innerText).length) {
                        element.classList.add('wysiwyg-placeholder');
                    } else {
                        element.classList.remove('wysiwyg-placeholder');
                    }
                });
            },

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

            actions: actions,
            // classes<Array[string]> (optional)
            // Choose your custom class names
            classes: classes
        });

        let content = pellEditor.content;
        let actionbar = pellEditor.querySelector('.actionbar');
        const caret = new VanillaCaret(content);
        let caretPosition = null;
        Object.entries(serverActions).forEach(([key, action]) => {
            if (action.name && action.dropdown) {
                const btnGroup = document.createElement('div');
                btnGroup.classList.add('btn-group');
                const dropdownButton = document.createElement('button')
                dropdownButton.className = classes.button
                dropdownButton.classList.add('dropdown-toggle')
                dropdownButton.setAttribute('data-bs-toggle', 'dropdown');
                dropdownButton.innerHTML = action.icon
                dropdownButton.title = action.title
                dropdownButton.setAttribute('type', 'button')
                dropdownButton.onmousedown = () => {
                    caretPosition = caret.getPos();
                };
                btnGroup.appendChild(dropdownButton);
                let dropdown = document.createElement('div');
                dropdown.classList.add('dropdown-menu');
                dropdown.classList.add('dropdown-menu-searchable');
                let dropdownOptions = document.createElement('div');
                dropdownOptions.classList.add('dropdown-menu-searchable-options');
                let filter = document.createElement('input');
                filter.classList.add('dropdown-menu-searchable-filter');
                filter.type = 'text';
                filter.classList.add('form-control');
                filter.onkeyup = () => {
                    let value = filter.value.toUpperCase();
                    dropdownOptions.childNodes.forEach(entry => {
                        if (entry !== filter) {
                            let txtValue = entry.textContent || entry.innerText;
                            if (txtValue.toUpperCase().indexOf(value) > -1) {
                                entry.style.display = "";
                            } else {
                                entry.style.display = "none";
                            }
                        }
                    });
                };
                filter.onblur = () => {
                    caret.setPos(caretPosition);
                    content.focus();
                };
                dropdown.appendChild(filter);
                dropdown.appendChild(dropdownOptions);
                btnGroup.appendChild(dropdown);
                actionbar.appendChild(btnGroup);
                Object.entries(action.dropdown).forEach(([key, subaction]) => {
                    if (subaction.name) {
                        if (subaction.command && subaction.commandValue) {
                            subaction.result = () => exec(subaction.command, subaction.commandValue);
                        }
                        const button = document.createElement('button')
                        button.className = classes.button
                        button.classList.add('dropdown-item');
                        button.innerHTML = subaction.icon
                        button.title = subaction.title
                        button.setAttribute('type', 'button')
                        button.onclick = () => subaction.result() && content.focus()
                        button.onmousedown = () => content.focus();
                        if (action.state) {
                            const handler = () => button.classList[action.state() ? 'add' : 'remove'](classes.selected)
                            addEventListener(content, 'keyup', handler)
                            addEventListener(content, 'mouseup', handler)
                            addEventListener(button, 'click', handler)
                        }
                        dropdownOptions.appendChild(button);
                    }
                });
            }
        });
        pellEditor.content.innerHTML = textarea.innerText;
        content.childNodes.forEach(element => {
            let regex = new RegExp('\{.*?\}');
            if (regex.exec(element.innerText) && regex.exec(element.innerText).length) {
                element.classList.add('wysiwyg-placeholder');
            } else {
                element.classList.remove('wysiwyg-placeholder');
            }
        });
    }

}
