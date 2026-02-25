<div class="container py-4">
    <h1 class="visually-hidden">Gestione materie</h1>

    <!-- Selezione corso -->
    <div class="card border-primary mb-4">
        <div class="card-header">
            <h2 class="card-title fw-bold mb-0 h4">
                Seleziona corso di laurea
            </h2>
        </div>
        <div class="card-body">
            <form method="GET" action="" id="formCourse">
                <div class="form-floating">
                    <select name="course_id" id="courseSelect" class="form-select">
                        <option value="">Seleziona corso</option>
                        <?php foreach ($templateParams['courses'] as $course): ?>
                            <option value="<?= $course['id'] ?>"
                                <?= ($_GET['course_id'] ?? '') == $course['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($course['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="courseSelect" class="form-label">Corso di laurea</label>
                </div>
            </form>
        </div>
    </div>

    <!-- Se un corso è stato selezionato allora mostra le materie del corso -->
    <?php if (!empty($_GET['course_id'])): ?>
        <?php $courseId = (int)$_GET['course_id']; ?>

        <!-- Aggiungi materia -->
        <div class="card border-primary mb-4">
            <div class="card-header">
                <h2 class="card-title fw-bold mb-0 h4">
                    Aggiungi una materia
                </h2>    
            </div>
            <div class="card-body">
                <form method="POST" action="/StudyGroups/includes/actions/subject-actions/create.php">
                    <input type="hidden" name="course_id" value="<?= $courseId ?>" />
                    <div class="input-group">
                        <div class="form-floating">
                            <input
                                type="text"
                                name="name"
                                id="nameInput"
                                class="form-control"
                                placeholder="Nome materia"
                                required
                            />
                            <label for="nameInput">Nome materia</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Aggiungi</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Lista materie -->
        <div class="card border-primary">
            <div class="card-header">
                <h2 class="card-title fw-bold mb-0 h4">
                    Materie del corso
                </h2>    
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="">
                            <tr>
                                <th scope="col">Nome</th>
                                <th scope="col" class="text-end">Azioni</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle">
                            <?php foreach ($dbHelper->getSubjectsByCourse($courseId) as $s): ?>
                                <tr>
                                    <td><?= htmlspecialchars($s['nome']) ?></td>
                                    <td class="text-end">
                                        <form
                                            method="POST"
                                            action="/StudyGroups/includes/actions/subject-actions/delete.php"
                                            class="d-inline"
                                            onsubmit="return confirm('Eliminare questa materia?')">
                                            <input type="hidden" name="course_id" value="<?= $courseId ?>" />
                                            <input type="hidden" name="name" value="<?= htmlspecialchars($s['nome']) ?>" />
                                            <button
                                                type="submit"
                                                class="btn btn-sm btn-danger text-light"
                                                aria-label="Elimina la materia <?= htmlspecialchars($s['nome']) ?>">
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
        </div>

    <?php endif; ?>

</div>