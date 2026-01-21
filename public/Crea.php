<?php require_once '../api/auth/auth-check.php'; ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Crea Spotted</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

    <link rel="stylesheet" href="theme.css" />
</head>

<body class="bg-background">

<form id="spottedForm" method="POST">

    <div class="d-flex d-md-none justify-content-between align-items-center p-3 border-bottom bg-body">
        <a href="index.php" class="text-body fs-4 text-decoration-none">
            <i class="bi bi-x-lg"></i>
        </a>

        <h1 class="text-primary fw-semibold m-0">Crea spotted:</h1>

        <button type="submit"
                class="btn btn-primary btn-sm fw-semibold rounded-pill px-3 submit-btn">
            Post
        </button>
    </div>

    <div class="container-fluid">
        <div class="row min-vh-100">

            <aside class="col-md-3 bg-body border-end p-4 d-none d-md-flex flex-column" role="complementary" aria-labelledby="sidebar-title">
                <h2 class="h4 fw-light text-primary text-break">
                    SpottedUniCesena
                </h2>

                <hr>

                <a href="index.php" class="d-flex align-items-center gap-2 text-body text-decoration-none py-2">
                    <i class="bi bi-house"></i>
                    <span>Home</span>
                </a>

                <a href="Crea.php"
                   class="d-flex align-items-center gap-2 text-body text-decoration-none py-2 fw-bold">
                    <i class="bi bi-plus-square"></i>
                    <span>Crea</span>
                </a>

                <a href="UtentePersonalArea.php"
                   class="d-flex align-items-center gap-2 text-body text-decoration-none py-2">
                    <i class="bi bi-person"></i>
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

            <div class="col-md-9">
                <div class="container py-5">
                    <h2 class="fw-bold mb-4 d-none d-md-block">Crea spotted:</h2>

                    <div class="row align-items-start">
                        <main class="col-md-8">
                            <div class="card shadow-sm rounded-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="user-area">
                                        </div>

                                        <label for="category" class="visually-hidden">Categoria</label>
                                        <select id="category"
                                                name="category_id"
                                                class="form-select form-select-sm w-auto category-select"
                                                required>
                                            <option value="" disabled selected>Categoria</option>
                                        </select>
                                    </div>
                                    <p class="error text-danger mb-3 category-error"></p>

                                    <label for="text" class="visually-hidden">Testo spotted</label>
                                    <textarea id="text"
                                              name="text"
                                              class="form-control fs-5"
                                              rows="6"
                                              placeholder="Chi o che cosa vuoi spottare?"
                                              required></textarea>
                                    <p class="error text-danger mb-3 text-error"></p>

                                    <div class="text-end mt-3 d-none d-md-block">
                                        <button type="submit"
                                                class="btn btn-primary rounded-pill px-4 fw-semibold submit-btn">
                                            Posta
                                        </button>
                                    </div>

                                </div>

                            </div>

                        </main>

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

</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/theme-toggle.js"></script>
<script src="js/common.js"></script>
<script src="js/user.js"></script>
<script src="js/crea.js"></script>

</body>
</html>