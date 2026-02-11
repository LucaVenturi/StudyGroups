<?php

$creator = $templateParams['creator'];
$partecipants = $templateParams['partecipants'];

?>

<div class="card border-secondary mb-3 shadow-sm">
    <div class="card-header fw-bold">
        Partecipanti
    </div>
    <div class="card-body p-2">
        <!-- CREATORE DEL GRUPPO -->
        <div class="d-flex align-items-start mb-3">
            <img 
                src="../assets/img/<?php echo $creator["foto_profilo"] ?>" 
                alt="" 
                width="50" 
                height="50"
                class="rounded-circle object-fit-cover me-2" 
            />
            <div>
                <div class="fw-semibold"><?php echo $creator["nome"] ?></div>
                <div class="small text-muted">Email: <?php echo $creator["email"] ?></div>
                <div class="small text-muted">Telegram: @<?php echo $creator["telegram"] ?></div>
            </div>
        </div>

        <!-- Partecipanti -->
        <?php foreach ($partecipants as $partecipante): ?>
            <div class="d-flex align-items-start mb-3">
                <img 
                    src="../assets/img/<?php echo $partecipante["foto_profilo"] ?>" 
                    alt="" 
                    width="50" 
                    height="50"
                    class="rounded-circle object-fit-cover me-2" />
                <div>
                    <div class="fw-semibold"><?php echo $partecipante["nome"] ?></div>
                    <div class="small text-muted">Email: <?php echo $partecipante["email"] ?></div>
                    <div class="small text-muted">Telegram: @<?php echo $partecipante["telegram"] ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- FOOTER CON IL PULSANTE -->
    <div class="card-footer text-center">
        <a href="#" class="btn btn-primary w-100">Unisciti al gruppo</a>
    </div>
</div>