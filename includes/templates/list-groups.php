<?php

$groups = $templateParams["groups"] ?? [];

?>

<?php if (empty($groups)) : ?>
    <!-- Nessun gruppo trovato -->
    <div class="alert alert-info text-center" role="alert">
        Nessun gruppo trovato. Prova ad ampliare i filtri di ricerca.
    </div>
<?php else : ?>
    <?php foreach ($groups as $group) : ?>
        <?php 
            $context = "list";
            include __DIR__ . "/group-card.php";
        ?>
    <?php endforeach; ?>
<?php endif; ?>