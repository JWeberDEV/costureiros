<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/walpaper.png">
  <title>
    Nova Ordem de Serviço
  </title>
  <?php require_once("../includes/header.php") ?>
</head>

<body class="g-sidenav-show bg-gray-100">
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
                <div class="row">
                  <div class="col-3 pb-2 pt-1">
                    <a type="button" href="../pages/serviceorder.php" class="btn bg-gradient-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Retornar"><i class='material-symbols-rounded'>undo</i></a>
                    <div class="btn-group dropdown">
                      <button type="button" class="btn osStatus dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></button>
                      <ul class="dropdown-menu bg-gradient-light" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item bg-gradient-hover text-white bg-gradient-warning" onclick="finishOs(1)">Em andamento</a></li>
                        <li><a class="dropdown-item bg-gradient-hover text-white bg-gradient-success" onclick="finishOs(2)">Encerrada</a></li>
                        <li><a class="dropdown-item bg-gradient-hover text-white bg-gradient-info" onclick="finishOs(3)">Criada</a></li>
                        <li><a class="dropdown-item bg-gradient-hover text-white bg-gradient-primary" onclick="finishOs(4)">Aguardando entrega</a></li>
                        <li><a class="dropdown-item bg-gradient-hover text-white bg-gradient-secondary" onclick="finishOs(6)">Atraso de retirada</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <form role="form" class="text-start">
                  <input type="hidden" id="id">
                  <div class="row" style="position: relative; z-index: 11;">
                    <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dados da Ordem de serviço</div>
                    <div class="col-2">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Guichê</label>
                        <select id="ticket" class="form-select" placeholder="Guichê">
                        </select>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 entry">
                        <label class="form-label">DT Entrada</label>
                        <input id="entry" type="date" class="form-control">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 exit">
                        <label class="form-label">DT Saída</label>
                        <input id="exit" type="date" class="form-control">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3">
                        <label class="form-label">Cliente</label>
                        <select id="client" class="form-select" placeholder="Cliente">
                        </select>
                      </div>
                    </div>
                    <div class="col-1">
                      <button type="button" class="btn bg-gradient-info m-0 mt-3" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Exportar OS" onClick="exportOs();">
                        <i class='material-symbols-rounded'>file_export</i>
                      </button>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 is-filled balance">
                        <span class="input-group-text">R$:</span>
                        <label class="form-label">&nbsp;&nbsp;&nbsp;&nbsp;Saldo</label>
                        <input id="balance" type="number" class="form-control extra-padding" disabled>
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 is-filled debit">
                        <span class="input-group-text">R$:</span>
                        <label class="form-label">&nbsp;&nbsp;&nbsp;&nbsp;Débito</label>
                        <input id="debit" type="number" class="form-control extra-padding" disabled>
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
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 w-15">Serviço</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Item</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3"></th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Preço</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Desconto</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3">Observação</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-3"></th>
                            <th class="text-end">
                              <button type="button" class="btn bg-gradient-info m-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Adicionar Serviço" onClick="addRow();">
                                <i class='material-symbols-rounded'>add</i>
                              </button>
                            </th>
                          </tr>
                        </thead>
                        <tbody class="lines" style='position: relative; z-index: 10;'>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Soma</div>
                  <hr class="horizontal dark m-0" />
                  <div class="row">
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 incoming">
                        <span class="input-group-text">R$:</span>
                        <label class="form-label">&nbsp;&nbsp;&nbsp;&nbsp;Entrada</label>
                        <input id="incoming" type="number" class="form-control extra-padding">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 total">
                        <span class="input-group-text">R$:</span>
                        <label class="form-label">&nbsp;&nbsp;&nbsp;&nbsp;Total</label>
                        <input id="total" type="number" class="form-control extra-padding" onchange="budget()">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 remainder">
                        <span class="input-group-text">R$:</span>
                        <label class="form-label">&nbsp;&nbsp;&nbsp;&nbsp;Em a ver</label>
                        <input id="remainder" type="number" class="form-control extra-padding">
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
                  <div class="col-1"><button type="button" class="btn bg-gradient-info mt-2" onclick="calculator();">Calcular</button></div>
                  <div class="col-1 notload"><button type="button" id='save' class="btn bg-gradient-dark mt-2" onclick="confirmSaveOs();">Salvar</button></div>
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

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="row modal-dialog">
      <div class="col-12">
        <div class="modal-content card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Cadastro de Serviço</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="container">
              <form role="form" class="text-start">
                <input type="hidden" id="id">
                <div class="row">
                  <div class="col-6">
                    <div class="input-group input-group-outline my-3 service">
                      <label class="form-label">Serviço</label>
                      <input id="service" type="user" class="form-control" autocomplete="off">
                    </div>
                  </div>
                  <div class="col-6">
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
          <hr class="horizontal dark m-0" />
          <div class="card-footer px-0 pb-2">
            <div class="container">
              <div class="row justify-content-end">
                <div class="col-2 me-1"><button type="button" class="btn bg-gradient-dark" data-bs-dismiss="modal">Fechar</button></div>
                <div class="col-2 me-3 unload-modal"><button type="button" class="btn bg-gradient-success" onclick="saveService()">Salvar</button></div>
                <div class="col-1 me-3 load-modal">
                  <button class="btn  bg-gradient-success mt-2" type="button" disabled>
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
    <!--   Core JS Files   -->
    <?php require_once("../includes/footer.php") ?>

    <script>
      $.fn.toNumber = function() {
        return parseFloat($(this).val()) || 0;
      }

      let client = "";
      let ticket = "";
      let ticketid = "";
      let service = "";
      let services = [];
      let os = "";
      let name = "";
      let id = "";
      let statusOs = "";
      const fetchClients = async () => {
        const response = await $.post("../php/back_serviceorder.php", {
          action: 'load_clients'
        })
        return JSON.parse(response);
      }

      const fetchServices = async () => {
        const response = await $.post("../php/back_serviceorder.php", {
          action: 'load_services'
        })
        services = JSON.parse(response);
      }

      const fetchTicket = async () => {
        const response = await $.post("../php/back_serviceorder.php", {
          action: 'load_tickets',
          ticketid
        })
        return JSON.parse(response);
      }

      $('#incoming').on('keyup', function() {
        setTimeout(() => {
          budget();
        }, 1500);
      });

      $('#total').on('keyup', function() {
        setTimeout(() => {
          budget();
        }, 500);
      });

      $(document).ready(async function() {
        $('.load').hide();
        $('.load-modal').hide();
        $(`.entry`).addClass('is-filled');
        $(`.exit`).addClass('is-filled');
        // $('#incoming').mask("###.###.00", {
        //   reverse: true
        // });
        $('#total').mask("###.###.00", {
          reverse: true
        });
        $('#remainder').mask("###.###.00", {
          reverse: true
        });
        $('#price').mask("###.###.00", {
          reverse: true
        });
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        id = urlParams.get('id');
        ticketid = urlParams.get('ticket');
        await fetchServices();
        if (!id) {
          addRow();
        } else {
          await listServiceId(id);
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

        let ticketSelectize = $(`#ticket`).selectize({
          valueField: 'id',
          labelField: 'name',
          searchField: ['name'],
          sortField: 'name',
          sortField: "$order",
          create: false,
        });

        ticket = ticketSelectize[0].selectize;

        fetchTicket().then(response => {
          ticket.addOption(response);
          ticket.refreshOptions(false);
        });

        if (statusOs == 2) {
          $('#save').attr('disabled', true);
          $('.line').each(function() {
            const row = $(this).attr('row');
            $(`#remove${row}`).attr('disabled', true);
          });
        }
      });

      const addRow = (args = {}) => {
        let row = "";
        let actual = '';

        $('tr.line').each(function() {
          actual = $(this).attr('row')
        });

        if (parseInt($('tr.line').attr('row'), 10) > 0) {
          row = parseInt($('tr.line').attr('row'), 10) + parseInt(actual, 10);
        } else {
          row = 1;
        }

        const selectId = args?.element?.idservice ? `${args.element.idservice}` : '';
        const idOrder = args?.element?.idorder ? `${args.element.idorder}` : '';
        const service = args?.element?.service ? `placeholder=${args.element.service}` : 'placeholder="Selecione o Serviço"';
        let id = '';
        let classstyle = "is-filled";

        $('.lines').append(`
        <tr class='line' row='${row}' idOrder='${idOrder}' idService='${selectId}'>
          <td>
          <button type="button" class="btn bg-gradient-success mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class='material-symbols-rounded pt-1 pb-1'>add</i>
          </button>
          </td>
          <td>
            <div class="d-flex px-2 py-1 m-2 is-filled">
              <select id='${selectId}' class="form-control service${row}" ${service} onchange='setPrice(${row}), calculator();'>
            </div>
          </td>
          <td colspan='2'>
            <div class="d-flex px-2 py-1">
              <div class="input-group input-group-outline my-3 ${classstyle} item${row}">
                <label class="form-label">Item</label>
                <input id="item${row}" type="text" class="form-control" onblur="onkeydown='setIsFilled(${row})'" onkeydown='setIsFilled(${row})' autocomplete="off">
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex px-2 py-1">
              <div class="input-group input-group-outline my-3 ${classstyle} price${row}">
                <span class="input-group-text">R$:</span>
                <label class="form-label">&nbsp;&nbsp;&nbsp;&nbsp;Preço</label>
                <input id="price${row}" type="number" class="form-control extra-padding" autocomplete="off">
              </div>
            </div>
          </td>
          <td>
            <div class="d-flex px-2 py-1">
              <div class="input-group input-group-outline my-3 ${classstyle} discount${row}">
                <span class="input-group-text">R$:</span>
                <label class="form-label">&nbsp;&nbsp;&nbsp;&nbsp;Desconto</label>
                <input id="discount${row}" type="number" class="form-control extra-padding" onkeydown='setIsFilled(${row})' onblur='format(${row});calculator()' autocomplete="off">
              </div>
            </div>
          </td>
          <td colspan='2'>
            <div class="d-flex px-2 py-1">
              <div class="input-group input-group-outline my-3 ${classstyle} obs${row}">
                <label class="form-label">Observações</label>
                <input id="obs${row}" type="text" class="form-control" onkeydown='setIsFilled(${row})' autocomplete="off">
              </div>
            </div>
          </td>
          <td class="text-center ps-0">
            <button type="button" id='remove${row}' class="btn btn-danger mt-3 ms-4" onclick="removeRow(${row},${idOrder})"><i class='material-symbols-rounded pt-1 pb-1'>remove</i></button>
          </td>
        </tr>
      `);
        $(`#price${row}`).mask("###.###.00", {
          reverse: true
        });
        $(`#discount${row}`).mask("###.###.00", {
          reverse: true
        });
        if (args.row) {
          setActive();
        } else {
          counterSelectorServices(row);
        }
      }

      function removeRow(row, idOrder) {

        if (id && $(`.service${row}`).val()) {
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
              $.post("../php/back_serviceorder.php", {
                  action: 'delete_service',
                  idOrder
                })
                .done(function(response) {
                  response = JSON.parse(response);
                  if (response.code == 1) {
                    $(`tr[row='${row}']`).remove();
                    calculator();
                  }
                });
            },
          });
        } else {
          $(`tr[row='${row}']`).remove();
        }
      }

      const format = (arg) => {
        let val = parseFloat($(`#discount${arg}`).val());
        let formattedVal = val.toFixed(2);
        $(`#discount${arg}`).val(formattedVal).trigger('input');
      }

      const counterSelectorServices = (row, value) => {
        const serviceSelectize = $(`.service${row}`).selectize({
          valueField: 'id',
          labelField: 'service',
          searchField: ['service'],
          sortField: 'service',
          create: false,
        });

        service = serviceSelectize[0].selectize;

        service.addOption(services);
        service.refreshOptions(false);

        if (value) {
          service.setValue(value);
        }
      };

      const setPrice = (arg) => {
        const serviceId = $(`.service${arg}`).val();
        const price = services.find(service => service.id == serviceId).price;
        $(`#price${arg}`).val(price);
        $(`.price${arg}`).addClass('is-filled');
      }

      const setIsFilled = (arg) => {
        if ($(`#item${arg}`).val()) {
          $(`.item${arg}`).addClass('is-filled');
        }

        if ($(`#discount${arg}`).val()) {
          $(`.discount${arg}`).addClass('is-filled');
        }

        if ($(`#obs${arg}`).val()) {
          $(`.obs${arg}`).addClass('is-filled');
        }
      }

      const confirmSaveOs = () => {
        if (parseFloat($('#incoming').val()) > parseFloat($('#total').val())) {
          let html =
            `<i style="font-size: 130px; color: #edb72c;" class="fa-solid fa-triangle-exclamation"></i>
          </br></br>
          <div class="alert alert-danger" role="alert">
            <p style="color:#fff;">
              <strong>
                O valor de entrada é maior que o valor total.
                Tem Certeza de que deseja excluir este Serviço?
              </strong>
            </p>
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
          }).then((result) => {
            if (!result.isConfirmed) {
              return;
            }
            saveOrderService();
          });
        } else {
          saveOrderService();
        }
      }

      const saveOrderService = () => {
        $('#save').attr('disabled', 'disabled');
        $('.notload').hide();
        $('.load').show();
        let data = [];

        if (!$('#ticket').val() || !$('#client').val() || !$('#entry').val() || !$('#exit').val()) {
          $('#infoToast').addClass('bg-gradient-warning');
          $('.html').html('Verifique os campos que precisam ser preenchidos ');
          $('#infoToast').toast('show');
          $('#save').removeAttr('disabled');
          $('.notload').show();
          $('.load').hide();
          return;
        }

        if (!$('#incoming').val()) {
          $('#infoToast').addClass('bg-gradient-danger');
          $('.html').html('É preciso preencher corretamente o campo de entrada');
          $('#infoToast').toast('show');
          $('#save').removeAttr('disabled');
          $('.notload').show();
          $('.load').hide();
          return;
        }

        $('.line').each(function() {
          const row = $(this).attr('row');
          const idService = $(`.service${row}`).val();
          const order = $(this).attr('idorder');
          const item = $(this).find(`#item${row}`).val();
          const priceValue = $(this).find(`#price${row}`).val();
          const discountValue = $(this).find(`#discount${row}`).val();
          const obsValue = $(this).find(`#obs${row}`).val();

          data.push({
            idService: idService || '',
            order: order || '',
            item: item || '',
            price: parseFloat(priceValue) || 0,
            discount: parseFloat(discountValue) || 0,
            obs: obsValue || ''
          });
        });

        $.post("../php/back_serviceorder.php", {
            action: 'save_orderservice',
            id,
            client: $('#client').val(),
            ticket: $('#ticket').val(),
            entry: $('#entry').val(),
            exit: $('#exit').val(),
            incoming: $('#incoming').val(),
            total: $('#total').val(),
            remainder: $('#remainder').val(),
            data
          })
          .done(function(response) {
            response = JSON.parse(response);
            $('#infoToast').removeClass('bg-gradient-danger','bg-gradient-warning','bg-gradient-success');
            $('#infoToast').addClass(response.class);
            $('#infoToast').toast('show');
            $('.html').html(response.message);
            $('#save').removeAttr('disabled');
            $('.notload').show();
            $('.load').hide();
            if (response.class == 'bg-gradient-success') {
              setTimeout(() => {
                window.location = '../pages/serviceorder.php';
              }, 2000);
            }
          });
      }

      const listServiceId = async (arg) => {
        let response = await $.post("../php/back_serviceorder.php", {
            action: "list_serviceorder_id",
            id: arg
          })
          .done(function(response) {
            response = JSON.parse(response);
            response.forEach(element => {
              os = element.serviceorder;
              name = element.name;
              statusOs = element.servicestatus;
              $("#id").val(element.serviceorder);
              $("#os").html('Nº ' + element.serviceorder);
              $("#entry").val(element.sevicentry);
              $("#exit").val(element.servicexit);
              setTimeout(() => {
                ticket.setValue([element.ticket]);
              }, 1200);
              setTimeout(() => {
                client.setValue([element.idclient]);
              }, 1200);
              $('.osStatus').addClass(element.button);
              $('.osStatus').text(element.status);

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

              addRow({
                row,
                element
              });

              const serviceSelectize = $(`.service${row}`).selectize({
                valueField: 'id',
                labelField: 'service',
                searchField: ['service'],
                sortField: 'service',
                create: false,
              });
              service = serviceSelectize[0].selectize;
              service.addOption(services);

              service.setValue(element.idservice)
              $(`#item${row}`).val(element.item);
              $(`#price${row}`).val(element.price);
              $(`#discount${row}`).val(element.discount);
              $(`#obs${row}`).val(element.obs);
              $(`.total`).addClass('is-filled');
              $(`.remainder`).addClass('is-filled');
              $("#incoming").val(element.incoming);
              $("#total").val(element.total);
              $("#remainder").val(element.remainder);
              $("#balance").val(element.balance);
              $("#debit").val(element.debit);
            });

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

      const calculator = () => {
        let value = 0;
        let discount = 0;
        $('.line').each(function() {
          const row = $(this).attr('row');
          value += $(this).find(`#price${row}`).toNumber();
          discount += $(this).find(`#discount${row}`).toNumber();
        });

        let result = value - discount;
        let formattedResult = result.toFixed(2);
        $('#total').val(formattedResult).trigger('input');
        $(`.total`).addClass('is-filled');

        budget();
      }

      const budget = () => {
        let incoming = $(`#incoming`).toNumber() ? $(`#incoming`).toNumber() : 0;
        if (incoming == 0) {
          // $(`#incoming`).val('0.00').trigger('input');
          $(`.incoming`).addClass('is-filled');
        }
        let result = $(`#total`).toNumber() - incoming;
        let formattedResult = result.toFixed(2);
        $(`#remainder`).val(formattedResult).trigger('input');
        $(`.remainder`).addClass('is-filled');
      }

      const exportOs = () => {
        url = `../php/export_os_pdf.php?id=${encodeURIComponent(id)}&
          os=${encodeURIComponent(os)}
          &entry=${encodeURIComponent($("#entry").val())}
          &exit=${encodeURIComponent($("#exit").val())}
          &name=${encodeURIComponent(name)}`;
        window.open(url, '_blank');
      }

      const finishOs = (arg) => {
        let html =
          `<i style="font-size: 130px; color: #edb72c;" class="fa-solid fa-triangle-exclamation"></i>
          </br></br>
          <div class="alert alert-danger" role="alert">
            <p style="color:#fff;"><strong>Tem Certeza de que deseja alterar o estado desta OS?</strong></p>
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
            $.post("../php/back_serviceorder.php", {
                action: 'set_os_status',
                id,
                statusOs: arg
              })
              .done(async function(response) {
                response = JSON.parse(response);
                $('#infoToast').addClass(response.class);
                $('.html').html(response.message);
                $('#infoToast').toast('show');
                statusOs = response.status;
                if (response.status == 2) {
                  $('#save').attr('disabled', true);
                  $('.line').each(function() {
                    const row = $(this).attr('row');
                    $(`#remove${row}`).attr('disabled', true);
                  });
                } else {
                  $('#save').attr('disabled', false);
                  $('.line').each(function() {
                    const row = $(this).attr('row');
                    $(`#remove${row}`).attr('disabled', false);
                  });
                }

                window.location.reload();

                // if (response.stauts != 2) {
                //   setTimeout(() => {
                //     window.location = '../pages/serviceorder.php';
                //   }, 2000);
                // }
              });
          },
        });
      }

      saveService = () => {
        $('#save').attr('disabled', 'disabled');
        $('.unload-modal').hide();
        $('.load-modal').show();
        $.post("../php/back_service.php", {
            action: 'save_service',
            id: "",
            service: $('#service').val(),
            price: $('#price').val(),
          })
          .done(response => {
            let data = JSON.parse(response);
            $('#infoToast').addClass(data.class);
            $('.html').html(data.message);
            $('#infoToast').toast('show');
            $('#save').removeAttr('disabled');
            $('.unload-modal').show();
            $('.load-modal').hide();
            refreshSelectize();
            $('.modal').modal('hide');
          });
      }

      const refreshSelectize = async () => {
        await fetchServices();
        $('.line').each(function() {
          const row = $(this).attr('row');
          const $select = $(`.service${row}`);

          if (!$select.val() || $select.val().length === 0) {
            $select[0].selectize.addOption(services);
            $select[0].selectize.refreshOptions();
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