<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Crea Spotted</title>

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
      Crea spotted
    </h5>

    <button class="btn btn-danger btn-sm fw-semibold rounded-pill px-3">
      Post
    </button>
  </div>

  <div class="container mt-3">

    <!-- USER + CATEGORIA -->
    <div class="d-flex justify-content-between align-items-center mb-3">

      <div class="d-flex align-items-center gap-2">
        <div class="rounded-circle bg-info text-white fw-bold d-flex justify-content-center align-items-center"
             style="width:35px;height:35px;">
          P
        </div>
        <strong>pippo_franco</strong>
      </div>

      <select class="form-select form-select-sm w-auto">
        <option selected>Categoria</option>
        <option value="1">Persone</option>
        <option value="2">Avvisi</option>
        <option value="3">Altro</option>
      </select>

    </div>

    <!-- TEXTAREA -->
    <textarea class="form-control border-0 fs-5"
              rows="6"
              placeholder="Chi o che cosa vuoi spottare?">
    </textarea>

  </div>

</body>
</html>
