import './src/Base/base.scss';
import 'bootstrap';
import {Wysiwyg} from "./src/Base/Form/Wysiwyg/Wysiwyg";

document.addEventListener("DOMContentLoaded",  () => initComponents(document.body));
window.viewEventHandler.listeners.push(initComponents);

function initComponents(root, event = null) {
    Wysiwyg.init(root);
}
