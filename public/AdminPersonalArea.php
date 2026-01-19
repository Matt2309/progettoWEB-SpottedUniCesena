<?php require_once '../api/auth/admin-check.php'; ?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profilo Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="theme.css">
</head>

<body class="bg-white">

<div class="d-flex d-md-none justify-content-between align-items-center p-3 border-bottom bg-white">
    <a href="index.php" class="text-dark fs-4 text-decoration-none">
        <i class="bi bi-x-lg"></i>
    </a>

    <h5 class="text-danger fw-semibold m-0">
        Il mio profilo
    </h5>

    <span></span>
</div>

<div class="container d-md-none">

    <div class="d-flex justify-content-between align-items-center py-4">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
                 style="width:70px;height:70px;">F</div>

            <div>
                <h5 class="mb-0">Francesco</h5>
                <small class="text-muted fw-semibold">Admin</small>
            </div>
        </div>

        <small class="text-muted text-end">
            5 post • 34 likes
        </small>
    </div>
    <p class="text-center text-muted fw-semibold">
        Spotted pubblicati
    </p>

    <div class="card rounded-4 shadow-sm mb-4">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-start">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
                         style="width:35px;height:35px;">P</div>
                    <div>
                        <strong>pippo_franco</strong><br>
                        <small class="text-muted">2 ore fa</small>
                    </div>
                </div>

                <span class="badge bg-light text-dark rounded-pill">persone</span>
            </div>

            <p class="mt-3">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
            </p>

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <button class="btn btn-success btn-sm fw-semibold">
                        <i class="bi bi-check-lg"></i> Accetta
                    </button>
                    <button class="btn btn-danger btn-sm fw-semibold ms-2">
                        <i class="bi bi-x-lg"></i> Rifiuta
                    </button>
                </div>

                <a href="#" class="text-danger fw-semibold text-decoration-none">
                    <i class="bi bi-slash-circle"></i> Banna utente
                </a>
            </div>

        </div>
    </div>

    <nav class="navbar fixed-bottom bg-white border-top">
        <div class="container d-flex justify-content-around text-center">
            <a href="index.php" class="text-dark text-decoration-none">
                <i class="bi bi-house fs-4"></i><br>
                <small>Home</small>
            </a>
            <a href="Crea.php" class="text-dark text-decoration-none">
                <i class="bi bi-plus-square fs-4"></i><br>
                <small>Crea</small>
            </a>
            <a href="UtentePersonalArea.php" class="text-dark text-decoration-none">
                <i class="bi bi-person fs-4"></i><br>
                <small>Profilo</small>
            </a>
            <a href="#" class="text-dark text-decoration-none fw-bold admin-area">
                <i class="bi bi-list-check"></i><br>
                <small>Gestione post</small>
            </a>
        </div>
    </nav>
</div>

<div class="container-fluid d-none d-md-block">
    <div class="row min-vh-100">

        <aside class="col-md-3 bg-white border-end p-4 d-flex flex-column" role="complementary" aria-labelledby="sidebar-title">
            <h2 id="sidebar-title" class="h4 fw-bold text-primary text-break">
                SpottedUniCesena
            </h2>

            <hr>

            <a href="index.php" class="d-flex align-items-center gap-2 text-dark text-decoration-none py-2">
                <i class="bi bi-house" aria-hidden="true"></i>
                <span>Home</span>
            </a>

            <a href="Crea.php" class="d-flex align-items-center gap-2 text-dark text-decoration-none py-2">
                <i class="bi bi-plus-square" aria-hidden="true"></i>
                <span>Crea</span>
            </a>

            <a href="UtentePersonalArea.php" class="d-flex align-items-center gap-2 text-dark text-decoration-none py-2">
                <i class="bi bi-person" aria-hidden="true"></i>
                <span>Profilo</span>
            </a>

            <a href="#" class="admin-area d-flex align-items-center gap-2 text-dark text-decoration-none py-2 fw-bold" aria-current="page">
                <i class="bi bi-list-check" aria-hidden="true"></i>
                <span>Gestione post</span>
            </a>

            <hr>

            <div class="mb-3 user-area">
            </div>
        </aside>

        <main class="col-md-9 bg-background py-5 px-5">

            <h4 class="fw-bold mb-4">Gestione post</h4>

            <div class="card rounded-4 shadow-sm mb-4">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex align-items-center gap-2">
                            <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
                                 style="width:35px;height:35px;">P</div>
                            <div>
                                <strong>pippo_franco</strong><br>
                                <small class="text-muted">2 ore fa</small>
                            </div>
                        </div>

                        <span class="badge bg-primary rounded-pill">persone</span>
                    </div>

                    <p class="mt-3">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                    </p>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <button class="btn btn-success btn-sm fw-semibold">
                                <i class="bi bi-check-lg"></i> Accetta
                            </button>
                            <button class="btn btn-danger btn-sm fw-semibold ms-2">
                                <i class="bi bi-x-lg"></i> Rifiuta
                            </button>
                        </div>

                        <a href="#" class="text-danger fw-semibold text-decoration-none">
                            <i class="bi bi-slash-circle"></i> Banna utente
                        </a>
                    </div>

                </div>
            </div>

        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/user.js"></script>
</body>
</html>