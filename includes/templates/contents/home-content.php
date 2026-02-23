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
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                            </svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                            </svg>
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