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

<body class="d-flex flex-column min-vh-100">

    <?php require 'header.php'; ?>

    <main class="flex-grow-1">
        <?php
        if (isset($templateParams["main_content"])) {
            require $templateParams["main_content"];
        } else {
            echo "<p class='text-center my-5'>Contenuto non disponibile.</p>";
        }
        ?>
    </main>

    <?php require 'footer.php'; ?>

    <!-- JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    
    <!-- JavaScript della pagina -->
    <?php
    if (isset($templateParams["js"])):
        foreach ($templateParams["js"] as $script):
    ?>
            <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
</body>

</html>