<nav class="navbar navbar-main navbar-expand-lg mx-5 px-0 shadow-none rounded" id="navbarBlur" navbar-scroll="true">
  <div class="container-fluid py-1 px-2">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-1 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pagina Inicial</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Segunda Pagina</li>
      </ol>
      <h6 class="font-weight-bold mb-0">Nombre de la pagina actual</h6>
    </nav>
    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
      <div class="ms-md-auto pe-md-3 d-flex align-items-center">
      </div>
      <ul class="navbar-nav  justify-content-end">
        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
              <i class="sidenav-toggler-line"></i>
            </div>
          </a>
        </li>
        <li class="nav-item px-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-body p-0">
            <i class="fa-solid fa-comments fs-4"></i>
          </a>
        </li>
        <li class="nav-item ps-2 d-flex align-items-center">
          <div class=" dropdown">
            <a href="javascript:;" class="nav-link text-body p-0" data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
              <img src="https://api.lorem.space/image/face?w=150&h=150" class="avatar avatar-sm" alt="avatar" />
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start dropdown-menu-dark bg-slate-900" aria-labelledby="navbarDropdownMenuLink2">
              <li><a class="dropdown-item" href="<?= url('/profile') ?>">Mi perfil</a></li>
              <li><a class="dropdown-item" href="<?= url('/profile/password/new') ?>">Cambiar contraseña</a></li>
              <li><a class="dropdown-item" href="#">Cerrar Sesion</a></li>
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>