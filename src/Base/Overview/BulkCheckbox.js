export class BulkCheckbox {
    static init(element) {
        if (element.matches(".bulk-all")) {
            this.#initBulkCheckbox(element);
        } else {
            element.querySelectorAll(".bulk-all")
                .forEach(this.#initBulkCheckbox);
        }
    }

    static #initBulkCheckbox(element) {
        const name = element.dataset.name;
        const form = element.closest('form');
        element.addEventListener('change', event => {
            form.querySelectorAll('.bulk[name="' + name + '"]').forEach(checkbox => {
                checkbox.checked = element.checked;
            });
        });
        form.querySelectorAll('.bulk').forEach(checkbox => {
            checkbox.addEventListener('change', event => {
                if (form.querySelectorAll('.bulk:checked').length) {
                    form.querySelectorAll('.bulk-button').forEach(button => {
                        button.classList.remove('d-none');
                    });
                } else {
                    form.querySelectorAll('.bulk-button').forEach(button => {
                        button.classList.add('d-none');
                    });
                }
            });
        });
    }
}