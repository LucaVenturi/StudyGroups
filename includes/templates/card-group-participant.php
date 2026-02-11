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
                <div class="d-flex align-items-center gap-2">
                    <img src="<?= htmlspecialchars($group['foto_profilo_creatore'] ?? '../assets/img/default-profile.jpg') ?>" alt="Foto profilo" width="40" height="40"
                        class="rounded-circle object-fit-cover">
                    <span class="fw-semibold"><?= htmlspecialchars($group['nome_creatore'] ?? '') ?> <?= htmlspecialchars($group['cognome_creatore'] ?? '') ?></span>
                </div>
                <!-- Pulsante per i dettagli dell'annuncio -->
                <a href="#" class="btn btn-outline-primary btn-sm">Dettagli annuncio</a>
                <!-- Pulsante per uscire dal gruppo -->
                <a href="#" class="btn btn-outline-danger btn-sm">Esci dal gruppo</a>
            </footer>
        </article>