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
          <div class="user-area">
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
      <a href="#" class="text-dark text-decoration-none fw-bold">
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

      <a href="#"
         class="d-flex align-items-center gap-2 text-dark text-decoration-none py-2 fw-bold" aria-current="page">
        <i class="bi bi-person" aria-hidden="true"></i>
        <span>Profilo</span>
      </a>

      <hr>
      <div class="mb-3 user-area">
        <a href="Login.html" class="btn btn-primary w-100 mt-3">
          <i class="bi bi-box-arrow-in-right me-1" aria-hidden="true"></i>
          Login
        </a>
      </div>
    </aside>

    <!-- MAIN -->
    <main class="col-md-9 bg-background py-5 px-5">

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
    <script src="js/user.js"></script>
    <script src="js/profile.js"></script>
</body>
</html>
