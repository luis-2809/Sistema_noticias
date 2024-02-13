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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="<?php echo CSS . 'style.css' ?>">
</head>
<!--   #0b2239 #1c1f25 #65EBB5-->
<body class="<?php echo isset($d->bg) && $d->bg == 'blue' ? 'bg-gradient' : 'bg-base' ?>  ">