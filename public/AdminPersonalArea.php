<?php require_once '../api/auth/admin-check.php'; ?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profilo Admin</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="theme.css">
</head>

<body class="bg-white">

<!-- ================= MOBILE (TUO CODICE, INALTERATO) ================= -->

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

  <!-- ADMIN INFO -->
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

  <!-- TABS -->
  <ul class="nav nav-tabs justify-content-center mb-4">
    <li class="nav-item">
      <button class="nav-link">Spotted pubblicati</button>
    </li>
    <li class="nav-item">
      <button class="nav-link active fw-semibold text-danger">
        Gestione post
      </button>
    </li>
  </ul>

  <!-- POST CARD (mobile) -->
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
</div>

<!-- ================= DESKTOP (AGGIUNTO) ================= -->

<div class="container-fluid d-none d-md-block">
  <div class="row min-vh-100">

    <!-- SIDEBAR -->
    <aside class="col-md-2 bg-white border-end p-4 d-flex flex-column">
      <h5 class="text-primary fw-bold mb-4">SpottedUniCesena</h5>
      <hr class="mt-1 mb-3 opacity-50">
    
      <nav class="nav flex-column gap-3">
        <a href="index.php" class="nav-link text-dark d-flex gap-2">
          <i class="bi bi-house"></i> Home
        </a>
        <a href="Crea.php" class="nav-link text-dark d-flex gap-2">
          <i class="bi bi-plus-square"></i> Crea
        </a>
        <a href="UtentePersonalArea.php" class="nav-link text-dark d-flex gap-2">
          <i class="bi bi-person"></i> Profilo
        </a>
        <a href="#" class="nav-link fw-semibold text-dark d-flex gap-2">
          <i class="bi bi-list-check"></i> Gestione post
        </a>
      </nav>

      <div class="mt-auto pt-4 border-top d-flex gap-2">
        <div class="rounded-circle bg-info text-white d-flex justify-content-center align-items-center"
             style="width:36px;height:36px;">F</div>
        <div>
          <div class="fw-semibold">Francesco</div>
          <small class="text-muted">Admin</small>
        </div>
      </div>
    </aside>

    <!-- MAIN -->
    <main class="col-md-10 bg-background py-5 px-5">

      <h4 class="fw-bold mb-4">Gestione post</h4>
      <hr class="mb-4">

      <!-- POST DESKTOP -->
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

</body>
</html>
