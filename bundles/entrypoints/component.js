import '../scss/component.scss';
import 'bootstrap/dist/css/bootstrap.css';
import {Editor} from "../js/editor/editor";

document.addEventListener("DOMContentLoaded",  () => initComponents(document.body));
window.viewEventHandler.listeners.push(initComponents);

function initComponents(root, event = null) {
    Editor.init(root);
}
