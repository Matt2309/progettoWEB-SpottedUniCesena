<!DOCTYPE html>
<html lang="it">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Commenti</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="theme.css">
</head>

<body class="bg-light">

  <!-- HEADER -->
  <nav class="navbar bg-white shadow-sm">
    <div class="container justify-content-center">
      <h5 class="text-danger fw-semibold m-0">
        SpottedUniCesena
      </h5>
    </div>
  </nav>

  <div class="container mt-4">

    <!-- POST -->
    <div class="card rounded-4 shadow-sm">
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
          Lorem Ipsum is simply dummy text of the printing and typesetting industry...
        </p>

        <button class="btn btn-outline-secondary w-100" data-bs-toggle="offcanvas" data-bs-target="#commentsDrawer">
          <i class="bi bi-chat"></i> Apri commenti
        </button>

      </div>
    </div>

  </div>

  <!-- OFFCANVAS COMMENTI -->
  <div class="offcanvas offcanvas-bottom" tabindex="-1" id="commentsDrawer">
    <div class="offcanvas-header justify-content-center">
      <h6 class="text-danger fw-bold m-0">
        Commenti
      </h6>
    </div>

    <div class="offcanvas-body">

      <!-- COMMENTO -->
      <div class="d-flex gap-2 mb-3">
        <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
          style="width:35px;height:35px;">
          P
        </div>
        <div>
          <strong>pippo_franco</strong>
          <small class="text-muted ms-2">2 ore fa</small>
          <p class="mb-0">
            Lorem Ipsum is simply dummy text of the printing industry...
          </p>
        </div>
      </div>

      <!-- COMMENTO -->
      <div class="d-flex gap-2 mb-3">
        <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
          style="width:35px;height:35px;">
          P
        </div>
        <div>
          <strong>pippo_franco</strong>
          <small class="text-muted ms-2">2 ore fa</small>
          <p class="mb-0">
            Lorem Ipsum is simply dummy text of the printing industry...
          </p>
        </div>
      </div>

      <!-- COMMENTO -->
      <div class="d-flex gap-2 mb-3">
        <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
          style="width:35px;height:35px;">
          P
        </div>
        <div>
          <strong>pippo_franco</strong>
          <small class="text-muted ms-2">2 ore fa</small>
          <p class="mb-0">
            Lorem Ipsum is simply dummy text of the printing industry...
          </p>
        </div>
      </div>

    </div>

    <!-- INPUT COMMENTO -->
    <div class="border-top p-3 bg-white">
      <div class="input-group">
        <input type="text" class="form-control rounded-pill bg-light border-0" placeholder="Aggiungi un commento...">
        <button class="btn btn-light rounded-pill ms-2">
          <i class="bi bi-send"></i>
        </button>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>