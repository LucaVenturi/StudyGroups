<div class="container-fluid py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <h1 class="fw-bold text-center mb-3">
                Crea il tuo account
            </h1>
            <p class="text-center text-muted mb-4">
                Compila il form per iniziare a trovare gruppi di studio!
            </p>
        </div>
    </div>

    <div class="row justify-content-center">
        <form
            class="col-lg-6 col-md-8 col-sm-12 p-4 p-md-5 border rounded-3 shadow-sm bg-white"
            action="/StudyGroups/includes/api/process-registration.php"
            method="POST">

            <!-- Nome -->
            <div class="mb-3">
                <label for="nameInput" class="form-label fw-semibold">
                    Nome <span class="text-danger">*</span>
                </label>
                <input
                    type="text"
                    class="form-control"
                    id="nameInput"
                    name="name"
                    placeholder="Mario"
                    required
                    autocomplete="given-name" />
            </div>

            <!-- Cognome -->
            <div class="mb-3">
                <label for="surnameInput" class="form-label fw-semibold">
                    Cognome <span class="text-danger">*</span>
                </label>
                <input
                    type="text"
                    class="form-control"
                    id="surnameInput"
                    name="surname"
                    placeholder="Rossi"
                    required
                    autocomplete="family-name" />
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="emailInput" class="form-label fw-semibold">
                    Email <span class="text-danger">*</span>
                </label>
                <input 
                    type="email" 
                    class="form-control" 
                    id="emailInput" 
                    name="email"
                    placeholder="nome.cognome@studio.unibo.it" 
                    required 
                    autocomplete="email" />
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="passwordInput" class="form-label fw-semibold">
                    Password <span class="text-danger">*</span>
                </label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="passwordInput" 
                    name="password"
                    placeholder="Inserisci una password sicura" 
                    minlength="8" 
                    required
                    autocomplete="new-password" 
                    aria-describedby="passwordHelp" />
                <div id="passwordHelp" class="form-text">
                    Minimo 8 caratteri. Usa lettere, numeri e simboli.
                </div>
            </div>

            <!-- Conferma Password -->
            <div class="mb-3">
                <label for="confirmPasswordInput" class="form-label fw-semibold">
                    Conferma password <span class="text-danger">*</span>
                </label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="confirmPasswordInput" 
                    name="confirm_password"
                    placeholder="Ripeti la password" 
                    minlength="8" 
                    required 
                    autocomplete="new-password" />
            </div>

            <!-- Divider -->
            <hr class="my-4">

            <p class="text-muted small mb-3">
                <strong>Informazioni opzionali</strong> (potrai aggiungerle anche dopo)
            </p>

            <!-- Corso di Laurea (opzionale) -->
            <div class="mb-3">
                <label for="courseInput" class="form-label fw-semibold">
                    Corso di laurea
                </label>
                <select class="form-select" id="courseInput" name="course">
                    <option value="" selected>Seleziona il tuo corso (opzionale)</option>
                    <!-- Aggiunti dal DB -->
                    <?php foreach ($templateParams["courses"] as $course): ?>
                        <option value="<?= $course["id"] ?>"><?= $course["name"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Telegram (opzionale) -->
            <div class="mb-4">
                <label for="telegramInput" class="form-label fw-semibold">
                    Telegram
                </label>
                <div class="input-group">
                    <span class="input-group-text">@</span>
                    <input 
                        type="text" 
                        class="form-control" 
                        id="telegramInput" 
                        name="telegram"
                        placeholder="nomeutente" 
                        pattern="[a-zA-Z0-9_]{5,32}"
                    />
                </div>
                <div class="form-text">
                    Utile per essere contattato dai membri del gruppo
                </div>
            </div>

            <!-- Messaggio di errore registrazione -->
            <?php if (isset($templateParams["registration_error"])): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $templateParams["registration_error"]; ?>
                </div>
            <?php endif; ?>

            <!-- Bottone Submit -->
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-lg">
                    Crea account
                </button>
            </div>

            <!-- Link login -->
            <div class="text-center">
                <p class="mb-0 text-muted">
                    Hai già un account?
                    <a href="login.php" class="text-decoration-none fw-semibold">
                        Accedi
                    </a>
                </p>
            </div>

        </form>
    </div>
</div>