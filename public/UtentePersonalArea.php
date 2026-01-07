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

    <!-- USER INFO -->
    <div class="d-flex justify-content-between align-items-center py-4">
      <div class="d-flex align-items-center gap-3">
        <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
             style="width:70px;height:70px;">
          P
        </div>

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

        <div class="d-flex justify-content-between text-muted">
          <span>
            <i class="bi bi-hand-thumbs-up"></i> 3
            <i class="bi bi-hand-thumbs-down ms-2"></i>
          </span>
          <span>
            <i class="bi bi-chat"></i> 3 Commenti
          </span>
        </div>

      </div>
    </div>

    <!-- POST -->
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

        <div class="d-flex justify-content-between text-muted">
          <span>
            <i class="bi bi-hand-thumbs-up"></i> 3
            <i class="bi bi-hand-thumbs-down ms-2"></i>
          </span>
          <span>
            <i class="bi bi-chat"></i> 3 Commenti
          </span>
        </div>

      </div>
    </div>

  </div>

  <!-- BOTTOM NAV (MOBILE) -->
  <nav class="navbar fixed-bottom bg-white border-top d-md-none">
    <div class="container d-flex justify-content-around text-center">

      <a href="index.php" class="text-dark text-decoration-none">
        <i class="bi bi-house fs-4"></i><br>
        <small>Home</small>
      </a>

      <a href="Crea.php" class="text-dark text-decoration-none">
        <i class="bi bi-plus-square fs-4"></i><br>
        <small>Crea</small>
      </a>

      <a href="UtentePersonalArea.html" class="text-dark text-decoration-none">
        <i class="bi bi-person fs-4"></i><br>
        <small>Profilo</small>
      </a>

    </div>
  </nav>

</body>
</html>
