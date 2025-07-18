import "./bootstrap";
import Alpine from "alpinejs";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("DOMContentLoaded", () => {
    ClassicEditor.create(document.querySelector("#description"), {
        toolbar: ["bold", "italic", "bulletedList"],
    });
});
