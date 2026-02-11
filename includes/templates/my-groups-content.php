<?php
/**
 * Template per la pagina "I miei gruppi"
 * 
 * Variabili richieste:
 * - $templateParams["gruppi_partecipante"]: array di gruppi a cui l'utente partecipa
 * - $templateParams["gruppi_creati"]: array di gruppi creati dall'utente
 */

$gruppiPartecipante = $templateParams["groups_partecipting_in"] ?? [];
$gruppiCreati = $templateParams["groups_created"] ?? [];
?>

<div class="container py-4">
    <!-- Titolo pagina
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold text-center">I miei gruppi</h1>
            <p class="text-center text-muted">Gestisci i gruppi a cui partecipi e quelli che hai creato</p>
        </div>
    </div> -->

    <!-- TAB NAVIGATION -->
    <div class="row mb-3">
        <div class="col-12">
            <ul class="nav nav-tabs nav-fill" id="mieiGruppiTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button 
                        class="nav-link active fw-semibold" 
                        id="partecipo-tab" 
                        data-bs-toggle="tab" 
                        data-bs-target="#partecipo" 
                        type="button" 
                        role="tab" 
                        aria-controls="partecipo" 
                        aria-selected="true">
                        Gruppi a cui partecipo
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button 
                        class="nav-link fw-semibold" 
                        id="creati-tab" 
                        data-bs-toggle="tab" 
                        data-bs-target="#creati" 
                        type="button" 
                        role="tab" 
                        aria-controls="creati" 
                        aria-selected="false">
                        Creati da me
                    </button>
                </li>
            </ul>
        </div>
    </div>

    <!-- TAB CONTENT -->
    <div class="tab-content" id="mieiGruppiTabContent">
        
        <!-- TAB 1: PARTECIPO -->
        <div class="tab-pane fade show active" id="partecipo" role="tabpanel" aria-labelledby="partecipo-tab">
            
            <?php if (empty($gruppiPartecipante)) : ?>
                <!-- Messaggio se non ci sono gruppi -->
                <div class="row">
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">
                            <em>Non partecipi ancora a nessun gruppo. 
                            <a href="gruppi.php" class="text-decoration-none">Trova un gruppo</a> a cui unirti!</em>
                        </p>
                    </div>
                </div>
            <?php else : ?>
                <!-- Lista gruppi a cui partecipo -->
                <div class="row g-3">
                    <?php foreach ($gruppiPartecipante as $group) : ?>
                        <div class="col-lg-6 col-12">
                            <?php 
                                $context = 'participant'; // Variabile per distinguere il contesto nella card
                                include 'group-card.php'; 
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- TAB 2: CREATI DA ME -->
        <div class="tab-pane fade" id="creati" role="tabpanel" aria-labelledby="creati-tab">

            <!-- Bottone Crea Gruppo -->
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-end">
                    <a href="crea-gruppo.php" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                        </svg>
                        Crea nuovo gruppo
                    </a>
                </div>
            </div>
            
            <?php if (empty($gruppiCreati)) : ?>
                <!-- Messaggio se non ci sono gruppi creati -->
                <div class="row">
                    <div class="col-12 text-center py-5">
                        <p class="text-muted mb-4">
                            <em>Non hai ancora creato nessun gruppo.</em>
                        </p>
                    </div>
                </div>
            <?php else : ?>
                <!-- Lista gruppi creati -->
                <div class="row g-3">
                    <?php foreach ($gruppiCreati as $group) : ?>
                        <div class="col-lg-6 col-12">
                            <?php 
                                $context = 'creator'; // Variabile per distinguere il contesto nella card
                                include 'group-card.php'; 
                            ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>