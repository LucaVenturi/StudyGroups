<?php

$action = $templateParams["action"];
$group = $templateParams["group"];

?>

<div class="container-fluid p-5">
    <form method="POST" action="/StudyGroups/includes/api/group-actions/<?php
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
    }?>">
        <ul>
            <input type="hidden" name="group_id" value="<?= $group["id"] ?>" />
            <li>
                <label for="title">Titolo:</label>
                <input type="text" id="title" name="title" value="<?= $group["titolo"] ?>" />
            </li>

            <li>
                <label for="description">Descrizione:</label>
                <textarea id="description" name="description">
                    <?= $group["descrizione"] ?>
                </textarea>
            </li>

            <li>
                <label for="exam_date">Data esame:</label>
                <input type="date" id="exam_date" name="exam_date" value="<?= $group["data_esame"] ?>" />
            </li>

            <li>
                <label for="max_participants">Numero massimo di partecipanti:</label>
                <input type="number" id="max_participants" name="max_participants" value="<?= $group["max_partecipanti"] ?>" />
            </li>

            <li>
                <label for="course_id">Corso di laurea:</label>
                <select id="course_id" name="course_id">
                    <option value="">Seleziona un corso di laurea</option>
                    <?php foreach ($templateParams["courses"] as $course) : ?>
                        <option value="<?= $course["id"] ?>" <?php echo $course["id"] == $group["id_cdl"] ? 'selected' : '' ?>>
                            <?php echo $course["nome"]; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </li>

            <li>
                <label for="subject">Materia:</label>
                <select id="subject" name="subject">
                    <?php if (!empty($group["materia"])) : ?>
                        <option value="<?php echo $group["materia"] ?>">
                            <?= $group["materia"] ?>
                        </option>
                    <?php else: ?>
                        <option value="">Seleziona una materia</option>
                    <?php endif; ?>
                </select>
            </li>

            <li>
                <button type="submit" class="btn btn-primary w-100">
                    Salva
                </button>
            </li>
        </ul>
    </form>

</div>