<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="TemplateMo">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

  <title><?= $profile->title_web ?></title>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/image/' . $profile->logo) ?>">
  <!-- Bootstrap core CSS -->
  <link href="<?= base_url() ?>assets/user/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/user/assets/css/fontawesome.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/user/assets/css/templatemo-finance-business.css">
  <link rel="stylesheet" href="<?= base_url() ?>assets/user/assets/css/owl.css">
  <script src='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.css' rel='stylesheet' />
  <!--

Finance Business TemplateMo

https://templatemo.com/tm-545-finance-business

-->
</head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="preloader">
    <div class="jumper">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- Header -->
  <div class="sub-header">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-xs-12">
          <ul class="left-info">
            <li><a href="#"><i class="fa fa-envelope"></i>Email: <?= $profile->email ?></a></a></li>
            <li><a href="#"><i class="fa fa-phone"></i><?= $profile->telp ?></a></li>
            <li><a href="<?= site_url('user') ?>"><i class="fa fa-home"></i>Beranda</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <ul class="right-icons">
            <!-- <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a href="#"><i class="fa fa-behance"></i></a></li> -->
          </ul>
        </div>
      </div>
    </div>
  </div>