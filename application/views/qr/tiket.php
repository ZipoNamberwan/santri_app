<?php 
$tujuan = $det['tujuan'];
$this->db->where(array('id' => $tujuan));
$nmtujuan = $this->db->get('tujuan')->row_array();
if (is_null($nmtujuan)) { $nmtujuan = 'Tidak Diketahui'; } else { $nmtujuan = $nmtujuan['nama']; }

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="<?php echo base_url(); ?>assets/radmin/img/logo/logo.png" rel="icon">
  <title>Tiket Antrian - BPS Prov Jatim</title>
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
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  	<div class="form-group row">
                    	<div class="col-sm-12 text-center">
                    		<h6>No Antrian</h6>
                    		<h1 class="text-gray-900 mb-0" style="font-size:300%;"><?php echo $det['kode'] ?></h1>
                    	</div>
                    </div>
                    <div class="form-group row">
                    	<input type="hidden" id="id" name="id" value="<?php echo $det['id'] ?>">
                    	<input type="hidden" id="qr_code" name="qr_code" value="<?php echo $det['qr_code'] ?>">
                    	<div class="col-sm-3">Tanggal</div>
                    	<div class="col-sm-9">
                    		: <?php echo date('l, d F Y', strtotime($det['tanggal'])) ?>
                    	</div>
                    </div>
                    <div class="form-group row">
                    	<div class="col-sm-3">Jam</div>
                    	<div class="col-sm-9">
                    		: <?php echo date('H:i', strtotime($det['jam'])).' WIB' ?>
                    	</div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-3">Nama</div>
                      <div class="col-sm-9">
                        : <?php echo $det['nama'] ?>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-3">Instansi</div>
                      <div class="col-sm-9">
                        : <?php echo $det['instansi'] ?>
                      </div>
                    </div>
                    <div class="form-group row">
                    	<div class="col-sm-3">Tujuan</div>
                    	<div class="col-sm-9">
                    		: <?php echo $nmtujuan.' '.$det['layanan'] ?>
                    	</div>
                    </div>
                    
                    <div class="form-group row">
                    	<div class="col-sm-3">Keperluan</div>
                    	<div class="col-sm-9">
                    		: <?php echo $det['keperluan'] ?>
                    	</div>
                    </div>

                    <?php if ($from=='reservation') { ?>
                    <hr>
                    <div class="form-group row">
                      <div class="col-sm-12 text-center">
                        Scan kode QR berikut ketika sampai di BPS Provinsi Jawa Timur <br>
                        <img src="https://quickchart.io/qr?size=400x400&text=<?php echo base_url(); ?>qr/new/<?php echo $det['qr_code'] ?>">';
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12">
                        <a href="<?php echo base_url().$pdf ?>" class="btn btn-primary mb-1 btn-block">Download PDF</a>
                      </div>                                  
                    </div>
                    <?php } ?>
                  
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