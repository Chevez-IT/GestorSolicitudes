<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand d-flex align-items-center m-0" href=" https://demos.creative-tim.com/corporate-ui-dashboard/pages/dashboard.html " target="_blank">
      <span class="font-weight-bold text-lg">FGK - MKT & COM</span>
    </a>
  </div>
  <div class="collapse navbar-collapse px-4  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="#">
          <i class="fa-solid fa-chart-pie fs-5 px-0 py-2 text-center d-flex align-items-center justify-content-center"></i>
          <span class="nav-link-text ms-1 text-uppercase ms-2">Inicio</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= url('/accounts') ?>">
          <i class="fa-solid fa-users fs-5 px-0 py-2 text-center d-flex align-items-center justify-content-center"></i>
          <span class="nav-link-text ms-1 text-uppercase ms-2">Cuentas</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= url('/users') ?>">
          <i class="fa-solid fa-people-group fs-5 px-0 py-2 text-center d-flex align-items-center justify-content-center"></i>
          <span class="nav-link-text ms-1 text-uppercase ms-2">Usuarios</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= url('/companies') ?>">
          <i class="fa-solid fa-building-user fs-5 px-0 py-2 text-center d-flex align-items-center justify-content-center"></i>
          <span class="nav-link-text ms-1 text-uppercase ms-2">Compañias</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= url('/messages') ?>">
          <i class="fa-solid fa-paper-plane fs-5 px-0 py-2 text-center d-flex align-items-center justify-content-center"></i>
          <span class="nav-link-text ms-1 text-uppercase ms-2">Mensajes</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= url('/requests') ?>">
          <i class="fa-solid fa-file-lines fs-5 px-0 py-2 text-center d-flex align-items-center justify-content-center"></i>
          <span class="nav-link-text ms-1 text-uppercase ms-2">Solicitudes</span>
        </a>

      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= url('/roles') ?>">
          <i class="fa-solid fa-hand-sparkles fs-5 px-0 py-2 text-center d-flex align-items-center justify-content-center"></i>
          <span class="nav-link-text ms-1 text-uppercase ms-2">Roles</span>
        </a>
      </li>
    </ul>
  </div>
  <div class="sidenav-footer mx-4 ">
    <div class="card border-radius-md" id="sidenavCard">
      <div class="card-body  text-start  p-3 w-100">
        <div class="docs-info">
          <a href="<?= url('/close') ?>" target="_blank" class="font-weight-bold text-sm mb-0 icon-move-right mt-auto w-100 mb-0">
            Cerrar Secion
            <i class="fas fa-arrow-right-long text-sm ms-1" aria-hidden="true"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</aside>