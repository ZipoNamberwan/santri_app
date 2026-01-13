<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="<?php echo base_url(); ?>assets/radmin/img/logo/logo.png" rel="icon">
  <title>Antrian BPS Prov Jatim</title>
  <link href="<?php echo base_url(); ?>assets/radmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/radmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/radmin/css/ruang-admin.min.css" rel="stylesheet">

  <!-- dataTables -->
  <link href="<?php echo base_url(); ?>assets/radmin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- Select2 -->
  <link href="<?php echo base_url(); ?>assets/radmin/vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">

  <!-- SweetAlert2 -->
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/radmin/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css"> -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/radmin/sweetalertx/sweetalert2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/radmin/sweetalertx/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <!--<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url(); ?>">
        <div class="sidebar-brand-icon">
          <img class="rounded" src="<?php echo base_url(); ?>assets/radmin/img/logo/logo.png">
        </div>
        <div class="sidebar-brand-text mx-3">ADMIN</div>
      </a>
      <hr class="sidebar-divider my-0">

      <?php if ($session['role']==1) { ?>
      <li class="nav-item <?php if($hal=='qr'){ echo 'active'; } ?>">
        <a class="nav-link" href="<?php echo base_url(); ?>qr">
          <i class="fas fa-fw fa-qrcode"></i>
          <span>QR</span></a>
      </li>
      <?php } ?>
      
      <li class="nav-item <?php if($hal=='antrian'){ echo 'active'; } ?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin">
          <i class="fas fa-fw fa-layer-group"></i>
          <span>List Antrian</span></a>
      </li>

      <li class="nav-item <?php if($hal=='users'){ echo 'active'; } ?>">
        <a class="nav-link" href="<?php echo base_url(); ?>users">
          <i class="fas fa-fw fa-user-friends"></i>
          <span>List User</span></a>
      </li>
      
      <?php if ($session['role']==1) { ?>
      <hr>
      <li class="nav-item <?php if($hal=='antrian'){ echo 'active'; } ?>">
        <a class="nav-link" href="<?php echo base_url(); ?>admin">
          <i class="fas fa-fw fa-layer-group"></i>
          <span>List Antrian Public</span></a>
      </li>
      <?php } ?>

      <?php if ($session['role']==1) { ?>
      <hr>
      <li class="nav-item <?php if($hal=='master'){ echo 'active'; } ?>">
        <a class="nav-link" href="<?php echo base_url(); ?>master">
          <i class="fas fa-fw fa-server"></i>
          <span>Master Data</span></a>
      </li>
      <?php } ?>

-->      
      <div class="version" id="version-ruangadmin" style="display: none;"></div>
<!--
    </ul>-->
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-2 static-top">
            
            <h1 class="h2 text-white nav navbar-nav flex-fill justify-content-center">Selamat Datang di BPS Provinsi Jawa Timur</h1>
            
          <!--<button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>-->
          <!--<ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="ml-2 d-none d-lg-inline text-white small">Hi!, 
                  <?php if ($session['nama']!="") { echo $session['nama']; } else { echo $session['username']; } ?>
                </span>
                <i class="fas fa-angle-down right mr-1 ml-1"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo base_url(); ?>users/ganti_password">
                  <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                  Ganti Password
                </a>

                <a class="dropdown-item" href="<?php echo base_url(); ?>login/logout">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>-->
        </nav>
        <!-- Topbar -->