document.addEventListener('DOMContentLoaded', function () {
    const courseSelect = document.getElementById('courseSelect');
    const subjectSelect = document.getElementById('subjectSelect');

    // Salva la materia già selezionata (in caso di edit)
    const currentSubject = subjectSelect.value;

    // Al caricamento della pagina, se c'è già un corso selezionato (modalità edit)
    // carica le sue materie
    if (courseSelect.value) {
        loadSubjectsIntoSelect(courseSelect.value, subjectSelect, currentSubject, true);
    }

    // Ascolta il cambio di selezione del corso
    courseSelect.addEventListener('change', function () {
        loadSubjectsIntoSelect(this.value, subjectSelect);
    });

});