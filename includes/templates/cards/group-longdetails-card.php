<?php

$group = $templateParams['group'];

?>

<article class="card border-primary mb-3 shadow-sm">
    <header class="card-header d-flex justify-content-between align-items-center">
        <h2 class="card-title h4 fw-bold mb-0"><?php echo htmlspecialchars($group["titolo"]) ?></h2>
        <span class="badge bg-primary fs-6"><?php echo htmlspecialchars($group["num_partecipanti"]+1) . " / " . $group["max_partecipanti"] ?></span>
    </header>

    <div class="card-body">
        <ul class="list-unstyled mb-3">
            <li class="mb-2"><strong>Materia:</strong> <?php echo htmlspecialchars($group["materia"]) ?></li>
            <li class="mb-2"><strong>Corso di laurea:</strong> <?php echo htmlspecialchars($group["corso_di_laurea"]) ?></li>
            <li><strong>Data esame:</strong> <time datetime="<?php echo htmlspecialchars($group["data_esame"]) ?>"><?php echo htmlspecialchars($group["data_esame"]) ?></time></li>
        </ul>

        <strong>Descrizione:</strong>
        <p class="card-text"><?php echo $group["descrizione"] ?></p>
    </div>

</article>