<div class="container-fluid py-4">
    <!-- Titolo pagina -->
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold text-center">I miei gruppi</h1>
            <p class="text-center text-muted">Gestisci i gruppi a cui partecipi e quelli che hai creato</p>
        </div>
    </div>

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
                        Partecipo
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

            <!-- Se NON ci sono gruppi (mostra messaggio vuoto) -->
            <!-- 
                    <div class="row">
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">
                                <em>Non partecipi ancora a nessun gruppo. 
                                <a href="gruppi.php" class="text-decoration-none">Trova un gruppo</a> a cui unirti!</em>
                            </p>
                        </div>
                    </div>
                    -->

            <!-- Se CI SONO gruppi -->
            <div class="row g-3">

                <!-- Card Gruppo 1 -->
                <div class="col-lg-6 col-12">
                    <article class="card border-primary shadow-sm h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2 class="card-title h5 mb-0">Analisi Matematica 1</h2>
                            <span class="badge bg-primary fs-6">5/10</span>
                        </div>

                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <strong>Corso:</strong> Ingegneria Informatica
                                </li>
                                <li class="mb-2">
                                    <strong>Data esame:</strong>
                                    <time datetime="2026-02-12">12 Feb 2026</time>
                                    <span class="badge bg-warning text-dark ms-2">tra 8 giorni</span>
                                </li>
                                <li>
                                    <strong>Creato da:</strong> Giuseppe Verdi
                                </li>
                            </ul>
                        </div>

                        <div class="card-footer d-flex gap-2">
                            <a href="dettaglio-gruppo.php?id=1" class="btn btn-outline-primary btn-sm flex-grow-1">
                                Dettagli
                            </a>
                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exitModal1">
                                Esci
                            </button>
                        </div>
                    </article>
                </div>

                <!-- Card Gruppo 2 -->
                <div class="col-lg-6 col-12">
                    <article class="card border-primary shadow-sm h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h2 class="card-title h5 mb-0">Basi di Dati</h2>
                            <span class="badge bg-success fs-6">6/6 COMPLETO</span>
                        </div>

                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <strong>Corso:</strong> Informatica
                                </li>
                                <li class="mb-2">
                                    <strong>Data esame:</strong>
                                    <time datetime="2026-02-20">20 Feb 2026</time>
                                    <span class="badge bg-success ms-2">tra 16 giorni</span>
                                </li>
                                <li>
                                    <strong>Creato da:</strong> Maria Rossi
                                </li>
                            </ul>
                        </div>

                        <div class="card-footer d-flex gap-2">
                            <a href="dettaglio-gruppo.php?id=2" class="btn btn-outline-primary btn-sm flex-grow-1">
                                Dettagli
                            </a>
                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exitModal2">
                                Esci
                            </button>
                        </div>
                    </article>
                </div>

            </div>
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

            <!-- Se NON ci sono gruppi creati -->
            <!-- 
                    <div class="row">
                        <div class="col-12 text-center py-5">
                            <p class="text-muted mb-4">
                                <em>Non hai ancora creato nessun gruppo.</em>
                            </p>
                            <a href="crea-gruppo.php" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                                </svg>
                                Crea il tuo primo gruppo
                            </a>
                        </div>
                    </div>
                    -->
            <!-- Se CI SONO gruppi creati -->
            <div class="row g-3">

                <!-- Card Gruppo Creato 1 -->
                <div class="col-lg-6 col-12">
                    <article class="card border-success shadow-sm h-100">
                        <div class="card-header bg-success bg-opacity-10 d-flex justify-content-between align-items-center">
                            <h2 class="card-title h5 mb-0">Tecnologie Web</h2>
                            <span class="badge bg-success fs-6">2/5</span>
                        </div>

                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <strong>Corso:</strong> Ingegneria Informatica
                                </li>
                                <li class="mb-2">
                                    <strong>Data esame:</strong>
                                    <time datetime="2026-02-10">10 Feb 2026</time>
                                    <span class="badge bg-danger ms-2">tra 6 giorni</span>
                                </li>
                                <li>
                                    <strong>Sei il creatore</strong> 👑
                                </li>
                            </ul>
                        </div>

                        <div class="card-footer d-flex gap-2 flex-wrap">
                            <a href="dettaglio-gruppo.php?id=3" class="btn btn-outline-primary btn-sm">
                                Dettagli
                            </a>
                            <a href="modifica-gruppo.php?id=3" class="btn btn-outline-secondary btn-sm">
                                Modifica
                            </a>
                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal1">
                                Elimina
                            </button>
                        </div>
                    </article>
                </div>

                <!-- Card Gruppo Creato 2 -->
                <div class="col-lg-6 col-12">
                    <article class="card border-success shadow-sm h-100">
                        <div class="card-header bg-success bg-opacity-10 d-flex justify-content-between align-items-center">
                            <h2 class="card-title h5 mb-0">Sistemi Operativi</h2>
                            <span class="badge bg-success fs-6">4/8</span>
                        </div>

                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <strong>Corso:</strong> Informatica
                                </li>
                                <li class="mb-2">
                                    <strong>Data esame:</strong>
                                    <time datetime="2026-03-05">05 Mar 2026</time>
                                    <span class="badge bg-info ms-2">tra 30 giorni</span>
                                </li>
                                <li>
                                    <strong>Sei il creatore</strong> 👑
                                </li>
                            </ul>
                        </div>

                        <div class="card-footer d-flex gap-2 flex-wrap">
                            <a href="dettaglio-gruppo.php?id=4" class="btn btn-outline-primary btn-sm">
                                Dettagli
                            </a>
                            <a href="modifica-gruppo.php?id=4" class="btn btn-outline-secondary btn-sm">
                                Modifica
                            </a>
                            <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal2">
                                Elimina
                            </button>
                        </div>
                    </article>
                </div>

            </div>
        </div>

    </div>
</div>