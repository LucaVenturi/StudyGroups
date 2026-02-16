<?php
$isLoggedIn = isUserLoggedIn();
$user = $isLoggedIn ? getLoggedUser() : null;
$displayName = $user ? trim($user['nome'] . ' ' . $user['cognome']) : 'Area Personale';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<header>
    <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
        <div class="container-fluid">
            <!-- Titolo della pagina come brand -->
            <a class="navbar-brand fw-bold" href="#">
                <?php echo $page_title ?>
            </a>
            <!-- Menu hamburger per dispositivi mobili -->
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarToggler"
                aria-controls="navbarToggler"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <!-- Icona del menu hamburger -->
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Link di navigazione -->
            <div class="collapse navbar-collapse" id="navbarToggler">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $currentPage === 'index.php' ? 'active' : ''; ?>" aria-current="page" href="index.php">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo in_array($currentPage, array("annunci.php", "dettagli-gruppo.php")) ? 'active' : ''; ?>" href="annunci.php">
                            Trova un gruppo
                        </a>
                    </li>
                    <!-- Se l'utente non è loggato, mostra "Accedi/Registrati". -->
                    <?php if (!$isLoggedIn): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo in_array($currentPage, array("login.php", "register.php")) ? 'active' : ''; ?>" href="login.php">
                                Accedi/Registrati
                            </a>
                        </li>
                        <!-- Se l'utente è loggato, mostra il suo nome e un menu a tendina. -->
                    <?php else: ?>
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle <?php echo in_array($currentPage, array("mieigruppi.php", "profilo.php")) ? 'active' : ''; ?>"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <?php
                                    echo htmlspecialchars($displayName);
                                ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        Profilo
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/StudyGroups/public/mieigruppi.php">
                                        I miei gruppi
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/StudyGroups/includes/api/process-logout.php">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>