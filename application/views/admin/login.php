<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="<?php echo base_url(); ?>assets/radmin/img/logo/logo.png" rel="icon">
  <title>Login - BPS Prov Jatim</title>
  <link href="<?php echo base_url(); ?>assets/radmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/radmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/radmin/css/ruang-admin.min.css" rel="stylesheet">

  <!-- Sweet Alert -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/radmin/sweetalertx/sweetalert2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/radmin/sweetalertx/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-4 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <form class="user" method="POST" action="<?php echo base_url(); ?>login/proses_login" enctype="multipart/form-data">
                    <div class="form-group">
                      <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required="">
                    </div>
                    <div class="form-group">
                    	<button type="submit" class="btn btn-primary mb-1 btn-block">Login</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="<?php echo base_url(); ?>assets/radmin/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/radmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/radmin/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/radmin/js/ruang-admin.min.js"></script>

  <!-- Sweet Alert -->
  <script src="<?php echo base_url(); ?>assets/radmin/sweetalertx/sweetalert2.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        <?php echo $this->session->flashdata('notif'); ?>
    });
  </script>
</body>

</html>