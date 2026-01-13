<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ganti Password</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
      <li class="breadcrumb-item">Ganti Password</li>
    </ol>
  </div>

  <div class="row">
    <div class="col-lg-4 mb-3">
      <div class="card">
      	<div class="card-body">
      	  <form method="POST" action="<?php echo base_url(); ?>users/ganti_pw" enctype="multipart/form-data">
      		<div class="form-group row">
      		  <div class="col-sm-12">
      		  	<input type="hidden" id="username" name="username" value="<?php echo $session['username'] ?>">
      			<label>Password Baru</label>
      			<input class="form-control form-control-sm" type="password" id="password" name="password" required="" placeholder="******" minlength="6">
      			<div class="invalid-feedback" id="div_pw">Password terdiri dari minimal 6 Karakter!</div>
      		  </div>
      		</div>
      		
      		<div class="form-group row">
      		  <div class="col-sm-12">
      			<label>Konfirmasi Password Baru</label>
      			<input class="form-control form-control-sm" type="password" id="konf_pass" name="konf_pass" required="" placeholder="******" minlength="6">
      			<div class="invalid-feedback" id="div_kpw">Password dan Konfirmasi Password harus sesuai!</div>
      		  </div>
      		</div>

      		<div class="form-group row">
      		  <div class="col-sm-12">
            	<button type="submit" class="btn btn-sm btn-warning float-right" id="btn_gp" disabled="">Ganti Password</button>
      		  </div>
      		</div>
      	  </form>

        </div>
      </div>
    </div>
  </div>

</div>
<!---Container Fluid-->

<script src="<?php echo base_url(); ?>assets/radmin/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/radmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/radmin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/radmin/vendor/select2/dist/js/select2.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
  	$('#password').keyup(function(){
        verif_pw();
    });

    $('#konf_pass').keyup(function(){
        verif_pw();
    });

    function verif_pw(){
  		var pass = $("#password").val();
  		var kp = $("#konf_pass").val();
        var lp = pass.length;

        //verif password
        if (lp>5) {
          document.getElementById("password").classList.remove('is-invalid');
          document.getElementById("password").classList.add('is-valid');
          document.getElementById("div_pw").style.display = "none";
        } else {
          document.getElementById("password").classList.remove('is-valid');
          document.getElementById("password").classList.add('is-invalid');
          document.getElementById("div_pw").style.display = "block";
        }

        //verif konf password
        if (kp == pass) {
          document.getElementById("konf_pass").classList.remove('is-invalid');
          document.getElementById("konf_pass").classList.add('is-valid');
          document.getElementById("div_kpw").style.display = "none";
        } else {
          document.getElementById("konf_pass").classList.remove('is-valid');
          document.getElementById("konf_pass").classList.add('is-invalid');
          document.getElementById("div_kpw").style.display = "block";
        }

        //verif btn
        if(lp>5 && kp == pass){
          document.getElementById("btn_gp").disabled = false;
      	} else {
          document.getElementById("btn_gp").disabled = true;
      	}
  	}

  });

</script>