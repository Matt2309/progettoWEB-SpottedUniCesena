<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crea Spotted</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="theme.css">
</head>

<body class="bg-white">

<!-- ================= MOBILE ================= -->

<form method="POST" action="api/spotted/create">

    <!-- TOP BAR MOBILE -->
    <div class="d-flex d-md-none justify-content-between align-items-center p-3 border-bottom bg-white">
        <a href="index.php" class="text-dark fs-4 text-decoration-none">
            <i class="bi bi-x-lg"></i>
        </a>

        <h5 class="text-primary fw-semibold m-0">Crea spotted</h5>

        <button type="submit" class="btn btn-primary btn-sm fw-semibold rounded-pill px-3">
            Post
        </button>
    </div>

    <!-- MOBILE CONTENT -->
    <div class="container mt-3 d-md-none">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
                     style="width:35px;height:35px;">P</div>
                <strong>pippo_franco</strong>
            </div>

            <label for="category-mobile" class="visually-hidden">Categoria</label>
            <select id="category-mobile"
                    name="category_id"
                    class="form-select form-select-sm w-auto category-select"
                    required>
                <option value="" disabled selected>Categoria</option>
            </select>
        </div>

        <label for="text-mobile" class="visually-hidden">Testo spotted</label>
        <textarea id="text-mobile"
                  name="text"
                  class="form-control border-0 fs-5"
                  rows="6"
                  placeholder="Chi o che cosa vuoi spottare?"
                  required></textarea>
    </div>

</form>

<!-- ================= DESKTOP ================= -->

<div class="container-fluid d-none d-md-block">
    <div class="row min-vh-100">

        <!-- SIDEBAR -->
        <aside class="col-md-2 bg-white border-end p-4 d-flex flex-column">
            <h5 class="text-primary fw-bold mb-0">SpottedUniCesena</h5>
            <hr class="mt-1 mb-3 opacity-50">

            <nav class="nav flex-column gap-3">
                <a href="index.php" class="nav-link text-dark d-flex gap-2">
                    <i class="bi bi-house"></i> Home
                </a>
                <a href="Crea.php" class="nav-link text-dark d-flex gap-2">
                    <i class="bi bi-plus-square"></i> Crea
                </a>
                <a href="UtentePersonalArea.php" class="nav-link fw-semibold text-dark d-flex gap-2">
                    <i class="bi bi-person"></i> Profilo
                </a>
            </nav>

            <div class="mt-auto pt-4 border-top d-flex gap-2">
                <div class="rounded-circle bg-info text-white d-flex justify-content-center align-items-center"
                     style="width:36px;height:36px;">P</div>
                <div>
                    <div class="fw-semibold">Pippo Franco</div>
                    <small class="text-muted">pippo_franco</small>
                </div>
            </div>
        </aside>

        <!-- MAIN -->
        <main class="col-md-10 bg-background py-5 px-4">
            <div class="row justify-content-center">

                <section class="col-lg-6">
                    <h4 class="fw-bold mb-4">Crea spotted:</h4>

                    <form method="POST" action="api/spotted/create">
                        <div class="card shadow-sm rounded-4">
                            <div class="card-body">

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-info text-white d-flex justify-content-center align-items-center"
                                             style="width:36px;height:36px;">P</div>
                                        <strong>pippo_franco</strong>
                                    </div>

                                    <label for="category-desktop" class="visually-hidden">Categoria</label>
                                    <select id="category-desktop"
                                            name="category_id"
                                            class="form-select form-select-sm w-auto category-select"
                                            required>
                                        <option value="" disabled selected>Categoria</option>
                                    </select>
                                </div>

                                <label for="text-desktop" class="visually-hidden">Testo spotted</label>
                                <textarea id="text-desktop"
                                          name="text"
                                          class="form-control"
                                          rows="6"
                                          placeholder="Chi o che cosa vuoi spottare?"
                                          required></textarea>

                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-semibold">
                                        Posta
                                    </button>
                                </div>

                            </div>
                        </div>
                    </form>
                </section>

                <!-- INFO -->
                <aside class="col-md-4 d-none d-md-block">
                    <div class="card rounded-4 shadow-sm p-4 sticky-top" style="top: 100px;">

                        <h5 class="fw-bold">Come funziona spotted?</h5>

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
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/common.js"></script>
<script src="js/crea.js"></script>
</body>
</html>
