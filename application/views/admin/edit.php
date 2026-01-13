<?php 
$this->db->order_by('id ASC');
$list_tujuan = $this->db->get('tujuan')->result_array();

$this->db->order_by('id ASC');
$list_instansi = $this->db->get('instansi')->result_array();

$this->db->order_by('kode ASC');
$list_bps = $this->db->get('instansi_bps')->result_array();

// $list_jam = ['08:00','08:30','09:00','09:30','10:00','10:30','11:00','11:30','13:00','13:30','14:00','14:30','15:00'];
$list_jam = ['08:00','09:00','10:00','11:00','13:00','14:00','15:00'];

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
  <title>Edit Reservasi - BPS Prov Jatim</title>
  <link href="<?php echo base_url(); ?>assets/radmin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/radmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/radmin/css/ruang-admin.min.css" rel="stylesheet">

  <!-- Select2 -->
  <link href="<?php echo base_url(); ?>assets/radmin/vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">

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
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Edit Reservasi <?php echo $det['kode'] ?></h1>
                  </div>
                  <form class="user" method="POST" action="<?php echo base_url(); ?>admin/update_edit" enctype="multipart/form-data">
                    <div class="form-group row">
                    	<div class="col-sm-3">Tanggal</div>
                    	<div class="col-sm-4">
                    		<input type="hidden" name="id" value="<?php echo $det['id'] ?>">
                    		<input type="hidden" name="qr_code" value="<?php echo $det['qr_code'] ?>">
                    		<?php echo date('d F Y', strtotime($det['tanggal'])); ?>
                    	</div>
                      <div class="col-sm-2">Jam</div>
                      <div class="col-sm-3">
                        <select class="form-control form-control-sm" id="jam" name="jam" required="">
                          <?php echo '<option value="'.date('H:i', strtotime($det['jam'])).'" >'.date('H:i', strtotime($det['jam'])).'</option>';
                          for ($i=0; $i < count($list_jam); $i++) { 
                            echo '<option value="'.$list_jam[$i].'" >'.$list_jam[$i].'</option>';
                          } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-3">Nama</div>
                      <div class="col-sm-9">
                        <input class="form-control form-control-sm" type="text" id="nama" name="nama" required="" placeholder="Nama Lengkap" value="<?php echo $det['nama'] ?>" disabled="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-3">Jenis Kelamin</div>
                      <div class="col-sm-3">
                        <select class="form-control form-control-sm" id="jk" name="jk" required="" disabled="">
                          <option value="1" <?php if ($det['jk'] == '1') { echo 'selected'; } ?> >Laki-laki</option>
                          <option value="2" <?php if ($det['jk'] == '2') { echo 'selected'; } ?> >Perempuan</option>
                        </select>
                      </div>
                      <div class="col-sm-2">No HP</div>
                      <div class="col-sm-4">
                        <input class="form-control form-control-sm" type="number" id="hp" name="hp" required="" placeholder="Contoh : 081234xxx" value="<?php echo $det['hp'] ?>" >
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-3">Instansi</div>
                      <div class="col-sm-9">
                        <input class="form-control form-control-sm" type="text" id="instansi" name="instansi" required="" placeholder="Instansi Asal" value="<?php echo $det['instansi'] ?>" disabled="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-3">Tujuan Ke</div>
                      <div class="col-sm-9">
                        <select class="form-control form-control-sm select2-tujuan" id="tujuan" name="tujuan" required="">
                          <option value="">Pilih Tujuan</option>
                          <?php for ($i=0; $i < count($list_tujuan); $i++) { 
                            if ($list_tujuan[$i]['id'] == $det['tujuan']) { $dfl_t = 'selected'; } else { $dfl_t = ''; }
                            echo '<option value="'.$list_tujuan[$i]['id'].'" '.$dfl_t.'>'.$list_tujuan[$i]['nama'].'</option>';
                          } ?>
                        </select>

                      </div>
                    </div>

                    <div class="form-group row" id="div_layanan" style="display:none;">
                      <div class="col-sm-3">Layanan</div>
                      <div class="col-sm-9">
                        <select class="form-control form-control-sm select2-layanan" id="layanan" name="layanan">
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-3">Email</div>
                      <div class="col-sm-9">
                        <input class="form-control form-control-sm" type="email" id="email" name="email" value="<?php echo $det['email'] ?>" required="">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-3">Keperluan</div>
                      <div class="col-sm-9">
                        <textarea class="form-control" id="keperluan" name="keperluan" rows="3" required=""><?php echo $det['keperluan'] ?></textarea>
                      </div>
                    </div>

                    <div class="form-group row">
                    	<div class="col-sm-3"></div>
                    	<div class="col-sm-9">
                    		<button type="submit" class="btn btn-primary mb-1 btn-block">Edit</button>
                    	</div>                                  
                    </div>
                </form>
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

  <!-- Select2 -->
  <script src="<?php echo base_url(); ?>assets/radmin/vendor/select2/dist/js/select2.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('.select2-tujuan').select2({
          placeholder: "Pilih Tujuan",
          allowClear: false
      });

      list_layanan();

      $('#tujuan').change(function(){
        list_layanan();
      });

      function list_layanan(){
        var tujuan = $("#tujuan").val();

        $.ajax({
          url:"<?php echo base_url(); ?>reservation/load_layanan",
          method:"POST",
          data:{tujuan:tujuan},
          success:function(data){
            var obj = jQuery.parseJSON(data);
            $("#layanan").html(obj.opt);
            if (obj.form == 1) { 
              document.getElementById("div_layanan").style.display = ''; 
              document.getElementById("layanan").required = true;
            } else { 
              document.getElementById("div_layanan").style.display = 'none'; 
              document.getElementById("layanan").required = false;
            }
          }
        })
      }
    });

  </script>

  <!-- Sweet Alert -->
  <script src="<?php echo base_url(); ?>assets/radmin/sweetalertx/sweetalert2.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        <?php echo $this->session->flashdata('notif'); ?>
    });
  </script>
</body>

</html>