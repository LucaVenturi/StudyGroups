<?php
$isLoggedIn = isUserLoggedIn();
$user = $isLoggedIn ? getLoggedUser() : null;
$displayName = $user ? trim($user['nome'] . ' ' . $user['cognome']) : 'Area Personale';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<header>
    <nav class="navbar navbar-expand-lg bg-primary text-white" data-bs-theme="dark">
        <div class="container-fluid">
            <!-- Titolo della pagina come brand -->
            <span class="navbar-brand fw-bold">
                <?php echo $page_title ?>
            </span>

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
                        <a class="nav-link <?php echo $currentPage === 'index.php' ? 'active' : ''; ?>" aria-current="page" href="/StudyGroups/public/index.php">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo in_array($currentPage, array("trova-gruppi.php", "dettagli-gruppo.php")) ? 'active' : ''; ?>" href="/StudyGroups/public/trova-gruppi.php">
                            Trova un gruppo
                        </a>
                    </li>
                    <!-- Se l'utente non è loggato, mostra "Accedi/Registrati". -->
                    <?php if (!$isLoggedIn): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo in_array($currentPage, array("login.php", "register.php")) ? 'active' : ''; ?>" href="/StudyGroups/public/login.php">
                                Accedi/Registrati
                            </a>
                        </li>
                        <!-- Se l'utente è loggato, mostra il suo nome e un menu a tendina. -->
                    <?php else: ?>
                        <?php if ($user['is_admin'] ?? false): ?>
                            <li class="nav-item dropdown">
                                <a 
                                    class="nav-link dropdown-toggle <?php echo in_array($currentPage, array("gestione-corsi.php", "gestione-materie.php")) ? 'active' : ''; ?>"
                                    href="#"
                                    role="button"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                >
                                    Dashboard Admin
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="/StudyGroups/admin/gestione-corsi.php">
                                            Gestione corsi di laurea
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/StudyGroups/admin/gestione-materie.php">
                                            Gestione materie
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle <?php echo in_array($currentPage, array("miei-gruppi.php", "profilo.php")) ? 'active' : ''; ?>"
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
                                    <a class="dropdown-item" href="/StudyGroups/public/profilo.php">
                                        Profilo
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/StudyGroups/public/miei-gruppi.php">
                                        I miei gruppi
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/StudyGroups/includes/actions/process-logout.php">
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