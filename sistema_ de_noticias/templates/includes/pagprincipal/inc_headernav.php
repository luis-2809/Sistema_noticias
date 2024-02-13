<!DOCTYPE html
  PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="icon" href="<?php echo FAVICON . 'NUEVO LOGO GPM.ico' ?>" type="image/x-icon">
  <title>
    <?php echo isset($d->title) ? $d->title . '-' . get_sitename() : 'Bienvenido a ' . get_sitename(); ?>
  </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo CSS . 'style.css' ?>">
  <link rel="stylesheet" href="<?php echo CSS . 'styles.css' ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<!--   #0b2239 #1c1f25 #65EBB5-->
<body class="<?php echo isset($d->bg) && $d->bg == '_bg-base2' ? '_bg-base2' : 'bg-base' ?>">

  <nav class="navbar sticky-top navbar-expand-xl _arial " style="background-color: #0b2239;">
    <div class="container-fluid _navpadding">
      <a class="navbar-brand " href="#"><img src="<?php echo IMG . 'new_log_gpm.png' ?>" class="img-fluid"
          alt="Logo de GPM tu canal"></a>


      <div class="collapse navbar-collapse order-3 order-xl-2" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link  bold _navtextmargin" href="<?php echo URL."home" ?>""><b>Home</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link  bold _navtextmargin" href="<?php echo URL."tendencia" ?>"><b>Tendencia</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link  bold _navtextmargin" href="<?php echo URL."noticiasvideo" ?>"><b>Videos</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link  bold _navtextmargin" href="<?php echo URL."contenidoeditorial" ?>"><b>Contenido Editorial</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link  bold _navtextmargin" href="<?php echo URL."nosotros" ?>"><b>Nosotros</b></a>
          </li>
          <li class="nav-item">
            <a class="nav-link  bold _navtextmargin" href="<?php echo URL."contacto" ?>"><b>Contactanos</b></a>
          </li>
        </ul>
      </div>
      <div class="d-flex order-2 order-xl-3">
      <a class="bold _navicologin me-3 " type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="bi bi-search"></i></a>
        <a class="bold _navicologin" type="button" href="<?php echo URL."login" ?>"><i class="bi bi-person-circle"></i></a>
        <a class="navbar-toggler _nobordeboton" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
          aria-label="Toggle navigation">
          <i class="bi bi-list"></i>   
        </a>
      </div>
    </div>
  </nav>