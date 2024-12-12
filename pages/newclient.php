<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Novo Cliente
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
    class="toast fade hide p-2 mt-2 top-0 end-1"
    role="alert"
    aria-live="assertive"
    id="infoToast"
    aria-atomic="true"
    style="z-index: 5; position: fixed;">
    <hr class="horizontal light m-0" />
    <div class="toast-body text-white">
      <div class="html"></div>
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
          <a class="nav-link text-dark" href="../pages/serviceorder.php">
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
                  <input type="hidden" id="id">
                  <div class="row">
                    <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dados Pessoais</div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 name">
                        <label class="form-label">Nome</label>
                        <input id="name" type="user" class="form-control">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 phone">
                        <label class="form-label">Telefone</label>
                        <input id="phone" type="number" class="form-control" maxlength="11">
                      </div>
                    </div>
                  </div>
                  <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Endereço</div>
                  <div class="row">
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 cep">
                        <label class="form-label">Cep</label>
                        <input id="cep" type="number" class="form-control" onChange="searchCep()" maxlength="8">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 city">
                        <label class="form-label">Cidade</label>
                        <input id="city" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 neigbouhod">
                        <label class="form-label">Bairro</label>
                        <input id="neigbouhod" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 street">
                        <label class="form-label">Rua</label>
                        <input id="street" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 obs">
                        <label class="form-label">Complemento</label>
                        <input id="obs" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 obs">
                        <label class="form-label">Numero</label>
                        <input id="number" type="number" class="form-control">
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
                  <div class="col-1"><button id="login" type="button" class="btn bg-gradient-dark mt-2" onclick="saveClient();">Salvar</button></div>
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
    $(document).ready(function() {
      const queryString = window.location.search;
      const urlParams = new URLSearchParams(queryString);
      const id = urlParams.get('id');
      if (id) {
        listUserId(id);
      }
    });

    const searchCep = () => {
      $.post("../php/cepApi.php", {
          cep: $('#cep').val(),
        })
        .done(response => {
          let data = JSON.parse(response);
          if (data.erro == 'true') {
            $('#infoToast').toast('show');
          } else {
            $('#city').val(data.localidade);
            $('#neigbouhod').val(data.bairro);
            $('#street').val(data.logradouro);
            $('#obs').val(data.complemento);

            setActive();
          }
        });
    }

    const setActive = () => {
      let data = ['city', 'neigbouhod', 'street', 'obs'];

      data.forEach(element => {
        if ($(`#${element}`).val()) {
          $(`.${element}`).addClass('is-filled');
        }
      });
    }

    const listUserId = (args) => {
      let data = {
        action: "list_user_id",
        id: args
      }

      let response = $.post("../php/back_client.php", data)
        .done(function(response) {
          response = JSON.parse(response);
          $("#id").val(response.id);
          $("#name").val(response.name);
          $("#phone").val(response.phone);
          $("#cep").val(response.cep);
          $("#city").val(response.city);
          $("#neigbouhod").val(response.neigbouhod);
          $("#street").val(response.street);
          $("#obs").val(response.obs);
          $("#number").val(response.number);

          let data = ['name', 'phone', 'cep', 'city', 'neigbouhod', 'street', 'obs', 'number'];

          data.forEach(element => {
            if ($(`#${element}`).val()) {
              $(`.${element}`).addClass('is-filled');
            }
          });
        }).fail(() => {
          default_notification({
            type: "danger",
            message: error
          });
        });
    }

    const saveClient = () => {
      $.post("../php/back_client.php", {
          action: 'save_user',
          id: $('#id').val(),
          name: $('#name').val(),
          phone: $('#phone').val(),
          cep: $('#cep').val(),
          city: $('#city').val(),
          neigbouhod: $('#neigbouhod').val(),
          street: $('#street').val(),
          obs: $('#obs').val(),
          number: $('#number').val(),
        })
        .done(response => {
          let data = JSON.parse(response);
          $('#infoToast').addClass(data.class);
          $('.html').html(data.message);
          $('#infoToast').toast('show');
          if (data.class == 'bg-gradient-success') {
            setTimeout(() => {
              window.location = '../pages/clients.php';
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