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
  <!--     Fonts and icons     -->
  <link rel="stylesheet" href="../assets/css/google-fonts.css" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Material Icons -->
  <link rel="stylesheet" href="../assets/css/google-icons.css" />
  <!-- Font Awesome Icons -->
  <link href="../assets/libs/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  <!-- Daterangerpicker -->
  <link rel="stylesheet" href="../assets/libs/daterangepicker/daterangepicker.css">
  <!-- JQuery -->
  <script src="../assets/js/jquery.js"></script>
  <!-- Selectize -->
  <link rel="stylesheet" href="../assets/libs/selectize/selectize.css" />
  <script src="../assets/libs/selectize/selectize.js"></script>
  <!-- swall -->
  <link rel="stylesheet" href="../assets/libs/sweetalert/dist/sweetalert2.min.css">
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
                <div class="pb-2 pt-1">
                  <button type="button" class="btn osStatus" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Clique para encerrar a OS" onclick="finishOs()"></button>
                </div>
                <form role="form" class="text-start">
                  <input type="hidden" id="id">
                  <div class="row" style="position: relative; z-index: 11;">
                    <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dados da Ordem de serviço</div>
                    <div class="col-2">
                      <div class="input-group input-group-outline my-3 ticket">
                        <label class="form-label">Guichê</label>
                        <input id="ticket" type="number" class="form-control" autocomplete="off">
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
                  <div class="col-1"><button type="button" id='save' class="btn bg-gradient-dark mt-2" onclick="confirmSaveOs();">Salvar</button></div>
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
  <script src="../assets/libs/sweetalert/dist/sweetalert2.all.min.js"></script>
  <script src="../assets/libs/jQueryMask/dist/jquery.mask.js"></script>
  <script>
    $.fn.toNumber = function() {
      return parseFloat($(this).val()) || 0;
    }

    let client = "";
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

    $('#incoming').on('keyup', function() {
      budget();
    });

    $('#total').on('keyup', function() {
      budget();
    });

    $(document).ready(async function() {
      $('#incoming').mask("###.###.00", {
        reverse: true
      });
      $('#total').mask("###.###.00", {
        reverse: true
      });
      $('#remainder').mask("###.###.00", {
        reverse: true
      });

      const queryString = window.location.search;
      const urlParams = new URLSearchParams(queryString);
      id = urlParams.get('id');
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

      if (statusOs == 1) {
        $('#save').attr('disabled', true);
        $('.line').each(function() {
          const row = $(this).attr('row');
          $(`#remove${row}`).attr('disabled', true);
        });
      }
    });

    $(function() {
      $(`.entry`).addClass('is-filled');
      $(`.exit`).addClass('is-filled');
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
      let classstyle = "";
      if (args.row) {
        row = args.row;
        classstyle = "is-filled";
      }

      $('.lines').append(`
        <tr class='line' row='${row}' idOrder='${idOrder}' idService='${selectId}'>
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
      let data = [];

      if (!$('#ticket').val() || !$('#client').val() || !$('#entry').val() || !$('#exit').val()) {
        $('#infoToast').addClass('bg-gradient-warning');
        $('.html').html('Verifique os campos que precisam ser preenchidos ');
        $('#infoToast').toast('show');
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

    const listServiceId = async (arg) => {
      let data = {
        action: "list_serviceorder_id",
        id: arg
      }

      let response = await $.post("../php/back_serviceorder.php", data)
        .done(function(response) {
          response = JSON.parse(response);
          response.forEach(element => {
            os = element.serviceorder;
            name = element.name;
            statusOs = element.servicestatus;
            $("#id").val(element.serviceorder);
            $("#os").html('Nº ' + element.serviceorder);
            $("#ticket").val(element.ticket);
            $("#entry").val(element.sevicentry);
            $("#exit").val(element.servicexit);
            setTimeout(() => {
              client.setValue([element.idclient]);
            }, 500);
            $("#incoming").val(element.incoming);
            $("#total").val(element.total);
            $("#remainder").val(element.remainder);
            $("#balance").val(element.balance);
            $("#debit").val(element.debit);

            if (element.servicestatus == 1) {
              $('.osStatus').addClass('bg-gradient-success');
              $('.osStatus').text('Encerrada');
            } else {
              $('.osStatus').addClass('bg-gradient-warning');
              $('.osStatus').text('Em andamento');
            }

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
        $(`#incoming`).val('0.00').trigger('input');
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

    const finishOs = () => {
      let html = "";
      if (statusOs == 1) {
        html =
          `<i style="font-size: 130px; color: #edb72c;" class="fa-solid fa-triangle-exclamation"></i>
          </br></br>
          <div class="alert alert-danger" role="alert">
            <p style="color:#fff;"><strong>Tem Certeza de que deseja Reabrir a Ordem de Serviço?</strong></p>
          </div>
        `;
      } else {
        html =
          `<i style="font-size: 130px; color: #edb72c;" class="fa-solid fa-triangle-exclamation"></i>
          </br></br>
          <div class="alert alert-danger" role="alert">
            <p style="color:#fff;"><strong>Tem Certeza de que deseja encerrar esta Ordem de Serviço?</strong></p>
          </div>
        `;
      }

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
          $.post("../php/back_serviceorder.php", {
              action: 'set_os_status',
              id,
              statusOs
            })
            .done(async function(response) {
              response = JSON.parse(response);
              $('#infoToast').addClass(response.class);
              $('.html').html(response.message);
              $('#infoToast').toast('show');
              if (response.status == 1) {
                $('.osStatus').removeClass('bg-gradient-warning');
                $('.osStatus').addClass('bg-gradient-success');
                $('.osStatus').text('Encerrada');
                $('#save').attr('disabled', true);
                $('.line').each(function() {
                  const row = $(this).attr('row');
                  $(`#remove${row}`).attr('disabled', true);
                });
                statusOs = response.status;
              } else {
                $('.osStatus').removeClass('bg-gradient-success');
                $('.osStatus').addClass('bg-gradient-warning');
                $('.osStatus').text('Em andamento');
                $('#save').attr('disabled', false);
                $('.line').each(function() {
                  const row = $(this).attr('row');
                  $(`#remove${row}`).attr('disabled', false);
                });
                statusOs = response.status;
              }
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