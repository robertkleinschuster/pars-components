let modals = document.getElementsByClassName('input-modal');
[].forEach.call(modals, function (el) {
    el.addEventListener('click', handleInputModal);
});
function handleInputModal(event)
{
    event.preventDefault();
    document.getElementById('input-modal-title').innerText = this.getAttribute('data-input-title');
    if (this.hasAttribute('data-input-cancel')) {
        document.getElementById('input-modal-cancel').innerText = this.getAttribute('data-input-cancel');
    }
    document.getElementById('input-modal-submit').innerHTML = this.getAttribute('data-submit-content');
    document.getElementById('input-modal-submit').classList = this.getAttribute('data-submit-class');
}
