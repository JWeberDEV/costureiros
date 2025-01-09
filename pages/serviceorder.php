<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Ordens de Serviço
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link href="../assets/libs/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  <!-- JQuery -->
  <script src="../assets/js/jquery.js"></script>
  <!-- swall -->
  <link rel="stylesheet" href="../assets/libs/sweetalert/dist/sweetalert2.min.css">
</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Costureiros</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Rotinas</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="../pages/serviceorder.php">
            <i class="material-symbols-rounded opacity-5">description</i>
            <span class="nav-link-text ms-1">OS</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/clients.php">
            <i class="material-symbols-rounded opacity-5">group</i>
            <span class="nav-link-text ms-1">Cadastro de Clientes</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/services.php">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Cadastro de serviços</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Filters -->
    <nav class="navbar navbar-main navbar-expand-lg mt-2 px-0 mx-2 card" id="navbarBlur" data-scroll="true">
      <div class="container-fluid">
        <div class="row justify-content-start">
          <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Ações</div>
          <hr class="horizontal dark m-0 mb-2" />
          <div class="row justify-content-between">
            <div class="col-1">
              <a href="../pages/newserviceorder.php">
                <button type="button" class="btn bg-gradient-dark w-100 m-0">Nova OS</button>
              </a>
            </div>
            <div class="col-2 text-end">
              <button type="button" class="btn bg-gradient-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Exportar OS" onClick="exportOs();">
                <i class='material-symbols-rounded'>file_export</i>
              </button>
            </div>
          </div>
          <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Filtros</div>
          <hr class="horizontal dark m-0" />
          <div class="col-3">
            <div class="input-group input-group-outline my-3 ticket">
              <label class="form-label">Cliente</label>
              <input id="ticket" type="text" class="form-control">
            </div>
          </div>
          <div class="col-3">
            <div class="input-group input-group-outline my-3 entry  ">
              <label class="form-label">Entrada</label>
              <input id="entry" type="datetime-local" class="form-control">
            </div>
          </div>
          <div class="col-3">
            <div class="input-group input-group-outline my-3 exit">
              <label class="form-label">Saida</label>
              <input id="exit" type="datetime-local" class="form-control">
            </div>
          </div>
          <div class="col-2 mt-4">
            <Strong class="pt-3">Total: 500</Strong>
          </div>

        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Cadastro de OS</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
                    <div class="input-group input-group-dynamic mb-4">
                      <label class="form-label">Label</label>
                      <input type="text" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">OS</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cliente</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1">Guichê</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-1"></th>
                    </tr>
                  </thead>
                  <tbody class="list">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script src="../assets/libs/sweetalert/dist/sweetalert2.all.min.js"></script>
  <script>
    $(document).ready(function() {
      listServiccesOrders();

      $(`.entry`).addClass('is-filled');
      $(`.exit`).addClass('is-filled');
    });

    const listServiccesOrders = () => {
      $.post("../php/back_serviceorder.php", {
          action: "list_serviceorders"
        })
        .done(function(response) {
          $(".list").html(response);
        });
    }

    const deleteServiceOrder = (args) => {
      let data = {
        action: "delete_serviceorder",
        id: args
      }

      let html =
        `<i style="font-size: 130px; color: #edb72c;" class="fa-solid fa-triangle-exclamation"></i>
        </br></br>
        <div class="alert alert-danger" role="alert">
          <p style="color:#fff;"><strong>Tem Certeza de que deseja excluir este usuario?</strong></p>
        </div>
      `;

      Swal.fire({
        html: html,
        customClass: 'swal-height',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Confirmar',
        showCancelButton: true,
        allowEnterKey: true,
        confirmButtonColor: "#43a047",
        customClass: {
          confirmButton: 'btn bg-gradient-success mb-0 toast-btn',
          cancelButton: 'btn bg-gradient-secondary mb-0 toast-btn'
        },
        width: 500,
        preConfirm: () => {
          $.post("../php/back_serviceorder.php", data)
            .done(response => {
              response = JSON.parse(response);
              $('#infoToast').addClass(response.class);
              $('.html').html(response.message);
              $('#infoToast').toast('show');
              listServiccesOrders();
            });
        },
      });
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>