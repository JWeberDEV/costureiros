<?php
$page = 'services';
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/walpaper.png">
  <title>
    Serviços
  </title>
  <?php require_once("../includes/header.php") ?>
  <?php require_once("../includes/scripsJs.php") ?>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <?php require_once("../includes/sidebar.php") ?>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg mt-2 px-0 mx-2 card" id="navbarBlur" data-scroll="true">
      <div class="container-fluid text-center">
        <div class="row justify-content-start">
          <div class="col-2">
            <a href="../pages/newservice.php">
              <button type="button" class="btn bg-gradient-dark w-100 m-0">Novo Serviço</button>
            </a>
          </div>
        </div>
        <div class="row justify-content-start">
          <div class="col-11 pt-3 pe-2 pb-0">
            <div class="input-group input-group-outline">
              <label class="form-label">Buscar Serviço</label>
              <input id='service' type="text" class="form-control">
            </div>
          </div>
          <div class="col-1 text-end pt-3 ps-5">
            <button type="button" id='search' class="btn bg-gradient-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Pesquisar" onClick="listServicces();">
              <i class='material-symbols-rounded'>search</i>
            </button>
          </div>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-12 px-2">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Cadastro de Serviços</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="m-2 table-responsive p-0 data">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script>
    $(document).ready(function() {
      listServicces();
    });

    $("#service").keyup(function(data) {
      if (data.keyCode === 13) {
        $("#search").click();
      }
    });

    const listServicces = () => {
      $.post("../php/back_service.php", {
          action: "list_services",
          service: $('#service').val()
        })
        .done(function(response) {
          response = JSON.parse(response);
          let lines = "";

          response.forEach(item => {
            lines += `
            <tr>
              <td>
                <div class='d-flex px-2 py-1'>
                  <div class='d-flex flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm'>${item.service}</h6>
                  </div>
                </div>
              </td>
              <td class='align-middle text-center'>
                <div class='d-flex px-2 py-1'>
                  <div class='d-flex flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm'>${item.price}</h6>
                  </div>
                </div>
              </td>
              <td class='text-end'>
                <a type='button' class='btn bg-gradient-warning m-0' data-toggle='tooltip' title='Editar' href="../pages/newservice.php?id=${item.id}">
                  <i class='material-symbols-rounded opacity-5'>edit</i>
                </a>
                <button type='button' class='btn bg-gradient-danger m-0' data-toggle='tooltip' data-placement='top' title='Excluir' onclick="deleteService('${item.id}')">
                  <i class='material-symbols-rounded opacity-5'>delete</i>
                </button>
              </td>
            </tr>
            `;
          });

          let html = `
            <table id='table' class="table table-striped table-hover" style="width:100%">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Serviço</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Preço</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-boldery opacity-7"></th>
                </tr>
              </thead>
              <tbody class="list">
              ${lines}
              </tbody>
              <tfoot>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Serviço</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Preço</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-boldery opacity-7"></th>
                </tr>
              </tfoot>
            </table>
          `;

          $('.data').html(html);

          // Initialize DataTable after updating the table
          $('#table').DataTable({
            language: {
              url: "../assets/libs/datatable/pt-br.json"
            },
            searching: false,
            pagingType: false
          });
        });
    };

    const deleteService = (args) => {
      let data = {
        action: "delete_client",
        id: args
      }

      let html =
        `<i style="font-size: 130px; color: #edb72c;" class="fa-solid fa-triangle-exclamation"></i>
        </br></br>
        <div class="alert alert-danger" role="alert">
          <p style="color:#fff;"><strong>Tem Certeza de que deseja excluir este Serviço?</strong></p>
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
        cancelButtonColor: "#f44335",
        customClass: {
          confirmButton: 'btn bg-gradient-success mb-0 toast-btn',
          cancelButton: 'btn bg-gradient-secondary mb-0 toast-btn'
        },
        width: 500,
        preConfirm: () => {
          $.post("../php/back_service.php", data)
            .done(response => {
              response = JSON.parse(response);
              showToast({
                class: response.class,
                message: response.message
              });
              listServicces();
            });
        },
      });
    }
  </script>
</body>

</html>