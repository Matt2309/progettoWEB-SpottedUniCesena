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

  <!-- TOP BAR -->
  <div class="d-flex justify-content-between align-items-center p-3 border-bottom bg-white">
    <a href="index.php" class="text-dark fs-4 text-decoration-none">
      <i class="bi bi-x-lg"></i>
    </a>

    <h5 class="text-danger fw-semibold m-0">
      Il mio profilo
    </h5>

    <span></span>
  </div>

  <div class="container">

    <!-- ADMIN INFO -->
    <div class="d-flex justify-content-between align-items-center py-4">
      <div class="d-flex align-items-center gap-3">
        <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
             style="width:70px;height:70px;">
          F
        </div>

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
        <button class="nav-link">
          Spotted pubblicati
        </button>
      </li>
      <li class="nav-item">
        <button class="nav-link active fw-semibold text-danger">
          Gestione post
        </button>
      </li>
    </ul>

    <!-- POST DA MODERARE -->
    <div class="card rounded-4 shadow-sm mb-4">
      <div class="card-body">

        <div class="d-flex justify-content-between align-items-start">
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

          <span class="badge bg-light text-dark rounded-pill">
            persone
          </span>
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

    <!-- POST DA MODERARE (ESEMPIO) -->
    <div class="card rounded-4 shadow-sm mb-5">
      <div class="card-body">

        <div class="d-flex justify-content-between align-items-start">
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

          <span class="badge bg-light text-dark rounded-pill">
            persone
          </span>
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
          </
