<?php require_once("../php/_db.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Nova Ordem de Serviço
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Material Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  <!-- Daterangerpicker -->
  <link rel="stylesheet" href="../assets/libs/daterangepicker/daterangepicker.css">
  <!-- JQuery -->
  <script src="../assets/js/jquery.js"></script>
  <!-- Selectize -->
  <link rel="stylesheet" href="../assets/libs/selectize/selectize.css" />
  <script src="../assets/libs/selectize/selectize.js"></script>
</head>

<body class="g-sidenav-show bg-gray-100">
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
  <main class="main-content position-relative border-radius-lg">
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Ordem de Serviço <span id='os'></span></h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="container">
                <form role="form" class="text-start">
                  <input type="hidden" id="id">
                  <div class="row">
                    <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dados da Ordem de serviço</div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 ticket">
                        <label class="form-label">Guichê</label>
                        <input id="ticket" type="text" class="form-control">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 entry">
                        <label class="form-label">DT Entrada /Horário</label>
                        <input id="entry" type="datetime-local" class="form-control">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 exit">
                        <label class="form-label">DT Saída /Horário</label>
                        <input id="exit" type="datetime-local" class="form-control">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Cliente</label>
                        <select id="client" class="form-select">
                          <option value="0" disabled selected>Cliente</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Serviços</div>
                  <hr class="horizontal dark m-0" />
                  <div class="mt-3 row">
                    <div class="p-0">
                      <table class="table table-responsive align-items-center mb-0">
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Serviço</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Preço</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Desconto</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Observação</th>
                            <th class="text-end">
                              <button type="button" class="btn bg-gradient-info m-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Adicionar Serviço" onClick="addRow();">
                                <i class='material-symbols-rounded'>add</i>
                              </button>
                            </th>
                          </tr>
                        </thead>
                        <tbody class="lines" style='position: relative; z-index: 50;'>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="card-footer px-0 pb-2">
              <hr class="dark horizontal my-0">
              <div class="container-fluid text-center">
                <div class="row justify-content-end">
                  <div class="col-1"><button id="login" type="button" class="btn bg-gradient-dark mt-2" onclick="saveOrderService();">Salvar</button></div>
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
  <script src="../assets/libs/daterangepicker/moment.min.js"></script>
  <script src="../assets/libs/daterangepicker/daterangepicker.js"></script>
  <script>
    let client = "";
    let service = "";
    const fetchClients = async () => {
      const response = await $.post("../php/back_serviceoder.php", {
        action: 'load_clients'
      })
      return JSON.parse(response);
    }

    const fetchServices = async () => {
      const response = await $.post("../php/back_serviceoder.php", {
        action: 'load_services'
      })
      return JSON.parse(response);
    }

    $(document).ready(function() {
      const queryString = window.location.search;
      const urlParams = new URLSearchParams(queryString);
      const id = urlParams.get('id');
      if (!id) {
        addRow();
      } else {
        listServiceId(id);
      }

      let clientSelectize = $(`#client`).selectize({
        valueField: 'id',
        labelField: 'name',
        searchField: ['name'],
        sortField: 'name',
        create: false,
      });

      client = clientSelectize[0].selectize;

      fetchClients().then(response => {
        client.addOption(response);
        client.refreshOptions(false);
      });
    });

    $(function() {
      $(`.entry`).addClass('is-filled');
      $(`.exit`).addClass('is-filled');
    });

    const addRow = () => {
      let row = '';
      let actual = '';

      $('tr.line').each(function() {
        actual = $(this).attr('row')
      });

      if (parseInt($('tr.line').attr('row'), 10) > 0) {
        row = parseInt($('tr.line').attr('row'), 10) + parseInt(actual, 10);
      } else {
        row = 1;
      }

      $('.lines').append(`
        <tr class='line' row='${row}'>
          <td>
            <div class="d-flex px-2 py-1 m-2">
              <select class="form-control service${row} is-filled" placeholder="Selecione o Serviço" onchange='setPrice(${row})'>
            </div>
          </td>
          <td>
            <div class="d-flex px-2 py-1">
              <div class="input-group input-group-outline my-3 price${row}">
                <label class="form-label">Preço</label>
                <input id="price${row}" type="number" class="form-control">
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex px-2 py-1">
              <div class="input-group input-group-outline my-3 discount${row}">
                <label class="form-label">Desconto</label>
                <input id="discount${row}" type="number" class="form-control" onkeydown='setIsFilled(${row})'>
              </div>
            </div>
          </td>
          <td colspan='2'>
            <div class="d-flex px-2 py-1">
              <div class="input-group input-group-outline my-3 obs${row}">
                <label class="form-label">Observações</label>
                <input id="obs${row}" type="text" class="form-control" onkeydown='setIsFilled(${row})'>
              </div>
            </div>
          </td>
        </tr>
      `);
      counterSelectorServices(row);
    }

    const counterSelectorServices = (arg) => {

      let serviceSelectize = $(`.service${arg}`).selectize({
        valueField: 'price',
        labelField: 'service',
        searchField: ['service'],
        sortField: 'service',
        create: false,
      });

      service = serviceSelectize[0].selectize;

      fetchServices().then(response => {
        service.addOption(response);
        service.refreshOptions(false);
      });
    };

    const setPrice = (arg) => {
      $(`#price${arg}`).val($(`.service${arg}`).val());
      $(`.price${arg}`).addClass('is-filled');
    }

    const setIsFilled = (arg) => {
      if ($(`#discount${arg}`).val()) {
        $(`.discount${arg}`).addClass('is-filled');
      }

      if ($(`#obs${arg}`).val()) {
        $(`.obs${arg}`).addClass('is-filled');
      }
    }

    const saveOrderService = () => {
      let data = [];

      $('.line').each(function() {
        const row = $(this).attr('row');
        const serviceSelectize = $(this).find(`.service${row}`).selectize()[0].selectize;
        const selectedValue = serviceSelectize.getValue();
        const selectedOption = serviceSelectize.getOption(selectedValue);
        const service = selectedOption.text();
        const priceValue = $(this).find(`#price${row}`).val();
        const discountValue = $(this).find(`#discount${row}`).val();
        const obsValue = $(this).find(`#obs${row}`).val();

        data.push({
          service: service || '',
          price: parseInt(priceValue) || 0,
          discount: parseInt(discountValue) || 0,
          obs: obsValue || ''
        });
      });

      $.post("../php/back_serviceoder.php", {
          action: 'save_orderservice',
          id: $('#id').val(),
          client: $('#client').val(),
          ticket: $('#ticket').val(),
          entry: $('#entry').val(),
          exit: $('#exit').val(),
          data
        })
        .done(function(response) {
          response = JSON.parse(response);
          $('#infoToast').addClass(response.class);
          $('.html').html(response.message);
          $('#infoToast').toast('show');
          if (response.class == 'bg-gradient-success') {
            setTimeout(() => {
              window.location = '../pages/serviceorder.php';
            }, 2000);
          }
        });
    }

    const listServiceId = (arg) => {
      let data = {
        action: "list_serviceorder_id",
        id: arg
      }

      let response = $.post("../php/back_serviceoder.php", data)
        .done(function(response) {
          response = JSON.parse(response);
          response.forEach(element => {
            $("#id").val(element.serviceorder);
            $("#os").html('Nº ' + element.serviceorder);
            $("#ticket").val(element.ticket);
            $("#entry").val(element.sevicentry);
            $("#exit").val(element.servicexit);
            setTimeout(() => {
              client.setValue([element.idclient]);
            }, 30);

            let row = '';
            let actual = '';

            $('tr.line').each(function() {
              actual = $(this).attr('row')
            });

            if (parseInt($('tr.line').attr('row'), 10) > 0) {
              row = parseInt($('tr.line').attr('row'), 10) + parseInt(actual, 10);
            } else {
              row = 1;
            }
            setTimeout(() => {
              $('.lines').append(`
              <tr class='line' row='${row}'>
                <td>
                  <div class="d-flex px-2 py-1 m-2">
                    <select class="form-control service${row} is-filled" placeholder="Selecione o Serviço" onchange='setPrice(${row})'>
                  </div>
                </td>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div class="input-group input-group-outline my-3 is-filled price${row}">
                      <label class="form-label">Preço</label>
                      <input id="price${row}" type="number" class="form-control">
                    </div>
                  </div>
                </td>
                <td>
                  <div class="d-flex px-2 py-1">
                    <div class="input-group input-group-outline my-3 is-filled discount${row}">
                      <label class="form-label">Desconto</label>
                      <input id="discount${row}" type="number" class="form-control" onkeydown='setIsFilled(${row})'>
                    </div>
                  </div>
                </td>
                <td colspan='2'>
                  <div class="d-flex px-2 py-1">
                    <div class="input-group input-group-outline my-3 is-filled obs${row}">
                      <label class="form-label">Observações</label>
                      <input id="obs${row}" type="text" class="form-control" onkeydown='setIsFilled(${row})'>
                    </div>
                  </div>
                </td>
              </tr>
            `);
              counterSelectorServices(row);
              // setTimeout(() => {
              //   service.setValue([element.idservice]);
              // }, 40);
              $(`#price${row}`).val(element.price);
              $(`#discount${row}`).val(element.discount);
              $(`#obs${row}`).val(element.obs);
              exit();
            });
          }, 40);

          setActive();
        })
    }

    const setActive = () => {
      let data = ['ticket'];

      data.forEach(element => {
        if ($(`#${element}`).val()) {
          $(`.${element}`).addClass('is-filled');
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