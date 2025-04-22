<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/walpaper.png">
  <title>
    Ordens de Serviço
  </title>
  <?php require_once("../includes/header.php") ?>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="#" target="_blank">
        <img src="../assets/img/walpaper.png" class="navbar-brand-img" width="50" height="50" alt="main_logo">
        <span class="ms-1 text-sm text-dark"><strong>Costureiros</strong></span>
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
            <div class="col-2">
              <a href="../pages/newserviceorder.php">
                <button type="button" class="btn bg-gradient-dark w-100 m-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nova Ordem de Serviço">Nova OS</button>
              </a>
            </div>
            <div class="col-8">
              <div class="row text-center">
                <h6>
                  <span class="ms-1 badge bg-gradient-info">Criada</span>
                  <span class="badge bg-gradient-warning">Em andamento</span>
                  <span class="ms-1 badge bg-gradient-primary">Aguardando entrega</span>
                  <span class="ms-1 badge bg-gradient-danger">Em Atraso</span>
                  <span class="ms-1 badge bg-gradient-secondary">Atraso de retirada</span>
                  <span class="ms-1 badge bg-gradient-success">Encerrada</span>
                </h6>
              </div>
            </div>
            <div class="col-2 text-end">
              <button type="button" class="btn bg-gradient-dark notify" data-bs-toggle="tooltip" data-bs-placement="bottom" title="OS Em Atraso" onClick="verifyLateServices();">
                <i class='material-symbols-rounded'>e911_emergency</i>
                <span id="notification" style="border-radius: 5px; padding: 2px" class="bg-gradient-danger"></span>
              </button>
              <button type="button" class="btn bg-gradient-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Exportar Balanço" onClick="exportBalance();">
                <i class='material-symbols-rounded'>file_export</i>
              </button>
            </div>
          </div>
          <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Filtros</div>
          <hr class="horizontal dark m-0" />
          <div class="col-2 ">
            <div class="input-group input-group-outline my-3">
              <label class="form-label">Cliente</label>
              <select id="client" class="form-select" placeholder="Cliente">
              </select>
            </div>
          </div>
          <div class="col-2 ">
            <div class="input-group input-group-outline my-3">
              <label class="form-label">Status</label>
              <select id="status" class="form-select" placeholder="Status">
              </select>
            </div>
          </div>
          <div class="col-2 ">
            <div class="input-group input-group-outline my-3">
              <label class="form-label">Tipo de Periodo</label>
              <select id="period" class="form-select" placeholder="Tipo de periodo">
              </select>
            </div>
          </div>
          <div class="col-2">
            <div class="input-group input-group-outline my-3 date  ">
              <label class="form-label">Intervalo</label>
              <input id="date" type="text" class="form-control">
            </div>
          </div>
          <div class='col-2 mt-2 text-center'>
            <Strong class='pt-3' id='labelIncomming'></Strong><br>
            <Strong class='pt-3' id='labelTotal'></Strong>
          </div>
          <div class="col-2 text-end mt-3 pe-4">
            <button type="button" class="btn bg-gradient-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Pesquisar" onClick="listServiccesOrders();">
              <i class='material-symbols-rounded'>search</i>
            </button>
            <button type="button" class="btn bg-gradient-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Limpar Filtros" onClick="clearfilters();">
              <i class='material-symbols-rounded'>clear_all</i>
            </button>
          </div>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Cadastro de Ordem de Serviço</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive data p-0 m-2">
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
    const firstDay = moment().subtract(1, "month").startOf("month").format("YYYY-MM-DD");
    $('#date').val(firstDay);
    let client = "";
    let statusService = "";

    const fetchClients = async () => {
      const response = await $.post("../php/back_serviceorder.php", {
        action: 'load_clients'
      })
      return JSON.parse(response);
    }

    $(document).ready(function() {
      $(function() {
        $('#date').daterangepicker({
          timePicker: true,
          startDate: moment().startOf('month'),
          endDate: moment().endOf('month'),
          locale: {
            format: 'DD/MM/YYYY',
            applyLabel: "Aplicar",
            cancelLabel: "Cancelar",
            fromLabel: "De",
            toLabel: "Até",
            weekLabel: "S",
            daysOfWeek: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],
            monthNames: [
              "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
              "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
            ],
            firstDay: 0 // Domingo como primeiro dia da semana
          },
          ranges: {
            "Hoje": [moment().startOf('day'), moment().endOf('day')],
            "Ontem": [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
            "Últimos 7 Dias": [moment().subtract(6, 'days').startOf('day'), moment().endOf('day')],
            "Últimos 30 Dias": [moment().subtract(29, 'days').startOf('day'), moment().endOf('day')],
            "Este Mês": [moment().startOf('month'), moment().endOf('month')],
            "Mês Passado": [
              moment().subtract(1, 'month').startOf('month'),
              moment().subtract(1, 'month').endOf('month')
            ]
          }
        });
      });

      $('.notify').click();
      setTimeout(() => {
        listServiccesOrders();
      }, 10);
      $(`.date`).addClass('is-filled');

      let clientSelectize = $(`#client`).selectize({
        plugins: ["clear_button"],
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

      let statusServiceSelectize = $(`#status`).selectize({
        plugins: ["clear_button"],
        valueField: 'id',
        labelField: 'name',
        searchField: ['name'],
        sortField: 'name',
        create: false,
        options: [

          {
            id: 1,
            name: 'Em andamento'
          },
          {
            id: 2,
            name: 'Encerrada'
          },
          {
            id: 3,
            name: 'Criada'
          }, {
            id: 4,
            name: 'Aguardando Entrega'
          }, {
            id: 5,
            name: 'Em Atraso'
          }, {
            id: 6,
            name: 'Todas'
          },{
            id: 7,
            name: 'Atraso de Retirada'
          }
        ],

      });

      statusService = statusServiceSelectize[0].selectize;

      let periodSelectize = $(`#period`).selectize({
        plugins: ["clear_button"],
        valueField: 'id',
        labelField: 'name',
        searchField: ['name'],
        sortField: 'name',
        create: false,
        options: [

          {
            id: 1,
            name: 'Entrada'
          },
          {
            id: 2,
            name: 'Saida'
          },
        ],
        onInitialize: function() {
          this.setValue(1);
        }
      });

      periodService = periodSelectize[0].selectize;

      notifyLateServices();

      if (Notification.permission !== "granted") {
        Notification.requestPermission();
      }

      let userInteracted = false;
      document.addEventListener("click", () => {
        userInteracted = true;
      }, {
        once: true
      });

      function notifyLateServices() {
        var localNotify = localStorage.getItem("localNotify");
        let count = "";
        $.post("../php/back_serviceorder.php", {
          action: "notify_late_services",
        }).done(function(response) {
          let data = JSON.parse(response);
          count = data.reduce((acc, item) => acc + item.count, 0);
          $('#notification').html(localNotify);

          if (localNotify == count) {
            return;
          }

          if (count > 0) {
            if (Notification.permission === "granted") {
              new Notification("Alerta de ordem de serviço", {
                body: `Você tem ${count} Ordens de serviços atrasadas`,
              });
            }
            localStorage.setItem("localNotify", count);
          }
        }).then(() => {
          let audio = new Audio("../assets/sounds/notification.mp3");

        });
      }

    });

    // const saveFIlds = () => {
    //   localStorage.setItem('client', valor)
    //   localStorage.setItem('status', valor)
    //   localStorage.setItem('typePeriod', valor)
    //   localStorage.setItem('period', valor)
    // }

    const clearfilters = () => {
      client.clear();
      statusService.clear();
      $('#date').val('');
      $('#period').val('');
    }

    const listServiccesOrders = () => {
      $.post("../php/back_serviceorder.php", {
          action: "list_serviceorders",
          client: $('#client').val(),
          status: $('#status').val() != '' ? $('#status').val() : 7,
          period: $('#period').val(),
          date: $('#date').val(),
        })
        .done(function(response) {
          response = JSON.parse(response);
          let lines = "";

          response.forEach(item => {
            $('#labelIncomming').html('Em caixa R$: ' + item.sumInCash);
            $('#labelTotal').html('Total R$: ' + item.sumTotal);
            lines += `
            <tr>
              <td class='p2-4' style='width: 10px'>
                <i class='fa-solid fa-circle ${item.color}' data-bs-toggle='tooltip' data-bs-placement='bottom' title='${item.status}'></i>
              </td>
              <td class='ps-0'>
                <div class='d-flex px-2 py-1'>
                  <div class='d-flex flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm'>${item.serviceorder}</h6>
                  </div>
                </div>
              </td>
              <td class='ps-0'>
                <div class='d-flex px-2 py-1'>
                  <div class='d-flex flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm'>${item.name}</h6>
                  </div>
                </div>
              </td>
              <td class='ps-0'>
                <div class='d-flex px-2 py-1'>
                  <div class='d-flex flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm'>${item.phone}</h6>
                  </div>
                </div>
              </td>
              <td cclass='ps-3'>
                <div class='d-flex px-2 py-1'>
                  <div class='d-flex flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm'>${item.ticket}</h6>
                  </div>
                </div>
              </td>
              <td cclass='ps-3'>
                <div class='d-flex px-2 py-1'>
                  <div class='d-flex flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm'>${item.incoming}</h6>
                  </div>
                </div>
              </td>
              <td cclass='ps-3'>
                <div class='d-flex px-2 py-1'>
                  <div class='d-flex flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm'>${item.total}</h6>
                  </div>
                </div>
              </td>
              <td cclass='ps-3'>
                <div class='d-flex px-2 py-1'>
                  <div class='d-flex flex-column justify-content-center'>
                    <h6 class='mb-0 text-sm'>${item.remainder}</h6>
                  </div>
                </div>
              </td>
              <td class='text-end'>
                <a type='button' class='btn bg-gradient-warning m-0' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Editar' href='../pages/newserviceorder.php?id=${item.id}&ticket=${item.ticket}'>
                  <i class='material-symbols-rounded opacity-5'>edit</i>
                </a>
                <button type='button' class='btn bg-gradient-danger m-0' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Excluir' onclick='deleteServiceOrder(${item.id})'>
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
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">OS</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cliente</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Telefone</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Guichê</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Entrada</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Total</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Em a ver</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                </tr>
              </thead>
              <tbody class="list">
              ${lines}
              </tbody>
              <tfoot>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">OS</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Cliente</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Telefone</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Guichê</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Entrada</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Total</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-start">Em a ver</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
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
          <p style="color:#fff;"><strong>Tem Certeza de que deseja excluir esta Ordem de Serviço?</strong></p>
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

    const exportBalance = () => {
      let date = $('#date').val() || 0;
      let client = $('#client').val();
      let status = $('#status').val() || 0;
      let url;

      url = `../php/export_balance_excel.php?
      &date=${encodeURIComponent(date)}
      &client=${encodeURIComponent(client)}
      &status=${encodeURIComponent(status)}`;

      window.open(url, '_blank');
    }

    const verifyLateServices = () => {
      const lastDay = moment().endOf("month").format("YYYY-MM-DD");
      $.post("../php/back_serviceorder.php", {
        action: 'verify_late_services',
        entry: moment().startOf("month").format("YYYY-MM-DD"),
        out: lastDay
      })
      listServiccesOrders();
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>
</body>

</html>