    <div class="container-fluid p-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-sm-12">
                <h1 class="fw-bold text-center mb-3">
                    Accedi al tuo account
                </h1>
                <p class="text-center text-muted mb-4">
                    Benvenuto! Inserisci le tue credenziali per continuare
                </p>
            </div>
        </div>

        <div class="row justify-content-center">
            <form 
                class="col-lg-5 col-sm-12 p-4 p-md-5 border rounded-3 border-secondary shadow-sm bg-white"
                method="POST"
                action="/StudyGroups/includes/actions/process-login.php"
            >
                <!-- Email -->
                <div class="mb-3">
                    <label for="inputEmail" class="form-label fw-semibold">
                        Indirizzo email <span class="text-danger">*</span>
                    </label>
                    <input 
                        type="email" 
                        class="form-control" 
                        id="inputEmail" 
                        name="email" 
                        placeholder="nome@esempio.com" 
                        required
                        autocomplete="email" 
                    />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="inputPassword" class="form-label fw-semibold">
                        Password <span class="text-danger">*</span>
                    </label>
                    <input
                        type="password" 
                        class="form-control" 
                        id="inputPassword"
                        name="password"
                        placeholder="Inserisci la tua password" 
                        required 
                        autocomplete="current-password" 
                    />
                </div>

                <!-- Messaggio di errore login -->
                <?php if (isset($templateParams["login_error"])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $templateParams["login_error"]; ?>
                    </div>
                <?php endif; ?>
                
                <!-- Ricordami + Password dimenticata (opzionale) -->
                <!-- <div class="mb-3 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">
                            Ricordami
                        </label>
                    </div>
                    <a href="#" class="text-decoration-none small">Password dimenticata?</a>
                </div> -->

                <!-- Bottone Submit -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        Accedi
                    </button>
                </div>

                <!-- Link registrazione -->
                <div class="text-center">
                    <p class="mb-0 text-muted">
                        Non hai ancora un account?
                        <a href="register.php" class="text-decoration-none fw-semibold">
                            Registrati ora
                        </a>
                    </p>
                </div>

            </form>
        </div>
    </div>