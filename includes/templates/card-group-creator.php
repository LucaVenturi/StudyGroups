<!-- ANNUNCIO -->
        <article class="card border-primary mb-3 shadow-sm">
            <header class="card-header d-flex justify-content-between align-items-center">
                <h2 class="card-title h5 mb-0"><?= htmlspecialchars($group['titolo'] ?? '') ?></h2>
                <span class="badge bg-primary fs-6"><?= $group['num_partecipanti'] ?>/<?= $group['max_partecipanti'] ?></span>
            </header>

            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <strong>Materia:</strong>
                        <?= htmlspecialchars($group['materia'] ?? '') ?>
                    </li>
                    <li class="mb-2">
                        <strong>Corso di laurea:</strong>
                        <?= htmlspecialchars($group['corso_di_laurea'] ?? '') ?>
                    </li>
                    <li>
                        <strong>Data esame:</strong>
                        <time datetime="<?= htmlspecialchars($group['data_esame'] ?? '') ?>"><?= date('d/m/Y', strtotime($group['data_esame'] ?? 'now')) ?>
                        </time>
                    </li>
                </ul>
            </div>

            <footer class="card-footer d-flex justify-content-between align-items-center">
                <p> Sei il creatore dell'annuncio </p>
                <!-- Pulsante per i dettagli dell'annuncio -->
                <a href="#" class="btn btn-outline-primary btn-sm">Dettagli annuncio</a>
                <!-- Pulsante per modificare l'annuncio -->
                <a href="#" class="btn btn-outline-secondary btn-sm">Modifica annuncio</a>
                <!-- Pulsante per eliminare l'annuncio -->
                <a href="#" class="btn btn-outline-danger btn-sm">Elimina annuncio</a>
            </footer>
        </article>