document.addEventListener("DOMContentLoaded", function () {
    select = document.getElementById("courseSelect");
    form = document.getElementById("formCourse");

    select.addEventListener("change", function () {
        form.submit();
    });
});