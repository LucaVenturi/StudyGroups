<div class="container py-4">
    <!-- Selezione corso -->
    <div class="card border-primary mb-4">
        <div class="card-header">Seleziona corso</div>
        <div class="card-body">
            <form method="GET">
                <select name="course_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Seleziona corso</option>
                    <?php foreach ($templateParams['courses'] as $c): ?>
                        <option value="<?= $c['id'] ?>"
                            <?= ($_GET['course_id'] ?? '') == $c['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
    </div>

    <!-- Se un corso è stato selezionato allora mostra le materie del corso -->
    <?php if (!empty($_GET['course_id'])): ?>
        <?php $courseId = (int)$_GET['course_id']; ?>

        <!-- Aggiungi materia -->
        <div class="card border-primary mb-4">
            <div class="card-header">Aggiungi materia</div>
            <div class="card-body">
                <form
                    method="POST"
                    action="/StudyGroups/includes/actions/subject-actions/create.php"
                    class="row g-3"
                >
                    <input type="hidden" name="course_id" value="<?= $courseId ?>" />

                    <div class="col-md-9">
                        <input
                            type="text"
                            name="name"
                            class="form-control"
                            placeholder="Nome materia"
                            required
                        />
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100">
                            Aggiungi
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Lista materie -->
        <div class="card border-primary">
            <div class="card-header">Materie del corso</div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Nome</th>
                            <th class="text-end">Azioni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dbHelper->getSubjectsByCourse($courseId) as $s): ?>
                            <tr>
                                <td><?= htmlspecialchars($s['nome']) ?></td>
                                <td class="text-end">
                                    <form
                                        method="POST"
                                        action="/StudyGroups/includes/actions/subject-actions/delete.php"
                                        class="d-inline"
                                        onsubmit="return confirm('Eliminare questa materia?')"
                                    >
                                        <input type="hidden" name="course_id" value="<?= $courseId ?>" />
                                        <input type="hidden" name="name" value="<?= htmlspecialchars($s['nome']) ?>" />
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            Elimina
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php endif; ?>

</div>