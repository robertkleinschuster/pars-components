$(document).ready(function () {
    $('body').on('click', '.select-all', function (event) {
        let that = this;
        [].forEach.call(document.getElementsByName(this.getAttribute('data-name')), function (el, i) {
            el.checked = that.checked;
        });
    });
});
