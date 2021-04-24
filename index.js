import './src/Base/base.scss';
import 'bootstrap';
import {Wysiwyg} from "./src/Base/Form/Wysiwyg/Wysiwyg";
import {BulkCheckbox} from "./src/Base/Overview/BulkCheckbox";
import {ParsButton} from "./src/Base/Field/ParsButton";

document.addEventListener("DOMContentLoaded",  () => initComponents(document.body));
window.viewEventHandler.listeners.push(initComponents);

function initComponents(root, event = null) {
    Wysiwyg.init(root);
    BulkCheckbox.init(root);
    ParsButton.init(root);
}
