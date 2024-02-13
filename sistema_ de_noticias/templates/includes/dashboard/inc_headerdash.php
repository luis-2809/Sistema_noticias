<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="icon" href="<?php echo FAVICON . 'NUEVO LOGO GPM.ico' ?>" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

  <title>
    <?php echo isset($d->title) ? $d->title . '-' . get_sitename() : 'Bienvenido a ' . get_sitename(); ?>
  </title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <link rel="stylesheet" href="<?php echo CSS . 'dashboard.css?v7' ?>">
</head>
<!--   #0b2239 #1c1f25 #65EBB5-->

<body data-page="dashboard">
  <div class="d-flex ">
    <div class="_sidebar-container _bg p-2">
      <div class="rounded-3 _contenddark   h-100 ">
        <div class="_borderbutton">
          <div class=" logo  d-flex justify-content-center">
            <img src="<?php echo IMG . 'logo_gpm_tucanal_periodico.png' ?>" class="img-fluid"
              alt="Logo de GPM tu canal">
          </div>
        </div>
        <div class="menu ">
          <div class="sidebar">
            <ul class="navbar-nav _desplegable me-auto mb-2 mb-lg-0 ">
              <li class="nav-item"><a class="nav-link mt-2 p-3 " href="<?php echo URL . 'statistics' ?>"><i
                    class="mx-2 lead bi bi-graph-up-arrow"></i>Estadisticas</a></li>

              <li class="nav-item"><a data-bs-target="#menu2Submenu" aria-controls="menu2Submenu"
                  data-bs-toggle="collapse" aria-expanded="false" class=" p-3 nav-link _iconodesple"><i
                    class="mx-2 lead bi bi-file-earmark-richtext"></i>Noticia <i
                    class="ms-auto bi bi-caret-down-fill"></i></a>
                <div class="_borderli position-relative">
                  <ul class="collapse navbar-nav" id="menu2Submenu">
                    <li class="nav-item position-relative"><a class="  nav-link mx-3"
                        href="<?php echo URL . 'news/new' ?>">Agregar Noticia</a></li>
                    <li class="nav-item position-relative"><a class="nav-link mx-3"
                        href="<?php echo URL . 'news' ?>">Ver
                        Noticias</a></li>
                  </ul>
                </div>
              </li>

              <li class="nav-item"><a data-bs-target="#menu5Submenu" aria-controls="menu5Submenu"
                  data-bs-toggle="collapse" aria-expanded="false" class=" p-3 nav-link _iconodesple"><i
                    class="mx-2 lead bi bi-camera-video"></i>Videos <i class="ms-auto bi bi-caret-down-fill"></i></a>
                <div class="_borderli position-relative">
                  <ul class="collapse navbar-nav" id="menu5Submenu">
                    <li class="nav-item position-relative"><a class="  nav-link mx-3"
                        href="<?php echo URL . 'video/new' ?>">Agregar Video</a></li>
                    <li class="nav-item position-relative"><a class="nav-link mx-3"
                        href="<?php echo URL . 'video' ?>">Ver
                        Videos</a></li>
                  </ul>
                </div>
              </li>

              <li class="nav-item"><a data-bs-target="#menu3Submenu" aria-controls="menu3Submenu"
                  data-bs-toggle="collapse" aria-expanded="false" class=" p-3 nav-link _iconodesple"><i
                    class="mx-2 lead bi bi-file-earmark-richtext"></i>Publicidad <i
                    class="ms-auto bi bi-caret-down-fill"></i></a>
                <div class="_borderli position-relative">
                  <ul class="collapse navbar-nav" id="menu3Submenu">
                    <li class="nav-item position-relative"><a class="nav-link  mx-3"
                        href="<?php echo URL . 'publicidad/new' ?>">Agregar Publicidad</a>
                    </li>
                    <li class="nav-item position-relative"><a class="nav-link  mx-3"
                        href="<?php echo URL . 'publicidad' ?>">Ver Publicidad</a></li>
                  </ul>
                </div>
              </li>
              <?php

              $userData = Auth::getUserData();

              // Verificar si hay datos del usuario
              if ($userData !== null) {
                // Acceder a los datos del usuario
                $rol = $userData['rol'];

                if ($rol === "administrador") {

                  ?>
                  <li class="nav-item"><a data-bs-target="#menu4Submenu" aria-controls="menu4Submenu"
                      data-bs-toggle="collapse" aria-expanded="false" class=" p-3 nav-link _iconodesple"><i
                        class="mx-2 lead bi bi-people-fill"></i>Usuarios <i class="ms-auto bi bi-caret-down-fill"></i></a>
                    <div class="_borderli position-relative">
                      <ul class="collapse navbar-nav" id="menu4Submenu">
                        <li class="nav-item position-relative"><a class="nav-link  mx-3"
                            href="<?php echo URL . 'user/new' ?>">Agregar Usuarios</a></li>
                        <li class="nav-item position-relative"><a class="nav-link  mx-3"
                            href="<?php echo URL . 'user' ?>">Ver
                            Usuarios</a></li>
                      </ul>
                    </div>
                  </li>

                  <?php
                }
              }
              ?>
              <li class="nav-item"><a class="nav-link p-3" href="<?php echo URL . 'user/myuser' ?>"><i
                    class="mx-2 lead bi bi-gear-fill"></i>configuracion</a>
              </li>
            </ul>
          </div>

        </div>
      </div>
    </div>
    <div class="w-100 _bg _p-resp pe-2 py-2" style="display: flex; flex-direction: column;height: 100vh">
      <nav class="navbar navbar-expand-lg position-relative">
        <div class="container-fluid rounded-3 _contenddark ">
          <button class="navbar-toggler _botoncoll me-4 " type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation"><i class="bi bi-list"></i>
          </button>
          <div class="padre">
            <div class="collapse navbar-collapse custom-collapse order-3 _collapse " id="navbarSupportedContent">

              <ul class="navbar-nav _desplegable me-auto mb-2 mb-lg-0 d-none">
                <li class="nav-item"><a class="nav-link mt-2 p-3 " href="<?php echo URL . 'statistics' ?>"><i
                      class="mx-2 lead bi bi-graph-up-arrow"></i>Estadisticas</a></li>

                <li class="nav-item"><a data-bs-target="#menu2Submenu" aria-controls="menu2Submenu"
                    data-bs-toggle="collapse" aria-expanded="false" class=" p-3 nav-link _iconodesple"><i
                      class="mx-2 lead bi bi-file-earmark-richtext"></i>Noticia <i
                      class="ms-auto bi bi-caret-down-fill"></i></a>
                  <div class="_borderli position-relative">
                    <ul class="collapse navbar-nav" id="menu2Submenu">
                      <li class="nav-item position-relative"><a class="  nav-link mx-3"
                          href="<?php echo URL . 'news/new' ?>">Agregar Noticia</a></li>
                      <li class="nav-item position-relative"><a class="nav-link mx-3"
                          href="<?php echo URL . 'news' ?>">Ver
                          Noticias</a></li>
                    </ul>
                  </div>
                </li>

                <li class="nav-item"><a data-bs-target="#menu5Submenu" aria-controls="menu5Submenu"
                    data-bs-toggle="collapse" aria-expanded="false" class=" p-3 nav-link _iconodesple"><i
                      class="mx-2 lead bi bi-camera-video"></i>Videos <i class="ms-auto bi bi-caret-down-fill"></i></a>
                  <div class="_borderli position-relative">
                    <ul class="collapse navbar-nav" id="menu5Submenu">
                      <li class="nav-item position-relative"><a class="  nav-link mx-3"
                          href="<?php echo URL . 'video/new' ?>">Agregar Video</a></li>
                      <li class="nav-item position-relative"><a class="nav-link mx-3"
                          href="<?php echo URL . 'video' ?>">Ver Videos</a></li>
                    </ul>
                  </div>
                </li>

                <li class="nav-item"><a data-bs-target="#menu3Submenu" aria-controls="menu3Submenu"
                    data-bs-toggle="collapse" aria-expanded="false" class=" p-3 nav-link _iconodesple"><i
                      class="mx-2 lead bi bi-file-earmark-richtext"></i>Publicidad <i
                      class="ms-auto bi bi-caret-down-fill"></i></a>
                  <div class="_borderli position-relative">
                    <ul class="collapse navbar-nav" id="menu3Submenu">
                      <li class="nav-item position-relative"><a class="nav-link  mx-3"
                          href="<?php echo URL . 'publicidad/new' ?>">Agregar Publicidad</a>
                      </li>
                      <li class="nav-item position-relative"><a class="nav-link  mx-3"
                          href="<?php echo URL . 'publicidad' ?>">Ver Publicidad</a></li>
                    </ul>
                  </div>
                </li>

                <?php

                $userData = Auth::getUserData();

                // Verificar si hay datos del usuario
                if ($userData !== null) {
                  // Acceder a los datos del usuario
                  $rol = $userData['rol'];

                  if ($rol === "administrador") {

                    ?>


                    <li class="nav-item"><a data-bs-target="#menu4Submenu" aria-controls="menu4Submenu"
                        data-bs-toggle="collapse" aria-expanded="false" class=" p-3 nav-link _iconodesple"><i
                          class="mx-2 lead bi bi-people-fill"></i>Usuarios <i class="ms-auto bi bi-caret-down-fill"></i></a>
                      <div class="_borderli position-relative">
                        <ul class="collapse navbar-nav" id="menu4Submenu">
                          <li class="nav-item position-relative"><a class="nav-link  mx-3"
                              href="<?php echo URL . 'user/new' ?>">Agregar Usuarios</a></li>
                          <li class="nav-item position-relative"><a class="nav-link  mx-3"
                              href="<?php echo URL . 'user' ?>">Ver Usuarios</a></li>
                        </ul>
                      </div>
                    </li>

                    <?php
                  }
                }

                ?>

                <li class="nav-item"><a class="nav-link p-3" href="<?php echo URL . 'user/myuser' ?>"><i
                      class="mx-2 lead bi bi-gear-fill"></i>configuracion</a>
                </li>
              </ul>
            </div>
          </div>
          <form class="d-flex position-relative  my-2 order-1 me-auto ocultar" role="search" style="display: none;">
            <input class="form-control me-2 _inputsearch" type="search" placeholder="Buscar..." aria-label="Search"
              style="display: none;">
            <button class="btn position-absolute _btnsearch" type="submit" style="display: none;"><i
                class="p-1 bi bi-search"></i></button>
          </form>
          <ul class=" navbar-nav me-auto  order-2 me-2 _search2">
            <li><a href="" class="rounded-circle  _icosearch2"> <i class="bi bi-search   "
                  style="display: none;"></i></a></li>
          </ul>
          <ul class="navbar-nav  order-4 _linkavatardes">

            <li class="nav-item dropdown" id="adaptivedes">
              <a class="nav-link dropdown-toggle _linkavatar2" id="adaptivea" href="#" role="button"
                data-bs-toggle="dropdown" style="font-size: 25pt;">
                <i class="bi bi-person-circle ms-3  img-fluid  _avatar "></i>
              </a>
              <a class="nav-link dropdown-toggle _linkavatar" id="adaptivea" href="#" role="button"
                data-bs-toggle="dropdown">
                <i class="bi bi-person-circle ms-3  img-fluid  _avatar" style="font-size: 20pt;"></i>
                <span class="py-5">
                  <?php
                  $var = Users::fromSession();
                  $data = $var->getData("nombre");
                  echo $data;
                  ?>
                </span>
              </a>
              <ul class="dropdown-menu position-absolute dropdown-menu-end _desplegabledrop _bg2" id="">
                <li><a class="dropdown-item" href="<?php echo URL . 'user/myuser' ?>">Mi perfil</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item _linklogout" href="#" id="logout">Cerrar sesión</a></li>
              </ul>
            </li>

          </ul>
        </div>
      </nav>
      <div class="  overflow-auto" style="flex-grow: 1;">