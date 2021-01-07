$(document).ready(function () {
    $('body').on('click.confirmModal', '.confirm-modal', handleConfirmModal);
});

function handleConfirmModal(event) {
    event.preventDefault();
    document.getElementById('confirm-modal-title').innerText = this.getAttribute('data-confirm-title');
    if (this.hasAttribute('data-confirm-cancel')) {
        document.getElementById('confirm-modal-cancel').innerText = this.getAttribute('data-confirm-cancel');
    }
    document.getElementById('confirm-modal-submit').innerHTML = this.innerHTML;
    document.getElementById('confirm-modal-submit').classList = this.classList;
    document.getElementById('confirm-modal-submit').classList.remove('confirm-modal', 'mr-1');
    let that = this;
    document.getElementById('confirm-modal-submit').addEventListener('click', function (event) {
        $('body').off('click.confirmModal');
        that.click();
    });
}
