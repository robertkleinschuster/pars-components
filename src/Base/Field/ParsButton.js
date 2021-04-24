export class ParsButton {
    static init(element) {
        if (element.matches("button")) {
            this.#initButton(element);
        } else {
            element.querySelectorAll("button")
                .forEach(this.#initButton);
        }
    }
    static #initButton(button)
    {

    }
}