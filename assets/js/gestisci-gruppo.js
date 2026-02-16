document.addEventListener('DOMContentLoaded', function () {
    const courseSelect = document.getElementById('course_id');
    const subjectSelect = document.getElementById('subject');

    // Salva la materia già selezionata (in caso di edit)
    const currentSubject = subjectSelect.value;

    // Al caricamento della pagina, se c'è già un corso selezionato (modalità edit)
    // carica le sue materie
    if (courseSelect.value) {
        loadSubjects(courseSelect.value, currentSubject);
    }

    // Ascolta il cambio di selezione del corso
    courseSelect.addEventListener('change', function () {
        loadSubjects(this.value);
    });

    // Funzione per caricare le materie
    function loadSubjects(courseId, selectedSubject = null) {
        // Resetta la select delle materie
        subjectSelect.innerHTML = '<option value="" disabled>Caricamento...</option>';
        subjectSelect.disabled = true;

        // Se non è stato selezionato un corso valido
        if (!courseId) {
            subjectSelect.innerHTML = '<option value="" disabled selected>Seleziona prima un corso di laurea</option>';
            return;
        }

        // Chiamata AJAX per recuperare le materie
        fetch(`/StudyGroups/includes/api/get-subjects.php?course_id=${courseId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Errore nel recupero delle materie');
            }
            return response.json();
        })
        .then(data => {
            // Pulisce la select
            subjectSelect.innerHTML = '<option value="" disabled>Seleziona una materia</option>';

            // Popola con le materie ricevute
            data.forEach(subject => {
                const option = document.createElement('option');
                option.value = subject.nome;
                option.textContent = subject.nome;

                // Se questa è la materia che era già selezionata, la imposta come selected
                if (selectedSubject && subject.nome === selectedSubject) {
                    option.selected = true;
                }

                subjectSelect.appendChild(option);
            });

            // Riabilita la select
            subjectSelect.disabled = false;
        })
        .catch(error => {
            console.error('Errore:', error);
            subjectSelect.innerHTML = '<option value="" disabled selected>Errore nel caricamento</option>';
        });
    }
});