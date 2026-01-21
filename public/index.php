<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SpottedUniCesena</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />


    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet" />


    <link rel="stylesheet" href="theme.css" />
</head>

<body class="bg-body">

<!-- NAVBAR SOLO MOBILE -->
<nav class="navbar bg-white shadow-sm d-md-none">
    <div class="container d-flex justify-content-between align-items-center">
        <span></span>
        <h1 class="h5 fw-semibold m-0 text-primary text-truncate">
            SpottedUniCesena
        </h1>
        <a href="Login.html" class="btn btn-primary btn-sm me-2">
            <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i>
            <span class="visually-hidden">Login</span>
        </a>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <!-- BARRA LATERALE SINISTRA (DESKTOP) -->
        <aside class="col-md-3 d-none d-md-flex flex-column bg-body border-end min-vh-100 p-4"
               aria-labelledby="sidebar-title">
            <h2 id="sidebar-title" class="h4 fw-light text-primary text-break">
                SpottedUniCesena
            </h2>
            <hr>

            <a href="#" class="d-flex align-items-center gap-2 text-body text-decoration-none py-2 fw-bold"
               aria-current="page">
                <i class="bi bi-house" aria-hidden="true"></i>
                <span>Home</span>
            </a>

            <a href="Crea.php" class="d-flex align-items-center gap-2 text-body text-decoration-none py-2">
                <i class="bi bi-plus-square" aria-hidden="true"></i>
                <span>Crea</span>
            </a>

            <a href="UtentePersonalArea.php"
               class="d-flex align-items-center gap-2 text-body text-decoration-none py-2">
                <i class="bi bi-person" aria-hidden="true"></i>
                <span>Profilo</span>
            </a>

            <a href="AdminPersonalArea.php"
               class="d-flex align-items-center gap-2 text-body text-decoration-none py-2 admin-area">
                <i class="bi bi-list-check" aria-hidden="true"></i>
                <span>Gestione post</span>
            </a>

            <hr>
            <div class="mb-3 user-area">
                <a href="Login.html" class="btn btn-primary w-100 mt-3">
                    <i class="bi bi-box-arrow-in-right me-1" aria-hidden="true"></i>
                    Login
                </a>
            </div>

        </aside>

        <!-- POST + FUNZIONAMENTO -->
        <div class="col-md-9">
            <div class="container py-5">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold m-0">Ultimi spotted:</h2>
                    <!-- Desktop category select -->
                    <label for="category" class="visually-hidden d-none d-md-block">Categoria</label>
                    <select id="category"
                            name="category_id"
                            class="form-select form-select-sm w-auto category-select border-primary rounded-3 d-none d-md-block"
                            required>
                        <option value="" selected>Tutti</option>
                    </select>
                    <div id="desktop-main-theme-toggle-placeholder"></div>
                </div>

                <!-- Mobile category select - new placement -->
                <div class="d-md-none mb-4">
                    <label for="category-mobile" class="visually-hidden">Categoria</label>
                    <select id="category-mobile"
                            name="category_id_mobile"
                            class="form-select form-select-sm w-100 category-select border-primary rounded-3"
                            required>
                        <option value="" selected>Tutti</option>
                    </select>
                </div>

                <div class="row align-items-start">

                    <!-- COLONNA CENTRALE -->
                    <main class="col-md-8">
                        <div id="spottedList"></div>
                    </main>

                    <!-- COLONNA DESTRA -->
                    <aside class="col-md-4 d-none d-md-block">
                        <div class="card rounded-4 shadow-sm p-4 sticky-top" style="top: 100px;">

                            <h3 class="fw-bold">Come funziona spotted?</h3>

                            <ul class="mt-3">
                                <li>Scrivi per spottare chiunque</li>
                                <li>I messaggi restano anonimi</li>
                                <li>Mantieni il rispetto</li>
                                <li>Evita dati personali</li>
                                <li>Scegli la categoria giusta</li>
                            </ul>

                            <div class="mt-2 d-flex flex-wrap gap-2" id="categories"></div>

                        </div>
                    </aside>

                </div>
            </div>
        </div>

    </div>
</div>

<!-- BOTTOM NAV SOLO MOBILE -->
<nav class="navbar fixed-bottom bg-body border-top d-md-none">
    <div class="container d-flex justify-content-around text-center">

        <div class="fw-bold">
            <i class="bi bi-house fs-4"></i><br>
            <small>Home</small>
        </div>

        <a href="Crea.php" class="text-body text-decoration-none">
            <i class="bi bi-plus-square fs-4"></i><br>
            <small>Crea</small>
        </a>

        <a href="UtentePersonalArea.php" class="text-body text-decoration-none">
            <i class="bi bi-person fs-4"></i><br>
            <small>Profilo</small>
        </a>

        <a href="AdminPersonalArea.php" class="text-body text-decoration-none admin-area">
            <i class="bi bi-list-check"></i><br>
            <small>Gestione post</small>
        </a>
    </div>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/theme-toggle.js"></script>
<script src="js/common.js"></script>
<script src="js/spotted.js"></script>
<script src="js/user.js"></script>

</body>

</html>
