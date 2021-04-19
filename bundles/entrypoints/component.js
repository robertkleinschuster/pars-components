import '../scss/component.scss';
import 'bootstrap';
import {Editor} from "../js/Editor/Editor";

document.addEventListener("DOMContentLoaded",  () => initComponents(document.body));
window.viewEventHandler.listeners.push(initComponents);

function initComponents(root, event = null) {
    Editor.init(root);
}
