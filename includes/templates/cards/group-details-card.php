<?php

/**
 * Componente card gruppo riutilizzabile
 * 
 * @param array  $group   Dati del gruppo (id, titolo, num_partecipanti, max_partecipanti, materia, corso_di_laurea, data_esame, ...)
 * @param string $context Contesto: 'list', 'participant', 'creator' (default 'list')
 */
$context = $context ?? 'list';
?>

<article class="card border-primary mb-3 shadow-sm">
    <header class="card-header d-flex justify-content-between align-items-center">
        <h2 class="card-title h5 mb-0 text-truncate"><?= htmlspecialchars($group['titolo'] ?? '') ?></h2>
        <span class="badge bg-primary fs-6 flex-shrink-0"><?= $group['num_partecipanti'] + 1 ?>/<?= $group['max_partecipanti'] ?></span>
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
                <time datetime="<?= htmlspecialchars($group['data_esame'] ?? '') ?>">
                    <?= date('d/m/Y', strtotime($group['data_esame'] ?? 'now')) ?>
                </time>
            </li>
        </ul>
    </div>

    <footer class="card-footer d-flex justify-content-between align-items-center gap-2 flex-wrap">

        <?php if ($context === 'creator'): ?>
            <p class="mb-0 small text-muted">Sei il creatore dell'annuncio</p>
        <?php else: ?>
            <div class="d-flex align-items-center gap-2">
                <?php
                $foto = $group['foto_profilo_creatore'] ?? '';
                $nome = $group['nome_creatore'] ?? '';
                $cognome = $group['cognome_creatore'] ?? '';

                if (!empty($foto)) : ?>
                    <img 
                        src="<?= htmlspecialchars($foto) ?>"
                        alt=""
                        width="40" height="40"
                        class="rounded-circle object-fit-cover border"
                    />
                <?php else :
                    // Calcola le iniziali (prima lettera di nome e cognome)
                    $iniziali = strtoupper(substr($nome, 0, 1) . substr($cognome, 0, 1));
                    if (empty(trim($iniziali))) {
                        $iniziali = '?'; // Se entrambi vuoti
                    }
                ?>
                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold border"
                        style="width: 40px; height: 40px;">
                        <?= $iniziali ?>
                    </div>
                <?php endif; ?>

                <span class="fw-semibold small">
                    <?= htmlspecialchars($nome) ?> <?= htmlspecialchars($cognome) ?>
                </span>
            </div>
        <?php endif; ?>

        <div class="d-flex gap-2 flex-wrap">
            <a href="/StudyGroups/public/dettagli-gruppo.php?id=<?= (int)$group['id'] ?>"
                class="btn btn-outline-primary btn-sm">
                Dettagli
            </a>

            <?php if ($context === 'creator'): ?>
                <a href="/StudyGroups/public/gestisci-gruppo.php?group_id=<?= (int)$group['id'] ?>&action=edit"
                    class="btn btn-outline-secondary btn-sm">
                    Modifica
                </a>

                <form method="POST" action="/StudyGroups/includes/actions/group-actions/delete.php" class="d-inline-block">
                    <input type="hidden" name="group_id" value="<?= (int)$group['id'] ?>" />
                    <button type="submit" class="btn btn-outline-danger btn-sm">
                        Elimina
                    </button>
                </form>

            <?php elseif ($context === 'participant'): ?>
                <form method="POST" action="/StudyGroups/includes/actions/group-actions/leave.php" class="d-inline-block">
                    <input type="hidden" name="group_id" value="<?= (int)$group['id'] ?>" />
                    <button type="submit" class="btn btn-outline-secondary btn-sm">
                        Abbandona
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </footer>
</article>