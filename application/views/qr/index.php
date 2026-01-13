<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="<?php echo base_url(); ?>assets/radmin/img/logo/logo.png" rel="icon">
  <title>Scan QR - BPS Prov Jatim</title>
  <link href="<?php echo base_url(); ?>assets/radmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/radmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/radmin/css/ruang-admin.min.css" rel="stylesheet">


  <link href="<?php echo base_url(); ?>assets/webcodecamjs/css/style.css" rel="stylesheet">

  <!-- Sweet Alert -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/radmin/sweetalertx/sweetalert2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/radmin/sweetalertx/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

</head>

<body class="bg-gradient-login">
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5" id="QR-Code">
          <div class="card-body p-0" style="min-height:600px;">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Scan QR Code Reservasi Antrian Tamu</h1>
                    <br>
                  </div>
                  <div class="text-center">
                    <div class="form-group row">
                      <div class="col-md-7">
                        <select class="form-control form-control-sm" id="camera-select"></select>
                      </div>

                      <div class="col-md-5">
                        <input id="image-url" type="hidden" class="form-control" placeholder="Image url">
                        <button title="Play" class="btn btn-success btn-sm" id="play" type="button" data-toggle="tooltip"><i class="fas fa-play"></i></button>
                        <button title="Pause" class="btn btn-warning btn-sm" id="pause" type="button" data-toggle="tooltip"><i class="fas fa-pause"></i></button>
                        <button title="Stop streams" class="btn btn-danger btn-sm" id="stop" type="button" data-toggle="tooltip"><i class="fas fa-stop"></i></button>
                        <button title="Decode Image" class="btn btn-light btn-sm" id="decode-img" type="button" data-toggle="tooltip"><i class="fas fa-upload"></i></button>
                        <button title="Image shoot" class="btn btn-info btn-sm disabled" id="grab-img" type="button" data-toggle="tooltip"><i class="fas fa-image"></i></button>
                      </div>

                      <div class="col-md-12 mt-3">
                        <div class="form-group row" style="position: relative;display: inline-block;">
                            <canvas width="320" height="240" id="webcodecam-canvas" style="min-width:350px;"></canvas>
                            <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                            <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                            <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                            <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                        </div>
                      </div>

                      <div class="col-md-12" style="font-size:90%;">
                        Keterangan : QR Code dikirimkan melalui email saat reservasi <br><br>
                        Anda dapat melakukan reservasi dari rumah melalui : <span class="text-primary"><b><?php echo base_url() ?></b></span>
                      </div>

                      <div class="col-md-12 row" style="display:none;">
                        <div class="col-md-12">
                          <label id="zoom-value" style="display:none;">Zoom: 1</label>
                          <input id="zoom" onchange="Page.changeZoom();" type="range" min="10" max="30" value="10" class="form-control">
                        </div>

                        <div class="col-md-12 thumbnail" id="result" style="display:none;">
                            <div class="well" style="overflow: hidden;">
                                <img width="320" height="240" id="scanned-img" src="">
                            </div>
                            <div class="caption">
                              <h5>Scanned result</h5>
                              <p id="scanned-QR"></p>
                            </div>
                        </div>
                      </div>


                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0" style="min-height:600px;">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Scan QR Berikut jika belum Reservasi</h1>
                  </div>
                  <div class="text-center">
                    <img src="https://quickchart.io/qr?size=400x400&text=<?php echo base_url(); ?>qr/new/<?php echo $hash_tgl ?>">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- webcodecamjs -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/webcodecamjs/js/filereader.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/webcodecamjs/js/qrcodelib.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/webcodecamjs/js/webcodecamjs.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/webcodecamjs/js/main.js"></script>

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