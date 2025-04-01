<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/walpaper.png">
  <title>
    Novo Serviço
  </title>
  <?php require_once("../includes/header.php") ?>

</head>

<body class="g-sidenav-show  bg-gray-100">
  <div
    class="toast fade hide p-2 mt-2 top-0 end-1"
    role="alert"
    aria-live="assertive"
    id="infoToast"
    aria-atomic="true"
    style="z-index: 50; position: fixed;">
    <hr class="horizontal light m-0" />
    <div class="toast-body text-white">
      <div class="html"></div>
    </div>
  </div>
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="#" target="_blank">
        <img src="../assets/img/walpaper.png" class="navbar-brand-img" width="50" height="50" alt="main_logo">
        <span class="ms-1 text-sm text-dark"><strong>Costureiros</strong></span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Rotinas</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/serviceorder.php">
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
          <a class="nav-link active bg-gradient-dark text-white" href="../pages/services.php">
            <i class="material-symbols-rounded opacity-5">receipt_long</i>
            <span class="nav-link-text ms-1">Cadastro de serviços</span>
          </a>
        </li>
      </ul>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Novo Serviço</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <hr class="dark horizontal my-0">
              <div class="container">
                <div class="col-2 pb-2 pt-1">
                  <a type="button" href="../pages/services.php" class="btn bg-gradient-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Retornar"><i class='material-symbols-rounded'>undo</i></a>
                </div>
                <form role="form" class="text-start">
                  <input type="hidden" id="id">
                  <div class="row">
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 service">
                        <label class="form-label">Serviço</label>
                        <input id="service" type="user" class="form-control" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 price">
                        <span class="input-group-text">R$:</span>
                        <label class="form-label">&nbsp;&nbsp;&nbsp;&nbsp;Preço</label>
                        <input id="price" type="number" class="form-control extra-padding" autocomplete="off" onchange="format()">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card-footer px-0 pb-2">
              <hr class="dark horizontal my-0">
              <div class="container-fluid text-center">
                <div class="row justify-content-end">
                  <div class="col-1"><button id="save" type="button" class="btn bg-gradient-dark mt-2" onclick="saveService();">Salvar</button></div>
                  <div class="col-1 load">
                  <button class="btn  bg-gradient-dark mt-2" type="button" disabled>
                    <span class="spinner-grow spinner-grow-sm" aria-hidden="true"></span>
                    <span class="visually-hidden" role="status">Loading...</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </main>
  <!--   Core JS Files   -->
  <?php require_once("../includes/footer.php") ?>

  <script>
    $(document).ready(function() {
      $('.load').hide();
      $('#price').mask("###.###.00", {
        reverse: true
      });
      const queryString = window.location.search;
      const urlParams = new URLSearchParams(queryString);
      const id = urlParams.get('id');
      if (id) {
        listUserId(id);
      }
    });

    const setActive = () => {
      let data = ['service', 'price'];

      data.forEach(element => {
        if ($(`#${element}`).val()) {
          $(`.${element}`).addClass('is-filled');
        }
      });
    }

    const format = () => {
      let val = parseFloat($('#price').val());
      let formattedVal = val.toFixed(2);
      $('#price').val(formattedVal).trigger('input');
    }

    const listUserId = (args) => {
      let data = {
        action: "list_user_id",
        id: args
      }

      let response = $.post("../php/back_service.php", data)
        .done(function(response) {
          response = JSON.parse(response);
          $("#id").val(response.id);
          $("#service").val(response.service);
          $("#price").val(response.price);

          setActive();
        })
    }

    const saveService = () => {
      $('#save').attr('disabled', 'disabled');
      $('.notload').hide();
      $('.load').show();
      $.post("../php/back_service.php", {
          action: 'save_service',
          id: $('#id').val(),
          service: $('#service').val(),
          price: $('#price').val(),
        })
        .done(response => {
          let data = JSON.parse(response);
          $('#infoToast').addClass(data.class);
          $('.html').html(data.message);
          $('#infoToast').toast('show');
          $('#save').removeAttr('disabled');
          $('.notload').show();
          $('.load').hide();
          if (data.class == 'bg-gradient-success') {
            setTimeout(() => {
              window.location = '../pages/services.php';
            }, 2000);
          }
        });
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>