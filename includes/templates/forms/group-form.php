<?php

$action = $templateParams["action"];
$group = $templateParams["group"];

?>

<div class="container-fluid p-3 p-md-5">
    <div class="mx-2 mx-md-5 p-3 p-md-5 border rounded border-primary bg-body">
        <form
            method="POST"
            action="/StudyGroups/includes/actions/group-actions/<?php
                                                            switch ($action) {
                                                                case 'edit':
                                                                    echo "edit.php";
                                                                    break;
                                                                case 'insert':
                                                                    echo "insert.php";
                                                                    break;
                                                                default:
                                                                    echo '#';
                                                                    break;
                                                            }
                                                            ?>">
            <?php if ($action == 'edit') : ?>
                <input type="hidden" name="group_id" value="<?= htmlspecialchars($group["id"]) ?>" />
            <?php endif; ?>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($group["titolo"]) ?>" placeholder="Titolo" required />
                <label for="title" class="form-label">Titolo</label>
            </div>

            <div class="form-floating mb-3">
                <textarea id="description" class="form-control" name="description" placeholder="Descrizione" style="height: 100px;" required><?= $group["descrizione"] ?></textarea>
                <label for="description" class="form-label" required>Descrizione</label>
            </div>

            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="exam_date" name="exam_date" value="<?= htmlspecialchars($group["data_esame"]) ?>" placeholder="data esame" />
                <label for="exam_date" class="form-label">Data esame</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="max_participants" name="max_participants" value="<?= htmlspecialchars($group["max_partecipanti"]) ?>" required />
                <label for="max_participants" class="form-label">Numero massimo di partecipanti</label>
            </div>

            <div class="form-floating mb-3">
                <select id="course_id" class="form-select" name="course_id" required>
                    <option value="" disabled selected>Seleziona un corso di laurea</option>
                    <?php foreach ($templateParams["courses"] as $course): ?>
                        <option value="<?= htmlspecialchars($course["id"]) ?>" <?php echo $course["id"] == $group["id_cdl"] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($course["nome"]) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="course_id" class="form-label">Corso di laurea</label>
            </div>

            <div class="form-floating mb-3">
                <select id="subject" class="form-select" name="subject" disabled required>
                    <?php if (!empty($group["materia"])) : ?>
                        <option value="<?php echo $group["materia"] ?>">
                            <?= htmlspecialchars($group["materia"]) ?>
                        </option>
                    <?php else: ?>
                        <option value="" selected disabled>Seleziona una materia</option>
                    <?php endif; ?>
                </select>
                <label for="subject" class="form-label">Materia</label>
            </div>

            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-primary w-100 w-sm-50 w-md-25 text-center form-control">
                    Salva
                </button>
            </div>
        </form>
    </div>

</div>