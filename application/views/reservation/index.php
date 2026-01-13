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
  <title>Reservasi Antrian - BPS Prov Jatim</title>
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
                    <h1 class="h4 text-gray-900 mb-4">Reservasi Antrian Tamu</h1>
                  </div>
                  <form class="user" method="POST" action="<?php echo base_url(); ?>reservation/order" enctype="multipart/form-data">
                    <div class="form-group row">
                    	<div class="col-sm-3">Tanggal</div>
                    	<div class="col-sm-4">
                    		<input type="date" class="form-control form-control-sm" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d') ?>" required="">
                    	</div>
                      <div class="col-sm-2">Jam</div>
                      <div class="col-sm-3">
                        <select class="form-control form-control-sm" id="jam" name="jam" required="">
                          <option value="">Pilih Jam</option>
                          <?php for ($i=0; $i < count($list_jam); $i++) { 
                            if ($list_jam[$i] == date('H:00', strtotime($det['jam']))) { $dfl_j = 'selected'; } else { $dfl_j = ''; }
                            echo '<option value="'.$list_jam[$i].'" '.$dfl_j.'>'.$list_jam[$i].'</option>';
                          } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-3">Nama</div>
                      <div class="col-sm-9">
                        <input class="form-control form-control-sm" type="text" id="nama" name="nama" required="" placeholder="Nama Lengkap">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-3">Jenis Kelamin</div>
                      <div class="col-sm-3">
                        <select class="form-control form-control-sm" id="jk" name="jk" required="">
                          <option value="">Pilih</option>
                          <option value="1">Laki-laki</option>
                          <option value="2">Perempuan</option>
                        </select>
                      </div>
                      <div class="col-sm-2">No HP</div>
                      <div class="col-sm-4">
                        <input class="form-control form-control-sm" type="number" id="hp" name="hp" required="" placeholder="Contoh : 081234xxx">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-sm-3">Instansi</div>
                      <div class="col-sm-9">
                        <select class="form-control form-control-sm select2-instansi" id="instansi" name="instansi" required="">
                          <option value="">Pilih Instansi</option>
                          <option value="BPS">BPS (Badan Pusat Statistik)</option>
                          <?php for ($i=0; $i < count($list_instansi); $i++) { 
                            echo '<option value="'.$list_instansi[$i]['nama'].'">'.$list_instansi[$i]['nama'].'</option>';
                          } ?>
                          <option value="-">Lainnya</option>
                        </select>
                        
                        <div class="mt-2" id="div_bps" style="display:none;">
                          <select class="form-control form-control-sm select2-bps" id="inst_bps" name="inst_bps">
                            <option value="">Pilih Kantor BPS</option>
                            <?php for ($i=0; $i < count($list_bps); $i++) { 
                              echo '<option value="'.$list_bps[$i]['nama'].'">'.$list_bps[$i]['nama'].'</option>';
                            } ?>
                          </select>
                        </div>

                        <div class="mt-2" id="div_inst" style="display:none;">
                          <input class="form-control form-control-sm" type="text" id="inst_lain" name="inst_lain" placeholder="Sebutkan nama instansi ...">
                        </div>
                        
                      </div>
                    </div>

                    <div class="form-group row">
                    	<div class="col-sm-3">Tujuan Ke</div>
                    	<div class="col-sm-9">
                    		<select class="form-control form-control-sm select2-tujuan" id="tujuan" name="tujuan" required="">
  			                  <option value="">Pilih Tujuan</option>
  			                  <?php for ($i=0; $i < count($list_tujuan); $i++) { 
  			                  	echo '<option value="'.$list_tujuan[$i]['id'].'">'.$list_tujuan[$i]['nama'].'</option>';
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
                    		<input class="form-control form-control-sm" type="email" id="email" name="email" required="">
                    	</div>
                    </div>
                    
                    
                    <div class="form-group row">
                    	<div class="col-sm-3">Keperluan</div>
                    	<div class="col-sm-9">
                    		<textarea class="form-control" id="keperluan" name="keperluan" rows="3" required="" placeholder="Contoh : Diskusi Rekomendasi Kegiatan Statistik"></textarea>
                    	</div>
                    </div>
                    <div class="form-group row">
                    	<div class="col-sm-3"></div>
                    	<div class="col-sm-9">
                    		<button type="submit" class="btn btn-primary mb-1 btn-block">Reservasi</button>
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
      $('.select2-instansi').select2({
          placeholder: "Pilih Instansi",
          allowClear: false
      });

      $('.select2-bps').select2({
          placeholder: "Pilih Kantor BPS",
          allowClear: false
      });

      $('.select2-tujuan').select2({
          placeholder: "Pilih Tujuan",
          allowClear: false
      });

      $('#instansi').change(function(){
        var ins = $("#instansi option:selected").attr("value");
        if (ins == 'BPS') {
          document.getElementById("div_bps").style.display = 'block';
          document.getElementById("div_inst").style.display = 'none';
          document.getElementById("inst_bps").required = true;
          document.getElementById("inst_lain").required = false;
        } else if (ins == '-') {
          document.getElementById("div_bps").style.display = 'none';
          document.getElementById("div_inst").style.display = 'block';
          document.getElementById("inst_bps").required = false;
          document.getElementById("inst_lain").required = true;
        } else {
          document.getElementById("div_bps").style.display = 'none';
          document.getElementById("div_inst").style.display = 'none';
          document.getElementById("inst_bps").required = false;
          document.getElementById("inst_lain").required = false;
        }
      });

      $('#tujuan').change(function(){
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
      });
    
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