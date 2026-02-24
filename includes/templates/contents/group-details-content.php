<div class="container-fluid my-4">
    <div class="row px-2">

        <h1 class="visually-hidden">Dettagli del gruppo <?= htmlspecialchars($templateParams["group"]["titolo"]) ?></h1>

        <!-- DETTAGLI GRUPPO -->
        <div class="col-lg-9 col-12 px-2">
            <?php require(__DIR__ . '/../cards/group-longdetails-card.php'); ?>
        </div>

        <!-- PARTECIPANTI / ASIDE -->
        <aside class="col-lg-3 col-12 px-2">
            <?php require(__DIR__ . '/../cards/group-participants-card.php'); ?>
        </aside>
    </div>
</div>