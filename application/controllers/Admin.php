<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$sudah_login = $this->session->userdata('login_antrian');
    	if ($sudah_login!=TRUE) { redirect(base_url('login')); } 
		$this->m_model->last_active();
	}

	public function index(){
		$data_session = $this->session->userdata();
		$role = $data_session['role'];
		$tujuan = $data_session['tujuan'];

		$data = array(
			'session' => $data_session,
			'hal' => 'antrian',
			'tujuan' => $tujuan,
		);

		$this->load->view('layout/head',$data);
		if ($role == 1) {
			$this->load->view('admin/list_antrian', $data);
		} else {
			$this->load->view('admin/list_antrian_fungsi', $data);
		}
		$this->load->view('layout/foot');
	}

	function list_antrian(){
		$data_session = $this->session->userdata();
		$role = $data_session['role'];
		$tanggal = $this->input->post('tanggal');
		$input_t = $this->input->post('tujuan');
		$jml_rev = 0; $jml_on = 0;

		$output = '
		<table class="table align-items-center table-flush table-hover" id="dataTableHover">
	      <thead class="thead-light" style="text-align:center;">
	        <tr>
	          <th>No</th>
	          <th>Kode</th>
	          <th>Jam</th>
	          <th>Tujuan</th>
	          <th>Nama</th>
	          <th>Progres</th>
	          <th>Detail</th>
	          <th>Aksi</th>
	        </tr>
	      </thead>
	      <tbody style="text-align:center; font-size: 90%;">';

		if ($role>1) { $this->db->where('tujuan', $input_t); }
		$this->db->where('tanggal', $tanggal);
  		$this->db->order_by('jam ASC, id ASC');
  		$list_ant = $this->db->get('reservasi')->result_array();

		for ($i=0; $i < count($list_ant); $i++) { 
			if ($list_ant[$i]['jenis'] == '1') { $jml_rev++; } else { $jml_on++; }
			
			$tujuan = $list_ant[$i]['tujuan'];
			$this->db->where('id', $tujuan);
    		$nmtujuan = $this->db->get('tujuan')->row_array();
			if (is_null($nmtujuan)) { $nmtujuan = ''; } else { $nmtujuan = $nmtujuan['nama']; }

			$progres = $list_ant[$i]['progres'];
			$this->db->where('id', $progres);
    		$nmprogres = $this->db->get('progres')->row_array();
			if (is_null($nmprogres)) { $nmprogres = ''; } else { $nmprogres = $nmprogres['nama']; }

			$process = $list_ant[$i]['process_by'];
			$this->db->where('username', $process);
    		$nmprocess = $this->db->get('users')->row_array();
			if (is_null($nmprocess)) { $nmprocess = '-'; } else { $nmprocess = $nmprocess['nama']; }

			if ($role < 2) {
				$this->db->where('tujuan', $tujuan);
				$list_uname = $this->db->get('users')->result_array();
				$form_process_by = "<option value=''>Pilih Nama</option>";
				for ($u=0; $u < count($list_uname); $u++) { $form_process_by .= "<option value='".$list_uname[$u]['username']."'>".$list_uname[$u]['nama']."</option>"; }
			} else { $form_process_by = ''; }

			$nmtgl = date('d F Y', strtotime($list_ant[$i]['tanggal']));
			$nmjam = date('H:i', strtotime($list_ant[$i]['jam']));

			$aksi = ''; $badge = ''; $form = '0';
			if ($progres == '1') {
				$badge = 'badge-secondary';
				if ($role < 2) {
					$aksi = '<button class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#modalLoc" id="btn_loc" qr_code="'.$list_ant[$i]['qr_code'].'" kode="'.$list_ant[$i]['kode'].'" nama="'.$list_ant[$i]['nama'].'">OnLoc</button>';
				}
			} elseif ($progres == '2') {
				$badge = 'badge-warning'; $form = '1';
				if ($list_ant[$i]['tujuan'] != '0') {
					$aksi = '<button class="btn btn-sm btn-outline-success" data-toggle="modal" data-target="#modalProcess" id="btn_proc" qr_code="'.$list_ant[$i]['qr_code'].'" kode="'.$list_ant[$i]['kode'].'" nama="'.$list_ant[$i]['nama'].'" opt_u="'.$form_process_by.'" >Process</button>';
				}
			} elseif ($progres == '3') {
				$badge = 'badge-success'; $form = '1';
				if ($role < 2 || ($role == 2 && $list_ant[$i]['process_by'] == $data_session['username']) ) {
					$aksi = '<button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modalFinish" id="btn_fin" qr_code="'.$list_ant[$i]['qr_code'].'" kode="'.$list_ant[$i]['kode'].'" nama="'.$list_ant[$i]['nama'].'">Finish</button>';
				}
			} elseif ($progres == '4') {
				$badge = 'badge-primary';
				
			} 

			$detail = '<button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modalDetail" id="btn_detail" qr_code="'.$list_ant[$i]['qr_code'].'" kode="'.$list_ant[$i]['kode'].'" tanggal="'.$nmtgl.'" jam="'.$nmjam.' WIB" tujuan="'.$nmtujuan.'" layanan="'.$list_ant[$i]['layanan'].'" nama="'.$list_ant[$i]['nama'].'" email="'.$list_ant[$i]['email'].'" hp="'.$list_ant[$i]['hp'].'" instansi="'.$list_ant[$i]['instansi'].'" keperluan="'.$list_ant[$i]['keperluan'].'" progres="<b>'.$nmprogres.'</b>" form="'.$form.'"  process_by="'.$nmprocess.'" log="'.$list_ant[$i]['log'].'"><i class="fas fa-info-circle"></i></button>';

			$output .= '
			<tr style="text-align: center;">
    		<td>'.($i+1).'</td>
    		<td>'.$list_ant[$i]['kode'].'</td>
    		<td>'.$nmjam.'</td>
    		<td style="text-align: left;">'.$nmtujuan.'</td>
    		<td style="text-align: left;">'.$list_ant[$i]['nama'].'</td>
    		<td><span class="badge '.$badge.'">'.$nmprogres.'</span></td>
    		<td>'.$detail.'</td>
    		<td>'.$aksi.'</td>
    	</tr>
    	';
		}

		$output .= '
			</tbody>
        </table>
        ';

		$output .= '
		<script src="'.base_url().'assets/radmin/vendor/datatables/jquery.dataTables.min.js"></script>
		<script src="'.base_url().'assets/radmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

		<script>
		    $(document).ready(function () {
	          $("#dataTableHover").DataTable({
	            "paging": false,
	            "searching": false,
	    	  });

	    	  	var btn_detail = document.querySelectorAll(\'button[id="btn_detail"]\');
			    for(var i = 0; i < btn_detail.length; i++) {
			      btn_detail[i].addEventListener(\'click\', detail);
			    }

			    function detail(){
			      	var kode = $(this).attr("kode");
			      	var tanggal = $(this).attr("tanggal");
			      	var jam = $(this).attr("jam");
			      	var tujuan = $(this).attr("tujuan");
			      	var layanan = $(this).attr("layanan");
			      	var nama = $(this).attr("nama");
			      	var email = $(this).attr("email");
			      	var hp = $(this).attr("hp");
			      	var instansi = $(this).attr("instansi");
			      	var keperluan = $(this).attr("keperluan");
			      	var progres = $(this).attr("progres");
			      	var form = $(this).attr("form");
			      	var process_by = $(this).attr("process_by");
			      	var log = $(this).attr("log");
			      	var qr_code = $(this).attr("qr_code");

			      	$(\'#mod_kode\').html(kode);
			      	$(\'#tbl_tanggal\').html(tanggal);
			      	$(\'#tbl_jam\').html(jam);
			      	$(\'#tbl_tujuan\').html(tujuan + " " + layanan);
			      	$(\'#tbl_nama\').html(nama);
			      	$(\'#tbl_email\').html(email);
			      	$(\'#tbl_hp\').html(hp);
			      	$(\'#tbl_instansi\').html(instansi);
			      	$(\'#tbl_keperluan\').html(keperluan);
			      	$(\'#tbl_progres\').html(progres);
			      	$(\'#tbl_processby\').html(process_by);
			      	$(\'#tbl_log\').html(log);
			      	$(\'#qr_code\').val(qr_code);

			      	if(form == "1"){ document.getElementById("form_foot").style.display = ""; } else { document.getElementById("form_foot").style.display = "none"; }

		    	}

		    	var btn_loc = document.querySelectorAll(\'button[id="btn_loc"]\');
			    for(var i = 0; i < btn_loc.length; i++) {
			      btn_loc[i].addEventListener(\'click\', loc);
			    }

			    function loc(){
			      	var kode = $(this).attr("kode");
			      	var nama = $(this).attr("nama");
			      	var qr_code = $(this).attr("qr_code");
			      	
			      	$(\'#loc_kode\').html(kode);
			      	$(\'#loc_nama\').html(nama);
			      	$(\'#loc_qr\').val(qr_code);
			    }

		      var btn_proc = document.querySelectorAll(\'button[id="btn_proc"]\');
			    for(var i = 0; i < btn_proc.length; i++) {
			      btn_proc[i].addEventListener(\'click\', proc);
			    }

			    function proc(){
		      	var kode = $(this).attr("kode");
		      	var nama = $(this).attr("nama");
		      	var qr_code = $(this).attr("qr_code");
		      	var opt_u = $(this).attr("opt_u");
		      	
		      	$(\'#proc_kode\').html(kode);
		      	$(\'#proc_nama\').html(nama);
		      	$(\'#proc_qr\').val(qr_code);
		      	$(\'#form_process_by\').html(opt_u);
		      }


		      var btn_fin = document.querySelectorAll(\'button[id="btn_fin"]\');
			    for(var i = 0; i < btn_fin.length; i++) {
			      btn_fin[i].addEventListener(\'click\', finish);
			    }

			    function finish(){
		      	var kode = $(this).attr("kode");
		      	var nama = $(this).attr("nama");
		      	var qr_code = $(this).attr("qr_code");
		      	
		      	$(\'#fin_kode\').html(kode);
		      	$(\'#fin_nama\').html(nama);
		      	$(\'#fin_qr\').val(qr_code);
		      }


		    });
		</script>
		';


		$response = array( 
			'list' => $output, 
			'jml_rev' => $jml_rev, 
			'jml_on' => $jml_on, 
			'jml_tot' => $jml_rev + $jml_on, 
		);
		
        echo json_encode($response);
	}

	function onlocation(){
		$qr_code = $this->input->post('qr_code');

		$this->db->where('qr_code', $qr_code);
  		$cek = $this->db->get('reservasi')->row_array();

  		if (is_null($cek) || $this->session->userdata()['role']>1) {
  			$this->session->set_flashdata('notif','swal("Info","Anda tidak memiliki akses aksi ini","info")');
  		} else {
  			$log = $cek['log'].'<br> OnLocation at '.date('Y-m-d H:i:s');
  			$this->db->where('qr_code', $qr_code);
			$this->db->update('reservasi', array('progres' => '2', 'log' => $log));
  		}
		
		redirect(base_url('admin'));
		
	}

	function process(){
		$data_session = $this->session->userdata();
		$qr_code = $this->input->post('qr_code');
		$username = $this->input->post('process_by');

		$this->db->where('qr_code', $qr_code);
  		$cek = $this->db->get('reservasi')->row_array();

  		$this->db->where('username', $username);
  		$nama = $this->db->get('users')->row_array();

	  	if (is_null($cek) || $this->session->userdata()['role']>2) {
  			$this->session->set_flashdata('notif','swal("Info","Anda tidak memiliki akses aksi ini","info")');
  		} else {
	  		$log = $cek['log'].'<br> Process at '.date('Y-m-d H:i:s').' by '.$nama['nama'];
	  		$this->db->where('qr_code', $qr_code);
				$this->db->update('reservasi', array('progres' => '3', 'log' => $log, 'process_by' => $username));
	  	}
		
		redirect(base_url('admin'));
	
	}

	function finish(){
		$data_session = $this->session->userdata();
		$qr_code = $this->input->post('qr_code');

		$this->db->where('qr_code', $qr_code);
  		$cek = $this->db->get('reservasi')->row_array();

  		if (is_null($cek) || $this->session->userdata()['role']>2) {
  			$this->session->set_flashdata('notif','swal("Info","Anda tidak memiliki akses aksi ini","info")');
  		} else {
  			$log = $cek['log'].'<br> Finished at '.date('Y-m-d H:i:s');
  			$this->db->where('qr_code', $qr_code);
			$this->db->update('reservasi', array('progres' => '4', 'log' => $log));
  		}
		
		redirect(base_url('admin'));
	
	}

	function edit(){
		if ($this->session->userdata()['role']>1) {
			$this->session->set_flashdata('notif','swal("Info","Anda tidak memiliki akses aksi ini","info")');
			redirect(base_url('admin'));
		} else {
			$qr_code = $this->input->post('qr_code');
			$this->db->where('qr_code', $qr_code);
  			$det_rev = $this->db->get('reservasi')->row_array();

  		if (is_null($det_rev)) { 
  			redirect(base_url('admin'));
  		} else {
  			$data = array('det' => $det_rev);
			$this->load->view('admin/edit', $data);
  		}

		}
	}

	function update_edit(){
		$id = $this->input->post('id');
		$qr_code = $this->input->post('qr_code');

		$jam = $this->input->post('jam');
    	$hp = $this->input->post('hp');
    	$tujuan = $this->input->post('tujuan');
    	$layanan = $this->input->post('layanan');
    	$email = $this->input->post('email');
		$keperluan = $this->input->post('keperluan');

		//tulis log disini
		$this->db->where('qr_code', $qr_code);
  		$cek = $this->db->get('reservasi')->row_array();
  		$progres = $cek['progres'];

  		$log = $cek['log'].'<br> Edited at '.date('Y-m-d H:i:s').' { ';
  		if (date('H:i', strtotime($cek['jam'])) != $jam) { $log .= ' jam : ['.date('H:i', strtotime($cek['jam'])).','.$jam.'], '; }
  		if ($cek['hp'] != $hp) { $log .= ' hp : ['.$cek['hp'].','.$hp.'], '; }
  		if ($cek['email'] != $email) { $log .= ' email : ['.$cek['email'].','.$email.'], '; }
  		if ($cek['keperluan'] != $keperluan) { $log .= ' keperluan : ['.str_replace(",", "", $cek['keperluan']).','.str_replace(",", "", $keperluan).'], '; }
	  	if ($cek['tujuan'] != $tujuan) { 
	  		$this->db->where('id', $cek['tujuan']); $nmt1 = $this->db->get('tujuan')->row_array();
			if (is_null($nmt1)) { $nmt1 = ''; } else { $nmt1 = $nmt1['nama']; }

			$this->db->where('id', $tujuan); $nmt2 = $this->db->get('tujuan')->row_array();
			if (is_null($nmt2)) { $nmt2 = ''; } else { $nmt2 = $nmt2['nama']; }

	  		$log .= ' tujuan : ['.$nmt1.','.$nmt2.'], '; 
	  	}
  		if ($cek['layanan'] != $layanan) { $log .= ' layanan : ['.$cek['layanan'].','.$layanan.'], '; }
  		$log .= ' }';

		$data = array(
      		'jam' => $jam,
      		'hp' => $hp,
      		'tujuan' => $tujuan,
      		'layanan' => $layanan,
      		'email' => $email,
      		'keperluan' => $keperluan,
      		'log' => $log,
      		'progres' => '2',
		);

		$this->db->where('id', $id);
		$this->db->update('reservasi', $data);

		$this->session->set_flashdata('notif','swal("Sukses","Edit reservasi berhasil","success")');
	  	redirect(base_url('admin'));
	}
	
	function export(){
		$tanggal = $this->input->post('tgl_ex');
        $tanggal = explode(' - ', $tanggal);

        $tgl_mulai = date("Y-m-d", strtotime($tanggal[0]));
        $tgl_selesai = date("Y-m-d", strtotime($tanggal[1]));

        $this->db->where('tanggal >=', $tgl_mulai);
        $this->db->where('tanggal <=', $tgl_selesai);
        $this->db->order_by('tanggal', 'ASC');
        $this->db->order_by('id', 'ASC');
        $hasil = $this->db->get('reservasi')->result_array();

        $hari = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
        $arr_tujuan = $this->db->get('tujuan')->result_array();
        for ($i=0; $i < count($arr_tujuan); $i++) { $tujuan[$arr_tujuan[$i]['id']] = $arr_tujuan[$i]['nama']; }


		$data[0] = ['<b>No</b>','<b>Hari</b>','<b>Tanggal</b>','<b>Jam</b>','<b>Kode Antrian</b>','<b>Nama</b>','<b>Jenis Kelamin</b>','<b>No Handphone</b>','<b>Email</b>','<b>Instansi</b>','<b>Tujuan</b>','<b>Layanan</b>','<b>Keperluan</b>'];
		for ($i=0; $i < count($hasil); $i++) { 
            $n = $i+1;
            if ($hasil[$i]['jk']=='1') { $jk = 'Laki-laki'; } else { $jk = 'Perempuan'; }
            if ($hasil[$i]['tujuan']=='0') { $txt_tujuan = ''; } else { $txt_tujuan = $tujuan[$hasil[$i]['tujuan']]; }
			$data[$n] = [
				$n,
				"\0".$hari[date('w', strtotime($hasil[$i]['tanggal']))],
				"\0".$hasil[$i]['tanggal'],
				"\0".$hasil[$i]['jam'],
				"\0".$hasil[$i]['kode'],
				"\0".$hasil[$i]['nama'],
				"\0".$jk,
				"\0".$hasil[$i]['hp'],
				"\0".$hasil[$i]['email'],
				"\0".$hasil[$i]['instansi'],
				"\0".$txt_tujuan,
				"\0".$hasil[$i]['layanan'],
				"\0".$hasil[$i]['keperluan']
			];

        }
		// var_dump($data);

		$nmdir = 'assets/file_tmp/rekap/';
		$nmfile = 'Rekap Web Guest-'.substr(md5(date('Y-m-d H:i:s')), 0, 5);
		if( is_dir($nmdir) === false ) { mkdir($nmdir, 0777, true); }
		$this->m_model->deleteFile($nmdir);

		$this->load->library('SimpleXLSXGen');
		$xlsx = new SimpleXLSXGen();
		$xlsx->addSheet( $data, 'Antrian');
		$xlsx->saveAs($nmdir.$nmfile.'.xlsx');
		redirect(base_url($nmdir.$nmfile.'.xlsx'));
	}


}
