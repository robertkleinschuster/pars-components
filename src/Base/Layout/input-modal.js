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
    document.getElementById('input-modal-submit').innerHTML = this.innerHTML;
    document.getElementById('input-modal-submit').classList = this.classList;
    document.getElementById('input-modal-submit').classList.remove('input-modal', 'mr-1');
    let that = this;
    document.getElementById('input-modal-submit').addEventListener('click', function (event) {
        that.removeEventListener('click', handleInputModal);
        that.click();
    });
}
