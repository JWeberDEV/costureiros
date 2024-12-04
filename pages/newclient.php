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
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  <!-- JQuery -->
  <script src="../assets/js/jquery.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <div
    class="toast fade hide p-2 mt-2 bg-gradient-danger top-0 end-1"
    role="alert"
    aria-live="assertive"
    id="infoToast"
    aria-atomic="true"
    style="z-index: 5; position: fixed;">
    <hr class="horizontal light m-0" />
    <div class="toast-body text-white">
      O Cep informado é invalido
    </div>
  </div>
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm text-dark">Costureiros</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Rotinas</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/dashboard.php">
            <i class="material-symbols-rounded opacity-5">description</i>
            <span class="nav-link-text ms-1">OS</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="../pages/clients.php">
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
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Novo Cliente</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <hr class="dark horizontal my-0">
              <div class="container">
                <form role="form" class="text-start">
                  <div class="row">
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Nome</label>
                        <input id="user" type="user" class="form-control">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Telefone</label>
                        <input id="password" type="text" class="form-control" maxlength="11">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Cep</label>
                        <input id="cep" type="text" class="form-control" onChange="searchCep()" maxlength="8">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Cidade</label>
                        <input id="city" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Bairro</label>
                        <input id="neigbouhod" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Rua</label>
                        <input id="street" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Complemento</label>
                        <input id="obs" type="text" class="form-control">
                      </div>
                    </div>
                  </div>
              </div>
              </form>
            </div>
            <div class="card-footer px-0 pb-2">
              <hr class="dark horizontal my-0">
              <div class="container-fluid text-center">
                <div class="row justify-content-end">
                  <div class="col-1"><button id="login" type="button" class="btn bg-gradient-dark mt-2" onclick="newClient();">Salvar</button></div>
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
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <script>
    const searchCep = () => {
      $.post("../php/cepApi.php", {
          cep: $('#cep').val(),
        })
        .done(response => {
          let data = JSON.parse(response);
          if (data.erro == 'true') {
            $('#infoToast').toast('show');
          } else {
            $('#city').val(data.localidade).focus();
            $('#neigbouhod').val(data.bairro).focus();
            $('#street').val(data.logradouro).focus();
            $('#obs').val(data.complemento).focus();
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