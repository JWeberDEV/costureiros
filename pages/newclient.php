<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/walpaper.png">
  <title>
    Novo Cliente
  </title>
  <?php require_once("../includes/header.php") ?>
  <?php require_once("../includes/scripsJs.php") ?>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <?php require_once("../includes/toast.php") ?>
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
                <div class="col-2 pb-2 pt-1">
                  <a type="button" href="../pages/clients.php" class="btn bg-gradient-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Retornar"><i class='material-symbols-rounded'>undo</i></a>
                </div>
                <form role="form" class="text-start">
                  <input type="hidden" id="id">
                  <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dados Pessoais</div>
                  <div class="row">
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 name">
                        <label class="form-label">Nome</label>
                        <input id="name" type="user" class="form-control" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 phone">
                        <label class="form-label">Telefone</label>
                        <input id="phone" type="text" class="form-control" maxlength="11" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 phone">
                        <label class="form-label">Telefone Complementar</label>
                        <input id="phoneOption" type="text" class="form-control" maxlength="11" autocomplete="off">
                      </div>
                    </div>
                  </div>
                  <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Endereço</div>
                  <div class="row">
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 cep">
                        <label class="form-label">Cep</label>
                        <input id="cep" type="text" class="form-control" onChange="searchCep()" maxlength="8" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 city">
                        <label class="form-label">Cidade</label>
                        <input id="city" type="text" class="form-control" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 neigbouhod">
                        <label class="form-label">Bairro</label>
                        <input id="neigbouhod" type="text" class="form-control" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 street">
                        <label class="form-label">Rua</label>
                        <input id="street" type="text" class="form-control" onChange="searchCep()" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 number">
                        <label class="form-label">Numero</label>
                        <input id="number" type="number" class="form-control" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 obs">
                        <label class="form-label">Complemento</label>
                        <input id="obs" type="text" class="form-control" autocomplete="off">
                      </div>
                    </div>
                  </div>
                  <div class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Dados Monetários</div>
                  <div class="row">
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 balance">
                        <span class="input-group-text">R$:</span>
                        <label class="form-label">&nbsp;&nbsp;&nbsp;&nbsp;Saldo</label>
                        <input id="balance" type="number" class="form-control extra-padding" autocomplete="off">
                      </div>
                    </div>
                    <div class="col-3">
                      <div class="input-group input-group-outline my-3 debit">
                        <span class="input-group-text">R$:</span>
                        <label class="form-label">&nbsp;&nbsp;&nbsp;&nbsp;Débito</label>
                        <input id="debit" type="number" class="form-control extra-padding" autocomplete="off">
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
                  <div class="col-1 notload"><button id="save" type="button" class="btn bg-gradient-dark mt-2" onclick="saveClient();">Salvar</button></div>
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
    </div>
  </main>

  <script>
    $(document).ready(function() {
      $('.load').hide();
      $('#phone').mask('(00) 00000-0000');
      $('#phoneOption').mask('(00) 00000-0000');
      $('#cep').mask('00000-000');
      $('#balance').mask("###.###.00", {
        reverse: true
      });
      $('#debit').mask("###.###.00", {
        reverse: true
      });
      const queryString = window.location.search;
      const urlParams = new URLSearchParams(queryString);
      const id = urlParams.get('id');
      if (id) {
        listUserId(id);
      }
    });

    const searchCep = () => {
      if ($('#cep').val() && $('#city').val() && $('#street').val()) {
        return;
      }

      let url = "";
      if (!$('#cep').val()) {
        url = `https://viacep.com.br/ws/RS/${encodeURIComponent($('#city').val())}/${encodeURIComponent($('#street').val())}/json/`;
      } else {
        url = `https://viacep.com.br/ws/${$('#cep').val()}/json/`;
      }

      $.post("../php/cepApi.php", {
          url
        })
        .done(response => {
          let data = JSON.parse(response);
          if (data.erro == 'true') {
            showToast({
              class: 'bg-gradient-warning',
              message: 'Cep Não encontrado'
            });
          } else {
            if (!$('#cep').val()) {
              data.forEach(element => {
                $('#cep').val(element.cep);
                $('#neigbouhod').val(element.bairro);
                $('#obs').val(element.complemento);
              });
            } else {
              $('#city').val(data.localidade);
              $('#neigbouhod').val(data.bairro);
              $('#street').val(data.logradouro);
              $('#obs').val(data.complemento);
            }

            setActive();
          }
        });
    }

    const setActive = () => {
      let data = ['cep', 'city', 'neigbouhod', 'street', 'obs'];

      data.forEach(element => {
        if ($(`#${element}`).val()) {
          $(`.${element}`).addClass('is-filled');
        }
      });
    }

    const saveClient = () => {
      $('#save').attr('disabled', 'disabled');
      $('.notload').hide();
      $('.load').show();
      $.post("../php/back_client.php", {
          action: 'save_client',
          id: $('#id').val(),
          name: $('#name').val(),
          phone: $('#phone').val(),
          phoneOption: $('#phoneOption').val(),
          cep: $('#cep').val(),
          city: $('#city').val(),
          neigbouhod: $('#neigbouhod').val(),
          street: $('#street').val(),
          obs: $('#obs').val(),
          number: $('#number').val(),
          balance: $('#balance').val(),
          debit: $('#debit').val(),
        })
        .done(response => {
          let data = JSON.parse(response);
          showToast({
            class: data.class,
            message: data.message
          });
          $('#save').removeAttr('disabled');
          $('.notload').show();
          $('.load').hide();
          if (data.class == 'bg-gradient-success') {
            setTimeout(() => {
              window.location = '../pages/clients.php';
            }, 2000);
          }
        });
    }

    const listUserId = (args) => {
      let data = {
        action: "list_client_id",
        id: args
      }

      let response = $.post("../php/back_client.php", data)
        .done(function(response) {
          response = JSON.parse(response);
          $("#id").val(response.id);
          $("#name").val(response.name);
          $("#phone").val(response.phone);
          $("#phoneOption").val(response.phoneOption);
          $("#cep").val(response.cep);
          $("#city").val(response.city);
          $("#neigbouhod").val(response.neigbouhod);
          $("#street").val(response.street);
          $("#obs").val(response.obs);
          $("#number").val(response.number);
          $("#balance").val(response.balance);
          $("#debit").val(response.debit);

          let data = ['name', 'phone', 'cep', 'city', 'neigbouhod', 'street', 'obs', 'number', 'balance', 'debit'];

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
  </script>
</body>

</html>