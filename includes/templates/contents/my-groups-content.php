<?php
$gruppiPartecipante = $templateParams["groups_partecipting_in"] ?? [];
$gruppiCreati = $templateParams["groups_created"] ?? [];
?>

<div class="container py-4">
    <h1 class="visually-hidden">I miei gruppi</h1>
    
    <div class="card border-primary shadow-sm">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs nav-fill" id="miei-gruppiTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button 
                        class="nav-link <?= $templateParams["tab"] === 'joined' ? 'active' : '' ?> fw-semibold" 
                        id="partecipo-tab" 
                        data-bs-toggle="tab" 
                        data-bs-target="#partecipo" 
                        type="button" 
                        role="tab" 
                        aria-controls="partecipo" 
                        aria-selected="<?= $templateParams["tab"] === 'joined' ? 'true' : 'false' ?>"
                    >
                        Gruppi a cui partecipo
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button 
                        class="nav-link <?= $templateParams["tab"] === 'created' ? 'active' : '' ?> fw-semibold" 
                        id="creati-tab" 
                        data-bs-toggle="tab" 
                        data-bs-target="#creati" 
                        type="button" 
                        role="tab" 
                        aria-controls="creati" 
                        aria-selected="<?= $templateParams["tab"] === 'created' ? 'true' : 'false' ?>"
                    >
                        Creati da me
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body tab-content" id="miei-gruppiTabContent">

            <!-- TAB 1: PARTECIPO -->
            <div class="tab-pane fade <?= $templateParams["tab"] === 'joined' ? 'show active' : '' ?>" id="partecipo" role="tabpanel" aria-labelledby="partecipo-tab">
                <?php if (empty($gruppiPartecipante)) : ?>
                    <div class="text-center py-5">
                        <p class="text-muted">
                            <em>Non partecipi ancora a nessun gruppo. 
                            <a href="gruppi.php" class="text-decoration-none">Trova un gruppo</a> a cui unirti!</em>
                        </p>
                    </div>
                <?php else : ?>
                    <div class="row g-3">
                        <?php foreach ($gruppiPartecipante as $group) : ?>
                            <div class="col-lg-6 col-12">
                                <?php 
                                    $context = 'participant';
                                    include __DIR__ . '/../cards/group-details-card.php'; 
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- TAB 2: CREATI DA ME -->
            <div class="tab-pane fade <?= $templateParams["tab"] === 'created' ? 'show active' : '' ?>" id="creati" role="tabpanel" aria-labelledby="creati-tab">
                <div class="d-flex justify-content-end mb-3">
                    <a href="/StudyGroups/public/gestisci-gruppo.php?action=insert" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                        </svg>
                        Crea nuovo gruppo
                    </a>
                </div>

                <?php if (empty($gruppiCreati)) : ?>
                    <div class="text-center py-5">
                        <p class="text-muted">
                            <em>Non hai ancora creato nessun gruppo.</em>
                        </p>
                    </div>
                <?php else : ?>
                    <div class="row g-3">
                        <?php foreach ($gruppiCreati as $group) : ?>
                            <div class="col-lg-6 col-12">
                                <?php 
                                    $context = 'creator';
                                    include __DIR__ . '/../cards/group-details-card.php'; 
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>