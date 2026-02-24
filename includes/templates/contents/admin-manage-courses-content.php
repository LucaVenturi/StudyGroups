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
        <div class="card-header">Aggiungi nuovo corso</div>
        <div class="card-body">
            <form method="POST" action="/StudyGroups/includes/actions/course-actions/insert.php" class="row g-3">
                <div class="col-md-8">
                    <input type="text" name="name" class="form-control" placeholder="Nome corso (es. Informatica)" required />
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Aggiungi</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Lista corsi esistenti -->
    <div class="card border-primary mb-4">
        <div class="card-header">Corsi esistenti</div>
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
                                        <input type="text" name="name" value="<?= htmlspecialchars($course['nome']) ?>" class="form-control form-control-sm" required />
                                        <button type="submit" class="btn btn-sm btn-success">Salva</button>
                                        <button type="button" class="btn btn-sm btn-secondary" onclick="cancelEdit(<?= $course['id'] ?>)">Annulla</button>
                                    </div>
                                </form>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary" >Modifica</button>
                                <form method="POST" action="/StudyGroups/includes/actions/course-actions/delete.php" class="d-inline" onsubmit="return confirm('Eliminare il corso? Verranno eliminate anche le materie associate.')">
                                    <input type="hidden" name="course_id" value="<?= $course['id'] ?>" />
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Elimina</button>
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