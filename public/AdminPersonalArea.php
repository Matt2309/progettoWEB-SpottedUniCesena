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


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="theme.css">
</head>

<body class="bg-background">

<!-- NAVBAR SOLO MOBILE -->
<nav class="navbar bg-white shadow-sm d-md-none">
    <div class="container d-flex justify-content-between align-items-center">
        <span></span>

        <h1 class="h5 fw-semibold m-0 text-primary text-truncate">
            SpottedUniCesena
        </h1>

        <a href="Login.html" class="btn btn-primary btn-sm">
            <span class="bi bi-box-arrow-in-right" aria-hidden="true"></span>
            <span class="visually-hidden">Login</span>
        </a>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <!-- BARRA LATERALE SINISTRA (DESKTOP) -->
        <aside class="col-md-3 d-none d-md-flex flex-column bg-white border-end min-vh-100 p-4" role="complementary"
               aria-labelledby="sidebar-title">

            <h2 id="sidebar-title" class="h2 fw-bold text-primary text-break">
                SpottedUniCesena
            </h2>

            <hr>

            <a href="index.php" class="d-flex align-items-center gap-2 text-dark text-decoration-none py-2"
               aria-current="page">
                <span class="bi bi-house" aria-hidden="true"></span>
                <span>Home</span>
            </a>

            <a href="Crea.php" class="d-flex align-items-center gap-2 text-dark text-decoration-none py-2">
                <span class="bi bi-plus-square" aria-hidden="true"></span>
                <span>Crea</span>
            </a>

            <a href="UtentePersonalArea.php"
               class="d-flex align-items-center gap-2 text-dark text-decoration-none py-2">
                <span class="bi bi-person" aria-hidden="true"></span>
                <span>Profilo</span>
            </a>

            <a href="#"
               class="d-flex align-items-center gap-2 text-dark text-decoration-none py-2 admin-area fw-bold">
                <span class="bi bi-list-check" aria-hidden="true"></span>
                <span>Gestione post</span>
            </a>

            <hr>
            <div class="mb-3 user-area">
                <a href="Login.html" class="btn btn-primary w-100 mt-3">
                    <span class="bi bi-box-arrow-in-right me-1" aria-hidden="true"></span>
                    Login
                </a>
            </div>

        </aside>

        <!-- POST + FUNZIONAMENTO -->
        <div class="col-md-9">
            <div class="container py-5">

                <h3 class="fw-bold mb-4">Approvazione spotted:</h3>

                <div class="row align-items-start">

                    <!-- COLONNA CENTRALE -->
                    <main class="col-md-8">
                        <div id="spottedList"></div>
                    </main>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- BOTTOM NAV SOLO MOBILE -->
<nav class="navbar fixed-bottom bg-white border-top d-md-none">
    <div class="container d-flex justify-content-around text-center">

        <a href="index.php" class="text-dark text-decoration-none">
            <span class="bi bi-house fs-4"></span><br>
            <small>Home</small>
        </a>

        <a href="Crea.php" class="text-dark text-decoration-none">
            <span class="bi bi-plus-square fs-4"></span><br>
            <small>Crea</small>
        </a>

        <a href="UtentePersonalArea.php" class="text-dark text-decoration-none">
            <span class="bi bi-person fs-4"></span><br>
            <small>Profilo</small>
        </a>

        <a href="#" class="text-dark text-decoration-none admin-area">
            <span class="bi bi-list-check"></span><br>
            <small>Gestione post</small>
        </a>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/common.js"></script>
<script src="js/admin.js"></script>
<script src="js/user.js"></script>

</body>

</html>
