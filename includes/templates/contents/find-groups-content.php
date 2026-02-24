<div class="container-fluid my-4">
    <div class="row">

        <!-- Bottone solo mobile -->
        <div class="col-12 d-lg-none mb-3 text-end">
            <button class="btn btn-outline-primary" type="button" data-bs-toggle="collapse"
                data-bs-target="#filtriCollapse">
                Filtra annunci
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    class="bi bi-filter" viewBox="0 0 16 16">
                    <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
        </div>

        <!-- FILTRI / COLLAPSE RESPONSIVE -->
        <aside class="col-lg-3">

            <!-- Collapse unico -->
            <div id="filtriCollapse" class="collapse d-lg-block">
                <div class="card border-primary shadow-sm">
                    <div class="card-header fw-bold d-lg-none">Filtri</div>
                    <div class="card-body">

                        <!-- UNICO FORM -->
                        <form method="GET" action="trova-gruppi.php">
                            <ul class="list-unstyled">
                                <!-- Selezione corso di laurea -->
                                <li class="mb-3">
                                    <label for="courseSelect" class="form-label">Corso di laurea</label>
                                    <select id="courseSelect" name="course_id" class="form-select">
                                        <option selected value="">Seleziona corso</option>
                                        <?php foreach ($templateParams["courses"] as $course) : ?>
                                            <option value="<?= $course["id"] ?>"><?= htmlspecialchars($course["nome"]) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </li>

                                <!-- Selezione materia -->
                                <li class="mb-3">
                                    <label for="subjectSelect" class="form-label">Corso di laurea</label>
                                    <select id="subjectSelect" name="subject" class="form-select" disabled>
                                        <option selected value="">Seleziona materia</option>
                                    </select>
                                </li>

                                <li class="mb-3">
                                    <label for="dateInput" class="form-label">Data esame entro</label>
                                    <input type="date" id="dateInput" name="date" class="form-control" />
                                </li>

                                <li class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="showFullCheckbox" name="show_full" />
                                    <label class="form-check-label" for="showFullCheckbox">
                                        Solo gruppi con posti liberi
                                    </label>
                                </li>

                                <li>
                                    <button type="submit" class="btn btn-primary w-100">
                                        Applica filtri
                                    </button>
                                </li>
                            </ul>
                        </form>

                    </div>
                </div>
            </div>
        </aside>

        <!-- ANNUNCI -->
        <section class="col-lg-9">

            <h1 class="visually-hidden">Gruppi di studio</h1>

            <?php if (empty($templateParams["groups"])) : ?>
                <!-- Nessun gruppo trovato -->
                <div class="alert alert-info text-center" role="alert">
                    Nessun gruppo trovato. Prova ad ampliare i filtri di ricerca.
                </div>
            <?php else : ?>
                <ul>
                    <?php foreach ($templateParams["groups"] as $group) : ?>
                        <li class="list-unstyled">
                            <?php
                            $context = "list";
                            include __DIR__ . "/../cards/group-details-card.php";
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

        </section>
    </div>
</div>