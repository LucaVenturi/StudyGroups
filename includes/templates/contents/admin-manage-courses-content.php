<div class="container-fluid py-4">
    <h1 class="visually-hidden">Gestione corsi</h1>

    <!-- Messaggi di errore e successo -->
    <?php if ($templateParams['success']): ?>
        <div class="alert alert-success" role="alert"><?= htmlspecialchars($templateParams['success']) ?></div>
    <?php endif; ?>
    <?php if ($templateParams['error']): ?>
        <div class="alert alert-danger" role="alert"><?= htmlspecialchars($templateParams['error']) ?></div>
    <?php endif; ?>

    <!-- Form per aggiungere un corso -->
    <div class="card border-primary mb-4">
        <div class="card-header">
            <h2 class="card-title fw-bold mb-0 h4">
                Aggiungi nuovo corso
            </h2>    
        </div>
        <div class="card-body">
            <form method="POST" action="/StudyGroups/includes/actions/course-actions/insert.php">
                <label for="nameInsert" class="form-label">Nome corso</label>
                <div class="input-group">
                    <input type="text" name="name" id="nameInsert" class="form-control" placeholder="es. Informatica" required />
                    <button type="submit" class="btn btn-primary">Aggiungi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Lista corsi esistenti -->
    <div class="card border-primary mb-4">
        <div class="card-header">
            <h2 class="card-title fw-bold mb-0 h4">
                Corsi esistenti
            </h2>    
        </div>
        <div class="card-body p-0">
            <table class="table table-striped table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th class="text-end">Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($templateParams['courses'] as $course): ?>
                        <tr>
                            <td><?= $course['id'] ?></td>
                            <td>
                                <span class="d-inline-block" id="course-name-<?= $course['id'] ?>"><?= htmlspecialchars($course['nome']) ?></span>
                                <!-- Form modifica (inizialmente nascosto) -->
                                <form method="POST" action="/StudyGroups/includes/actions/course-actions/edit.php" class="d-none" id="edit-form-<?= $course['id'] ?>">
                                    <div class="input-group">
                                        <input type="hidden" name="course_id" value="<?= $course['id'] ?>" />
                                        <label for="nameEdit<?= $course['id'] ?>" class="visually-hidden">Nome corso</label>
                                        <input type="text" name="name" id="nameEdit<?= $course['id'] ?>" value="<?= htmlspecialchars($course['nome']) ?>" class="form-control form-control-sm" required />
                                        <button type="submit" class="btn btn-sm btn-success">Salva</button>
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="cancelEdit(<?= $course['id'] ?>)">Annulla</button>
                                    </div>
                                </form>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary" onclick="enableEdit(<?= $course['id'] ?>)">Modifica</button>
                                <form method="POST" action="/StudyGroups/includes/actions/course-actions/delete.php" class="d-inline" onsubmit="return confirm('Eliminare il corso? Verranno eliminate anche le materie associate.')">
                                    <input type="hidden" name="course_id" value="<?= $course['id'] ?>" />
                                    <button type="submit" class="btn btn-sm btn-danger text-light">Elimina</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function enableEdit(id) {
        document.getElementById('course-name-' + id).classList.add('d-none');
        document.getElementById('edit-form-' + id).classList.remove('d-none');
    }

    function cancelEdit(id) {
        document.getElementById('course-name-' + id).classList.remove('d-none');
        document.getElementById('edit-form-' + id).classList.add('d-none');
    }
</script>