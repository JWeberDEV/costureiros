<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Login
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" href="../assets/css/google-fonts.css" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link href="../assets/libs/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Material Icons -->
  <link rel="stylesheet" href="../assets/css/google-icons.css" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  <!-- JQuery -->
  <script src="../assets/js/jquery.js"></script>
</head>

<body class="bg-gray-200">
  <main class="main-content  mt-0">
    <div class="page-header align-items-start min-vh-100" style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div
        class="toast fade hide p-2 mt-2 bg-gradient-danger top-0 end-1"
        role="alert"
        aria-live="assertive"
        id="infoToast"
        aria-atomic="true"
        style="z-index: 5; position: fixed;">
        <hr class="horizontal light m-0" />
        <div class="toast-body text-white">
          Senha Incorreta
        </div>
      </div>
      <div class="container my-auto">
        <div class="row">
          <div class="col-lg-4 col-md-8 col-12 mx-auto">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                  <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Entrar</h4>
                </div>
              </div>
              <div class="card-body">
                <form role="form" class="text-start">
                  <div class="input-group input-group-outline my-3">
                    <label class="form-label">Usuário</label>
                    <input id="user" type="user" class="form-control">
                  </div>
                  <div class="input-group input-group-outline mb-3">
                    <label class="form-label">Senha</label>
                    <input id="password" type="password" class="form-control">
                  </div>
                  <div class="text-center">
                    <button id="login" type="button" class="btn bg-gradient-dark w-100 my-4 mb-2" onclick="login();">Entrar</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="footer position-absolute bottom-2 py-2 w-100">
      <div class="container">
        <div class="row align-items-center justify-content-lg-center">
          <div class="col-12 col-md-6 my-auto">
            <div class="copyright text-center text-sm text-white">
              © <script>
                document.write(new Date().getFullYear())
              </script>,
              Ceiado por Josias Weber
            </div>
          </div>
        </div>
      </div>
    </footer>
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    const login = () => {
      let user = $("#user").val();
      let password = $("#password").val();

      if (user.trim() == "" || password.trim() == "") {
        default_notification({
          type: "danger",
          message: "É necessário preencher os campos de login e senha para efetuar o Login!"
        });
        return;
      }

      let data = {
        action: 'login',
        user,
        password
      }

      $.post("../php/action.php", data)
        .done(function(response) {
          response = JSON.parse(response);
          if (response.return == 1) {
            location.href = '../pages/serviceorder.php';
          } else if (response.return == 0) {
            $('#infoToast').toast('show');
          }
        });
    }

    $("#user").keyup(function(data) {
      if (data.keyCode === 13) {
        $("#login").click();
      }
    });

    $("#password").keyup(function(data) {
      if (data.keyCode === 13) {
        $("#login").click();
      }
    });

    $("#login").click(function() {
      login();
    });
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>