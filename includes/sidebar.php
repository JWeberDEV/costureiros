<?php
$config = (object) parse_ini_file("../config.ini", true);
?>

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2"
  id="sidenav-main">
  <div class="sidenav-header text-center">
    <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
      aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="#" target="_blank">
      <img src="../assets/img/walpaper.png" class="navbar-brand-img" alt="main_logo">
      <span class="ms-1 text-sm text-dark"><strong class="name"><?php echo $config->settings['name'] ?></strong></span>
    </a>
  </div>
  <hr class="horizontal dark mt-0 mb-2">
  <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5 routines">Rotinas</h6>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if ($page == 'os') {
                              echo ' active bg-gradient-dark text-white';
                            } else {
                              echo 'text-dark';
                            } ?>" href="../pages/serviceorder.php"
          title="OS - Ordem de Serviço">
          <i class="material-symbols-rounded opacity-5">description</i>
          <span class="nav-link-text ms-1 os">OS</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if ($page == 'clients') {
                              echo ' active bg-gradient-dark text-white';
                            } else {
                              echo 'text-dark';
                            } ?> " href="../pages/clients.php"
          title="Cadastro de clientes">
          <i class="material-symbols-rounded opacity-5">group</i>
          <span class="nav-link-text ms-1 clients">Cadastro de clientes</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if ($page == 'services') {
                              echo ' active bg-gradient-dark text-white';
                            } else {
                              echo 'text-dark';
                            } ?>" href="../pages/services.php"
          title="Cadastro de serviços">
          <i class="material-symbols-rounded opacity-5">receipt_long</i>
          <span class="nav-link-text ms-1 services">Cadastro de serviços</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if ($page == 'payments') {
                              echo ' active bg-gradient-dark text-white';
                            } else {
                              echo 'text-dark';
                            } ?>" href="../pages/payments.php"
          title="Formas de pagamento">
          <i class="material-symbols-rounded opacity-5">payments</i>
          <span class="nav-link-text ms-1 payments">Formas de pagamento</span>
        </a>
      </li>
    </ul>
  </div>
  <div class="text-center buttons">
    <a type="button"
      href="../pages/births.php"
      class="btn bg-gradient-dark"
      data-bs-toggle="tooltip"
      data-bs-placement="bottom"
      title="Aniversariantes do dia"
      onclick="setCollapsed()">
      <i class="material-symbols-rounded">notifications</i>
      <span id="birthNotification" class=""></span>
    </a>
    <button type="button"
      class="btn bg-gradient-dark"
      data-bs-toggle="tooltip"
      data-bs-placement="bottom"
      title="Minimizar Menu"
      onclick="setCollapsed()">
      <i class="material-symbols-rounded">menu</i>
    </button>
  </div>
</aside>
<script>
  $(document).ready(function() {
    checkNewBirths();
  });

  const setCollapsed = () => {
    const aside = $('aside');
    const name = $('.name');
    const os = $('.os');
    const clients = $('.clients');
    const services = $('.services');
    const payments = $('.payments');
    const routines = $('.routines');

    if (aside.hasClass('collapsed')) {
      aside.removeClass('collapsed fixed-start-collapsed');
      aside.addClass('expanded fixed-start');
      name.html('Costureiros');
      os.html('OS');
      clients.html('Cadastro de clientes');
      services.html('Cadastro de serviços');
      payments.html('Formas de pagamento');
      routines.html('Rotinas');
    } else {
      aside.removeClass('expanded fixed-start');
      aside.addClass('collapsed fixed-start-collapsed');
      name.html('');
      os.html('');
      clients.html('');
      services.html('');
      payments.html('');
      routines.html('');
    }
  }
</script>