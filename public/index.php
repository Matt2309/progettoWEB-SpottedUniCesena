<?php require_once '../api/auth/auth-check.php'; ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SpottedUniCesena</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="theme.css">
</head>

<body class="bg-background">

<!-- NAVBAR SOLO MOBILE -->
<nav class="navbar bg-white shadow-sm d-md-none">
    <div class="container d-flex justify-content-between align-items-center">
        <span></span>
        <h5 class="fw-semibold m-0 text-danger text-truncate">SpottedUniCesena</h5>
        <a href="Login.html" class="btn btn-danger btn-sm">
            <i class="bi bi-box-arrow-in-right"></i>
        </a>
    </div>
</nav>

<div class="container-fluid my-4">
    <div class="row">

        <!-- SIDEBAR SINISTRA (DESKTOP) -->
        <aside class="col-md-3 d-none d-md-flex flex-column bg-white border-end min-vh-100 p-4">

            <h4 class="fw-bold text-danger text-break">
                SpottedUniCesena
            </h4>

            <hr>

            <a href="#" class="d-flex align-items-center gap-2 text-dark text-decoration-none py-2">
                <i class="bi bi-house"></i>
                <span>Home</span>
            </a>

            <a href="Crea.php" class="d-flex align-items-center gap-2 text-dark text-decoration-none py-2">
                <i class="bi bi-plus-square"></i>
                <span>Crea</span>
            </a>

            <a href="UtentePersonalArea.php" class="d-flex align-items-center gap-2 text-dark text-decoration-none py-2">
                <i class="bi bi-person"></i>
                <span>Profilo</span>
            </a>

            <div class="mt-auto">
                <a href="Login.html" class="btn btn-danger w-100 mt-3">
                    <i class="bi bi-box-arrow-in-right me-1"></i>
                    Login
                </a>
            </div>

        </aside>

        <!-- COLONNA CENTRALE -->
        <main class="col-12 col-md-6">

            <h4 class="fw-bold mb-4">Ultimi spotted:</h4>

            <!-- POST 1 -->
            <div class="card rounded-4 shadow-sm mb-4">
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
                                 style="width:35px;height:35px;">
                                P
                            </div>
                            <div>
                                <strong>pippo_franco</strong><br>
                                <small class="text-muted">2 ore fa</small>
                            </div>
                        </div>

                        <span class="badge bg-light text-dark rounded-pill">persone</span>
                    </div>

                    <p class="mt-3">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                    </p>

                    <div class="d-flex justify-content-between text-muted">
                        <span>
                            <i class="bi bi-hand-thumbs-up"></i> 3
                            <i class="bi bi-hand-thumbs-down ms-2"></i>
                        </span>

                        <a href="Commenti.php" class="text-muted text-decoration-none">
                            <i class="bi bi-chat"></i> 3 Commenti
                        </a>
                    </div>

                </div>
            </div>

            <!-- POST 2 -->
            <div class="card rounded-4 shadow-sm mb-4">
                <div class="card-body">

                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-success text-white fw-bold d-flex justify-content-center align-items-center"
                                 style="width:35px;height:35px;">
                                M
                            </div>
                            <div>
                                <strong>mario_rossi</strong><br>
                                <small class="text-muted">2 ore fa</small>
                            </div>
                        </div>

                        <span class="badge bg-danger-subtle text-danger rounded-pill">avvisi</span>
                    </div>

                    <p class="mt-3">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry...
                    </p>

                    <div class="d-flex justify-content-between text-muted">
                        <span>
                            <i class="bi bi-hand-thumbs-up"></i> 3
                            <i class="bi bi-hand-thumbs-down ms-2"></i>
                        </span>

                        <a href="Commenti.php" class="text-muted text-decoration-none">
                            <i class="bi bi-chat"></i> 3 Commenti
                        </a>
                    </div>

                </div>
            </div>

        </main>

        <!-- COLONNA DESTRA (DESKTOP) -->
        <aside class="col-md-3 d-none d-md-block">

            <div class="card rounded-4 shadow-sm p-4">
                <h5 class="fw-bold">Come funziona spotted?</h5>

                <ul class="mt-3">
                    <li>Scrivi per spottare chiunque</li>
                    <li>I messaggi restano anonimi</li>
                    <li>Mantieni il rispetto</li>
                    <li>Evita dati personali</li>
                    <li>Scegli la categoria giusta</li>
                </ul>

                <div class="mt-2">
                    <span class="badge bg-success">generale</span>
                    <span class="badge bg-primary">persone</span>
                    <span class="badge bg-danger">avvisi</span>
                </div>
            </div>

        </aside>

    </div>
</div>

<!-- BOTTOM NAV SOLO MOBILE -->
<nav class="navbar fixed-bottom bg-white border-top d-md-none">
    <div class="container d-flex justify-content-around text-center">

        <div>
            <i class="bi bi-house fs-4"></i><br>
            <small>Home</small>
        </div>

        <a href="Crea.php" class="text-dark text-decoration-none">
            <i class="bi bi-plus-square fs-4"></i><br>
            <small>Crea</small>
        </a>

        <a href="UtentePersonalArea.php" class="text-dark text-decoration-none">
            <i class="bi bi-person fs-4"></i><br>
            <small>Profilo</small>
        </a>

    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
