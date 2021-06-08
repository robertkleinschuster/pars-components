import './src/Base/base.scss';
import * as bootstrap from 'bootstrap';
import {Wysiwyg} from "./src/Base/Form/Wysiwyg/Wysiwyg";
import {BulkCheckbox} from "./src/Base/Overview/BulkCheckbox";
import {ParsButton} from "./src/Base/Field/ParsButton";

document.addEventListener("DOMContentLoaded",  () => initComponents(document.body));
window.viewEventHandler.listeners.push(initComponents);

function initComponents(root, event = null) {
    Wysiwyg.init(root);
    BulkCheckbox.init(root);
    ParsButton.init(root);
    initTooltips(root);
}

function initTooltips(root)
{
    document.querySelectorAll('.tooltip').forEach(element => element.parentElement.removeChild(element));
    let tooltipTriggerList = [].slice.call(root.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
}
