<?php

$editMode = $templateParams["isEditMode"] ?? false;
$user = $templateParams["user"];

?>

<div class="mx-5 my-3 card border border-primary shadow p-3 bg-body text-dark">

    <form method="POST" action="/StudyGroups/includes/api/edit-profile.php" enctype="multipart/form-data">
        <section class="row mb-3 align-items-center">
            <div class="col-12">
                <h2>Foto profilo</h2>
            </div>

            <div class="col-auto">
                <img
                    src="../assets/img/<?php echo htmlspecialchars($user['foto_profilo'] ?? 'GiuseppeVerdi.jpg') ?>"
                    width="80"
                    height="80"
                    class="rounded-circle object-fit-cover border"
                    alt="Foto profilo"
                />
            </div>

            <?php if ($editMode): ?>
                <div class="col-md mt-3 mt-md-0">
                    <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                    <input
                        type="file"
                        class="form-control"
                        name="foto_profilo"
                        accept="image/*"
                    />
                </div>
            <?php endif; ?>
        </section>

        <section class="row g-3">
            <div class="col-12">
                <h2>Dati personali</h2>
            </div>

            <div class="col-md">
                <div class="form-floating mb-3">
                    <input 
                        <?= $editMode ? '' : 'readonly' ?> 
                        type="text" 
                        class="form-control" 
                        id="nameInput" 
                        name="name" 
                        placeholder="nome" 
                        value="<?= htmlspecialchars($user["nome"]) ?>" 
                        required
                    />
                    <label for="nameInput">Nome</label>
                </div>
            </div>

            <div class="col-md">
                <div class="form-floating mb-3">
                    <input 
                        <?= $editMode ? '' : 'readonly' ?> 
                        type="text" 
                        class="form-control" 
                        id="surnameInput" 
                        name="surname" 
                        placeholder="cognome" 
                        value="<?= htmlspecialchars($user["cognome"]) ?>" 
                        required
                    />
                    <label for="nameInput">Cognome</label>
                </div>
            </div>

            <div class="col-12">
                <div class="form-floating mb-3">
                    <select <?= $editMode ? '' : 'disabled' ?> class="form-select" id="courseInput" name="course">
                        <option value="" selected>Nessun corso selezionato</option>
                        <?php foreach ($templateParams["courses"] as $course): ?>
                            <option value="<?= $course["id"] ?>" <?php echo $user["id_cdl"] == $course["id"] ? 'selected' : ''?>>
                                <?php echo htmlspecialchars($course["nome"]) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label for="courseInput">Corso di laurea</label>
                </div>
            </div>
        </section>

        <section class="row g-3">
            <div class="col-12">
                <h2>Contatti</h2>
            </div>

            <!-- Colonna email -->
            <div class="col-md">
                <div class="form-floating mb-3">
                    <input 
                        <?= $editMode ? '' : 'readonly' ?> 
                        type="email" 
                        class="form-control" 
                        id="emailInput" 
                        name="email" 
                        placeholder="email"
                        value="<?= htmlspecialchars($user["email"]) ?>" 
                        required
                    />
                    <label for="emailInput">Email</label>
                </div>
                <?php if ($editMode): ?>
                <span class="form-text">Attenzione, modificando la mail si modifica anche il metodo di login.</span>
                <?php endif; ?>
            </div>

            <!-- Colonna telegram -->
            <div class="col-md">
                <div class="input-group mb-3">
                    <span class="input-group-text">@</span>
                    <div class="form-floating">
                        <input 
                            <?= $editMode ? '' : 'readonly' ?> 
                            type="text" 
                            class="form-control" 
                            id="telegramInput" 
                            name="telegram" 
                            placeholder="Telegram"
                            value="<?= htmlspecialchars($user["telegram"] ?? '') ?>">
                        <label for="telegramInput">Telegram</label>
                    </div>
                </div>
                <?php if ($editMode): ?>
                <span class="form-text">Inserisci il tuo username Telegram SENZA la chiocciola (@).</span>
                <?php endif; ?>
            </div>
        </section>

                <!-- Eventuale messaggio di errore -->
        <?php if (isset($templateParams["profile_update_error"])): ?>
            <section class="row g-3">
                <span class="form-text"><?php echo $templateParams["profile_update_error"] ?></span>
            </section>
        <?php endif; ?>

        <footer class="row mt-3 justify-content-end">
            <?php if ($editMode): ?>
                <div class="col-auto">
                    <a href="?edit=0" class="btn btn-secondary">Annulla</a>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Salva</button>
                </div>
            <?php else: ?>
                <div class="col-auto">
                    <a href="?edit=1" class="btn btn-primary">Modifica</a>
                </div>
            <?php endif; ?>
        </footer>
    </form>

    <hr>

    <!-- Sezione statistiche -->
    <section class="row g-3">
        <div class="col-12">
            <h2>Statistiche</h2>
        </div>
        <div class="col-md">
            <p>Numero gruppi creati: <?= $templateParams["count_created"] ?? "errore" ?></p>
        </div>
        <div class="col-md">
            <p>Numero gruppi a cui partecipi: <?= $templateParams["count_joined"] ?? "errore" ?></p>
        </div>
    </section>
</div>
