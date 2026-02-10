<?php

$groups = $templateParams["groups"] ?? [];

?>

<?php if (empty($groups)) : ?>
    <div class="alert alert-info text-center" role="alert">
        Nessun gruppo trovato. Prova ad ampliare i filtri di ricerca.
    </div>
<?php else : ?>
    <?php foreach ($groups as $group) : ?>
        <!-- ANNUNCIO 1 -->
        <article class="card border-primary mb-3 shadow-sm">
            <header class="card-header d-flex justify-content-between align-items-center">
                <h2 class="card-title h5 mb-0"></h2>
                <span class="badge bg-primary fs-6">5 / 10</span>
            </header>

            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><strong>Materia:</strong> Analisi Matematica 1</li>
                    <li class="mb-2"><strong>Corso di laurea:</strong> Ingegneria Informatica</li>
                    <li><strong>Data esame:</strong> <time datetime="2026-06-15">15/06/2026</time></li>
                </ul>
            </div>

            <footer class="card-footer d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <img src="../assets/img/GiuseppeVerdi.jpg" alt="Foto profilo" width="40" height="40"
                        class="rounded-circle object-fit-cover">
                    <span class="fw-semibold">Giuseppe Verdi</span>
                </div>
                <a href="#" class="btn btn-outline-primary btn-sm">Dettagli annuncio</a>
            </footer>
        </article>
    <?php endforeach; ?>
<?php endif; ?>