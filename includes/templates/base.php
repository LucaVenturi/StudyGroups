<?php

$page_title = "StudyGroups - " . ($templateParams["title"] ?? "Home");

?>

<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $page_title ?></title>
    <meta name="description" content="Trova e crea gruppi di studio efficaci" />

    <!-- Tema Bootstrap personalizzato -->
    <link href="../assets/css/custom.css" rel="stylesheet" />
</head>

<body>

    <?php require 'header.php'; ?>

    <main>
        <?php
        if (isset($templateParams["mainContent"])) {
            require $templateParams["mainContent"];
        } else {
            echo "<p class='text-center my-5'>Contenuto non disponibile.</p>";
        }
        ?>
    </main>

    <?php require 'footer.php'; ?>

    <!-- JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>