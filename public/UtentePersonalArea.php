<?php require_once '../api/auth/auth-check.php'; ?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Profilo</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
  <link rel="stylesheet" href="theme.css" />
</head>

<body class="bg-body">

<!-- TOP BAR (Mobile Only) -->
<div class="d-md-none d-flex justify-content-between align-items-center p-3 border-bottom bg-body">
  <a href="index.php" class="text-body fs-4 text-decoration-none" title="Close">
    <span class="bi bi-x-lg"></span>
  </a>
  <h5 class="text-primary fw-semibold m-0">
    Il mio profilo
  </h5>
  <span></span>
</div>

<div class="container-fluid">
  <div class="row min-vh-100">

    <!-- SIDEBAR (Desktop Only) -->
    <aside class="col-md-3 bg-body border-end p-4 d-flex flex-column d-none d-md-block" role="complementary" aria-labelledby="sidebar-title">
      <h2 id="sidebar-title" class="h4 fw-light text-primary text-break fw-light">
        SpottedUniCesena
      </h2>
      <hr class="w-50">
      <a href="index.php" class="d-flex align-items-center gap-2 text-body text-decoration-none py-2">
        <span class="bi bi-house" aria-hidden="true"></span>
        <span>Home</span>
      </a>
      <a href="Crea.php" class="d-flex align-items-center gap-2 text-body text-decoration-none py-2">
        <span class="bi bi-plus-square" aria-hidden="true"></span>
        <span>Crea</span>
      </a>
      <a href="#"
         class="d-flex align-items-center gap-2 text-body text-decoration-none py-2 fw-bold" aria-current="page">
        <span class="bi bi-person" aria-hidden="true"></span>
        <span>Profilo</span>
      </a>
      <a href="AdminPersonalArea.php"
         class="d-flex align-items-center gap-2 text-body text-decoration-none py-2 admin-area">
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

    <!-- MAIN CONTENT AREA -->
    <div class="col-12 col-md-9 bg-body">
      <div class="container py-2 py-md-5"> <!-- Adjusted padding for mobile -->

        <!-- User Info (Mobile and Desktop) -->
        <div class="d-flex justify-content-between align-items-center py-4 d-md-none"> <!-- Mobile user info -->
          <div class="d-flex align-items-center gap-3">
            <div class="user-area">
            </div>
          </div>
          <small class="text-muted text-end" id="user-stats"></small>
        </div>

        <h2 class="fw-bold mb-4 d-none d-md-block">Il mio profilo:</h2> <!-- Desktop profile title -->

        <div class="row align-items-start">

          <div class="col-12 col-md-8"> <!-- Content column -->
            <ul class="nav nav-tabs nav-tabs-custom mb-4" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active"
                        id="spotted"
                        data-bs-toggle="tab"
                        data-bs-target="#spotted-pane"
                        type="button"
                        role="tab"
                        aria-selected="true">
                  Spotted
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link"
                        id="comments"
                        data-bs-toggle="tab"
                        data-bs-target="#comments-pane"
                        type="button"
                        role="tab"
                        aria-selected="false">
                  Commenti
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link"
                        id="likes"
                        data-bs-toggle="tab"
                        data-bs-target="#likes-pane"
                        type="button"
                        role="tab"
                        aria-selected="false">
                  Like
                </button>
              </li>
            </ul>

            <div class="tab-content">
              <div class="tab-pane fade show active" id="spotted-pane" role="tabpanel">
              </div>
              <div class="tab-pane fade" id="comments-pane" role="tabpanel">
              </div>
              <div class="tab-pane fade" id="likes-pane" role="tabpanel">
              </div>
            </div>

            <main>
              <div class="userList"></div>
            </main>
          </div>


        </div>
      </div>
    </div>
  </div>
</div>

<!-- BOTTOM NAV (Mobile Only) -->
<nav class="navbar fixed-bottom bg-body border-top d-md-none">
  <div class="container d-flex justify-content-around text-center">
    <a href="index.php" class="text-body text-decoration-none">
      <span class="bi bi-house fs-4"></span><br>
      <small>Home</small>
    </a>
    <a href="Crea.php" class="text-body text-decoration-none">
      <span class="bi bi-plus-square fs-4"></span><br>
      <small>Crea</small>
    </a>
    <a href="#" class="text-body text-decoration-none fw-bold">
      <span class="bi bi-person fs-4"></span><br>
      <small>Profilo</small>
    </a>
    <a href="AdminPersonalArea.php" class="admin-area text-body text-decoration-none">
      <span class="bi bi-list-check"></span><br>
      <small>Gestione post</small>
    </a>
  </div>
</nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/theme-toggle.js"></script>
    <script src="js/common.js"></script>
    <script src="js/user.js"></script>
    <script src="js/profile.js"></script>
</body>
</html>