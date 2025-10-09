<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/walpaper.png">
  <title>
    Aniversariantes do Dia
  </title>
  <?php require_once("../includes/header.php") ?>
  <?php require_once("../includes/scripsJs.php") ?>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <?php require_once("../includes/toast.php") ?>
  <?php require_once("../includes/sidebar.php") ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-12 px-2">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Aniversariantes do Dia</h6>
              </div>
            </div>
            <div class="card-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-4">
                    <button type="button"
                      class="btn bg-gradient-warning"
                      data-bs-toggle="tooltip"
                      data-bs-placement="bottom"
                      title="Limpar Notificação"
                      onclick="clearNotification()">
                      <i class="material-symbols-rounded">notifications_off</i>
                    </button>
                    <div class="card birth" style="box-shadow: none;">
                      <div class="slide slide1">
                        <div class="content">
                          <div class="icon text-center d-flex align-items-center justify-content-center">
                            <!-- <img src="../assets/img/walpaper.png" width="200" height="200" alt="" style="border-radius: 7px;"> -->
                            <h2 class="text-white ">Aniversariantes do Dia</h2>
                          </div>
                        </div>
                      </div>
                      <div class="slide slide2">
                        <div class="content">
                          <p><strong class="names"></strong></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer px-0 pb-2">

            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </main>
</body>

</html>
<script>
  $(document).ready(function() {
    getNameBirths();
  });

  const getNameBirths = () => {
    $.post("../php/back_client.php", {
      action: "get_name_births",
    }).done(function(response) {
      const data = JSON.parse(response);

      let Name = '';

      data.forEach((item) => {
        Name += item.name + ', ';
      });

      $('.names').html(Name.slice(0, -2));

    });
  }
</script>