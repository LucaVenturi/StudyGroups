<?php
$isLoggedIn = isUserLoggedIn();
$user = $isLoggedIn ? getLoggedUser() : null;
$displayName = $user ? htmlspecialchars(trim($user['nome'] . ' ' . $user['cognome'])) : '';
?>

<!-- Hero principale -->
<section class="container-fluid p-5 text-center bg-body-secondary text-dark">
    <?php if ($isLoggedIn): ?>
        <h1 class="display-4 fw-bold mb-4">Bentornato, <?= $displayName ?>!</h1>
        <p class="lead fw-normal fs-4 mb-4">Continua a studiare con il tuo gruppo o esplorane di nuovi.</p>
        <nav aria-label="Azioni principali">
            <a class="btn btn-primary btn-lg me-2 mb-2" href="miei-gruppi.php">I miei gruppi</a>
            <a class="btn btn-outline-primary btn-lg mb-2" href="trova-gruppi.php">Esplora gruppi</a>
        </nav>
    <?php else: ?>
        <h1 class="display-4 fw-bold mb-4">Benvenuto su StudyGroups</h1>
        <p class="lead fw-normal fs-4 mb-4">Il tuo punto di riferimento per trovare e creare gruppi di studio efficaci.</p>
        <nav aria-label="Azioni principali">
            <a class="btn btn-outline-primary btn-lg me-2 mb-2" href="trova-gruppi.php">Esplora il sito</a>
            <a class="btn btn-primary btn-lg mb-2" href="login.php">Accedi</a>
        </nav>
    <?php endif; ?>
</section>

<!-- Come funziona (solo per utenti non loggati) -->
<?php if (!$isLoggedIn): ?>
<section class="container-fluid p-5 bg-body">
    <h2 class="text-center fw-bold mb-5">Come funziona</h2>
    <div class="row g-4 justify-content-center">
        <article class="col-lg-4 col-md-6">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <span class="fs-4 fw-bold">1</span>
                    </div>
                    <h3 class="card-title fw-bold">Registrati</h3>
                    <p class="card-text">Crea un account gratuito per accedere a tutte le funzionalità del sito</p>
                </div>
            </div>
        </article>
        <article class="col-lg-4 col-md-6">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body">
                    <div class="bg-secondary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <span class="fs-4 fw-bold">2</span>
                    </div>
                    <h3 class="card-title fw-bold">Trova un gruppo</h3>
                    <p class="card-text">Unisciti a un gruppo che studia la materia a cui sei interessato o crea il tuo gruppo</p>
                </div>
            </div>
        </article>
        <article class="col-lg-4 col-md-6">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body">
                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <span class="fs-4 fw-bold">3</span>
                    </div>
                    <h3 class="card-title fw-bold">Studia insieme</h3>
                    <p class="card-text">Organizzati con i membri del gruppo per studiare insieme! Studiare in compagnia è più efficace!</p>
                </div>
            </div>
        </article>
    </div>
</section>
<?php endif; ?>

<!-- Sezione per utenti loggati: accesso rapido -->
<?php if ($isLoggedIn): ?>
<section class="container-fluid p-5 bg-body">
    <h2 class="text-center fw-bold mb-5">Cosa vuoi fare?</h2>
    <div class="row g-4 justify-content-center">
        <article class="col-lg-4 col-md-6">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-people-fill fs-4"></i>
                    </div>
                    <h3 class="card-title fw-bold">I miei gruppi</h3>
                    <p class="card-text">Visualizza e gestisci i gruppi di studio a cui appartieni.</p>
                    <a href="miei-gruppi.php" class="btn btn-outline-primary mt-2">Vai ai miei gruppi</a>
                </div>
            </div>
        </article>
        <article class="col-lg-4 col-md-6">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body">
                    <div class="bg-secondary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-search fs-4"></i>
                    </div>
                    <h3 class="card-title fw-bold">Trova un gruppo</h3>
                    <p class="card-text">Esplora i gruppi disponibili e unisciti a quelli che ti interessano.</p>
                    <a href="trova-gruppi.php" class="btn btn-outline-secondary mt-2">Esplora gruppi</a>
                </div>
            </div>
        </article>
        <article class="col-lg-4 col-md-6">
            <div class="card h-100 text-center shadow-sm">
                <div class="card-body">
                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-person-fill fs-4"></i>
                    </div>
                    <h3 class="card-title fw-bold">Il mio profilo</h3>
                    <p class="card-text">Aggiorna le tue informazioni personali e le tue preferenze.</p>
                    <a href="profilo.php" class="btn btn-outline-success mt-2">Vai al profilo</a>
                </div>
            </div>
        </article>
    </div>
</section>
<?php endif; ?>

<!-- Call to action -->
<section class="container-fluid p-5 text-center bg-body-secondary text-dark">
    <?php if ($isLoggedIn): ?>
        <h2 class="fw-bold mb-3">Crea un nuovo gruppo!</h2>
        <p class="lead mb-4">Non trovi quello che cerchi? Crea tu un gruppo di studio!</p>
        <a class="btn btn-dark btn-lg" href="/StudyGroups/public/gestisci-gruppo.php?action=insert">Crea un gruppo</a>
    <?php else: ?>
        <h2 class="fw-bold mb-3">Pronto per iniziare?</h2>
        <p class="lead mb-4">Unisciti ad altri studenti che stanno già usando StudyGroups!</p>
        <a class="btn btn-dark btn-lg" href="register.php">Registrati ora</a>
    <?php endif; ?>
</section>