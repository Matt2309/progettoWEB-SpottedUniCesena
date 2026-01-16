<?php require_once '../api/auth/auth-check.php'; ?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profilo</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="theme.css">
</head>

<body class="bg-white">

<!-- ================= MOBILE (TUO CODICE, INALTERATO) ================= -->

<div class="d-md-none">

  <!-- TOP BAR -->
  <div class="d-flex justify-content-between align-items-center p-3 border-bottom bg-white">
    <a href="index.php" class="text-dark fs-4 text-decoration-none">
      <i class="bi bi-x-lg"></i>
    </a>

    <h5 class="text-primary fw-semibold m-0">
      Il mio profilo
    </h5>

    <span></span>
  </div>

  <div class="container">

    <!-- USER INFO -->
    <div class="d-flex justify-content-between align-items-center py-4">
      <div class="d-flex align-items-center gap-3">
        <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
             style="width:70px;height:70px;">P</div>

        <div>
          <h5 class="mb-0">Pippo Franco</h5>
          <small class="text-muted">pippo_franco</small>
        </div>
      </div>

      <small class="text-muted text-end">
        5 post • 34 likes
      </small>
    </div>

    <p class="text-center text-muted fw-semibold">
      Spotted pubblicati
    </p>

    <!-- POST -->
      <main class="col-md-8">
          <div class="userList"></div>
      </main>

  </div>

  <!-- BOTTOM NAV -->
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
    </div>
  </nav>

</div>

<!-- ================= DESKTOP (AGGIUNTO) ================= -->

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
    <main class="col-md-10 bg-background py-5 px-5">

      <h4 class="fw-bold mb-2">Il mio profilo:</h4>

      <!-- TABS -->
      <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
          <button class="nav-link active text-primary fw-semibold" id="spotted">Spotted</button>
        </li>
        <li class="nav-item">
          <button class="nav-link text-muted" id="comments">Commenti</button>
        </li>
        <li class="nav-item">
          <button class="nav-link text-muted" id="likes">Like</button>
        </li>
      </ul>

      <!-- POST DESKTOP -->
        <main class="col-md-8">
            <div class="userList"></div>
        </main>

    </main>

  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/common.js"></script>
    <script src="js/profile.js"></script>
</body>
</html>
