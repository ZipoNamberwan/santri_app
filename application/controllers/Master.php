<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

	function __construct(){
		parent::__construct();
		$role = $this->session->userdata('role');
    	if ($role > 1) { redirect(base_url('admin')); } 
	}

	public function index(){
		$data_session = $this->session->userdata();

		$data = array(
			'session' => $data_session,
			'hal' => 'master',
		);

		$this->load->view('layout/head', $data);
		$this->load->view('admin/master', $data);
		$this->load->view('layout/foot');
	}


	//// INSTANSI /////
	function list_instansi(){
  		$this->db->order_by('id ASC');
		$list_ins = $this->db->get('instansi')->result_array();

  		$output = '
		<table class="table align-items-center table-flush table-hover" id="dataInstansi">
	      <thead class="thead-light" style="text-align:center; font-size: 90%;">
	        <tr>
	          <th>No</th>
	          <th>Instansi</th>
	          <th>Edit</th>
	          <th>Delete</th>
	        </tr>
	      </thead>
	      <tbody style="text-align:center; font-size: 90%;">';

	    for ($i=0; $i < count($list_ins); $i++) { 

			$btn_edit = '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalInsEdit" id="btn_ins_edit" id_ins="'.$list_ins[$i]['id'].'" nama="'.$list_ins[$i]['nama'].'"><i class="fas fa-edit"></i></button>';
			$btn_del = '<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalInsDel" id="btn_ins_del" id_ins="'.$list_ins[$i]['id'].'" nama="'.$list_ins[$i]['nama'].'"><i class="fas fa-trash"></i></button>';

			$output .= '
			<tr style="text-align: center;">
	    		<td style="width:5%;">'.($i+1).'</td>
	    		<td style="text-align: left;">'.$list_ins[$i]['nama'].'</td>
	    		<td style="width:5%;">'.$btn_edit.'</td>
	    		<td style="width:5%;">'.$btn_del.'</td>
	    	</tr>';
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
	          	$("#dataInstansi").DataTable({
	            	"paging": false,
	            	"searching": false,
	    	  	});

	    	  	var btn_ins_edit = document.querySelectorAll(\'button[id="btn_ins_edit"]\');
			    for(var i = 0; i < btn_ins_edit.length; i++) {
			      btn_ins_edit[i].addEventListener(\'click\', edit);
			    }

			    function edit(){
			      	var id_ins = $(this).attr("id_ins");
			      	var nama = $(this).attr("nama");

			      	$(\'#id_ins_edit\').val(id_ins);
			      	$(\'#nama_ins_edit\').val(nama);
			      	document.getElementById("btn_ins_edit_sub").disabled = true;
			    }

			    var btn_ins_del = document.querySelectorAll(\'button[id="btn_ins_del"]\');
			    for(var i = 0; i < btn_ins_del.length; i++) {
			      btn_ins_del[i].addEventListener(\'click\', del);
			    }

			    function del(){
			      	var id_ins = $(this).attr("id_ins");
			      	var nama = $(this).attr("nama");

			      	$(\'#id_ins_del\').val(id_ins);
			      	$(\'#nama_ins_del\').html(nama);
			    }

		    });
		</script>
		';

		$response = array( 
			'list_ins' => $output, 
			'jml_ins' => count($list_ins), 
		);
		
        echo json_encode($response);
	}

	function tambah_instansi(){
		$nama = $this->input->post('nama');

		//cek instansi sudah ada
		$this->db->where('nama', $nama);
  		$cek = $this->db->get('instansi')->row_array();
		
		if (is_null($cek)) { $this->db->insert('instansi', array('nama' => $nama)); } 
	}

	function edit_instansi(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');

		if (strlen($nama) > 2) {
			$this->db->where('id', $id);
			$this->db->update('instansi', array('nama' => $nama));
		}

	}

	function hapus_instansi(){
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->delete('instansi');

	}


	////// BPS /////
	function list_BPS(){
  		$this->db->order_by('id ASC');
		$list_bps = $this->db->get('instansi_bps')->result_array();

  		$output = '
		<table class="table align-items-center table-flush table-hover" id="dataBps">
	      <thead class="thead-light" style="text-align:center; font-size: 90%;">
	        <tr>
	          <th>No</th>
	          <th>Kode</th>
	          <th>BPS</th>
	          <th>Edit</th>
	          <th>Delete</th>
	        </tr>
	      </thead>
	      <tbody style="text-align:center; font-size: 90%;">';

	    for ($i=0; $i < count($list_bps); $i++) { 

			$btn_edit = '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalBpsEdit" id="btn_bps_edit" id_bps="'.$list_bps[$i]['id'].'" kode="'.$list_bps[$i]['kode'].'" nama="'.$list_bps[$i]['nama'].'"><i class="fas fa-edit"></i></button>';
			$btn_del = '<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalBpsDel" id="btn_bps_del" id_bps="'.$list_bps[$i]['id'].'" kode="'.$list_bps[$i]['kode'].'" nama="'.$list_bps[$i]['nama'].'"><i class="fas fa-trash"></i></button>';

			$output .= '
			<tr style="text-align: center;">
	    		<td style="width:5%;">'.($i+1).'</td>
	    		<td style="width:5%;">'.$list_bps[$i]['kode'].'</td>
	    		<td style="text-align: left;">'.$list_bps[$i]['nama'].'</td>
	    		<td style="width:5%;">'.$btn_edit.'</td>
	    		<td style="width:5%;">'.$btn_del.'</td>
	    	</tr>';
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
	          	$("#dataBps").DataTable({
	            	"paging": false,
	            	"searching": false,
	    	  	});

	    	  	var btn_bps_edit = document.querySelectorAll(\'button[id="btn_bps_edit"]\');
			    for(var i = 0; i < btn_bps_edit.length; i++) {
			      btn_bps_edit[i].addEventListener(\'click\', edit);
			    }

			    function edit(){
			      	var id_bps = $(this).attr("id_bps");
			      	var kode = $(this).attr("kode");
			      	var nama = $(this).attr("nama");

			      	$(\'#id_bps_edit\').val(id_bps);
			      	$(\'#kode_bps_edit\').val(kode);
			      	$(\'#nama_bps_edit\').val(nama);
			      	document.getElementById("btn_bps_edit_sub").disabled = true;
			    }

			    var btn_bps_del = document.querySelectorAll(\'button[id="btn_bps_del"]\');
			    for(var i = 0; i < btn_bps_del.length; i++) {
			      btn_bps_del[i].addEventListener(\'click\', del);
			    }

			    function del(){
			      	var id_bps = $(this).attr("id_bps");
			      	var kode = $(this).attr("kode");
			      	var nama = $(this).attr("nama");

			      	$(\'#id_bps_del\').val(id_bps);
			      	$(\'#nama_bps_del\').html(kode + " - " +nama);
			    }

		    });
		</script>
		';

		$response = array( 
			'list_bps' => $output, 
			'jml_bps' => count($list_bps), 
		);
		
        echo json_encode($response);
	}

	function tambah_bps(){
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$s = 0; $m = '';

		//cek kantor bps sudah ada
		$this->db->where('kode', $kode);
  		$cek = $this->db->get('instansi_bps')->row_array();

  		$this->db->where('nama', $nama);
  		$cek2 = $this->db->get('instansi_bps')->row_array();
		
		if ($nama == '') { $m = 'Nama Kantor BPS tidak boleh kosong';
		} elseif (strlen($kode) != 4) { $m = 'Kode BPS harus terdiri dari 4 Karakter';
		} elseif (!is_null($cek)) { $m = 'Kode BPS sudah terdaftar';
		} elseif (!is_null($cek2)) { $m = 'Nama Kantor BPS sudah terdaftar';
		} else { $this->db->insert('instansi_bps', array('kode' => $kode, 'nama' => $nama));  $s = 1; }

		$res = array('s' => $s, 'm' => $m );
        echo json_encode($res);
	}

	function edit_bps(){
		$id = $this->input->post('id');
		$kode = $this->input->post('kode');
		$nama = $this->input->post('nama');
		$s = 0; $m = '';

		if (strlen($nama) > 2) {
			$this->db->where('id', $id);
			$this->db->update('instansi', array('nama' => $nama));
		}


		//cek kantor bps sudah ada
		$this->db->where('id', $id);
  		$cek = $this->db->get('instansi_bps')->row_array();

		$this->db->where('kode', $kode);
  		$cek1 = $this->db->get('instansi_bps')->row_array();

  		$this->db->where('nama', $nama);
  		$cek2 = $this->db->get('instansi_bps')->row_array();
		
		if ($nama == '') { $m = 'Nama Kantor BPS tidak boleh kosong';
		} elseif (strlen($kode) != 4) { $m = 'Kode BPS harus terdiri dari 4 Karakter';
		} elseif (!is_null($cek1) && $cek['kode']!=$kode) { $m = 'Kode BPS sudah terdaftar';
		} elseif (!is_null($cek2) && $cek['nama']!=$nama) { $m = 'Nama Kantor BPS sudah terdaftar';
		} else { 
			$this->db->where('id', $id);
			$this->db->update('instansi_bps', array('kode' => $kode, 'nama' => $nama));  $s = 1; }

		$res = array('s' => $s, 'm' => $m );
        echo json_encode($res);

	}

	function hapus_bps(){
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->delete('instansi_bps');

	}




	////// Layanan /////
	function list_layanan(){
		$tujuan = $this->input->post('tujuan');

		$this->db->where('id_tujuan', $tujuan);
  		$this->db->order_by('id ASC');
		$list_lay = $this->db->get('layanan')->result_array();

		$this->db->where('id', $tujuan);
		$nmtujuan = $this->db->get('tujuan')->row_array();
		$nmtujuan = $nmtujuan['nama'];

  		$output = '
		<table class="table align-items-center table-flush table-hover" id="dataLayanan">
	      <thead class="thead-light" style="text-align:center; font-size: 90%;">
	        <tr>
	          <th>No</th>
	          <th>Layanan</th>
	          <th>Edit</th>
	          <th>Delete</th>
	        </tr>
	      </thead>
	      <tbody style="text-align:center; font-size: 90%;">';

	    for ($i=0; $i < count($list_lay); $i++) { 

			$btn_edit = '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalLayEdit" id="btn_lay_edit" id_lay="'.$list_lay[$i]['id'].'" nama="'.$list_lay[$i]['nama'].'" tujuan="'.$list_lay[$i]['id_tujuan'].'"><i class="fas fa-edit"></i></button>';
			$btn_del = '<button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalLayDel" id="btn_lay_del" id_lay="'.$list_lay[$i]['id'].'" nama="'.$list_lay[$i]['nama'].'" nmtujuan="'.$nmtujuan.'"><i class="fas fa-trash"></i></button>';

			$output .= '
			<tr style="text-align: center;">
	    		<td style="width:5%;">'.($i+1).'</td>
	    		<td style="text-align: left;">'.$list_lay[$i]['nama'].'</td>
	    		<td style="width:5%;">'.$btn_edit.'</td>
	    		<td style="width:5%;">'.$btn_del.'</td>
	    	</tr>';
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
	          	$("#dataLayanan").DataTable({
	            	"paging": false,
	            	"searching": false,
	    	  	});

	    	  	var btn_lay_edit = document.querySelectorAll(\'button[id="btn_lay_edit"]\');
			    for(var i = 0; i < btn_lay_edit.length; i++) {
			      btn_lay_edit[i].addEventListener(\'click\', edit);
			    }

			    function edit(){
			      	var id_lay = $(this).attr("id_lay");
			      	var nama = $(this).attr("nama");
			      	var tujuan = $(this).attr("tujuan");

			      	$(\'#id_lay_edit\').val(id_lay);
			      	$(\'#nama_lay_edit\').val(nama);
			      	document.getElementById("btn_lay_edit_sub").disabled = true;
			      	$(\'#tujuan_lay_edit\').val(tujuan);
			    }

			    var btn_lay_del = document.querySelectorAll(\'button[id="btn_lay_del"]\');
			    for(var i = 0; i < btn_lay_del.length; i++) {
			      btn_lay_del[i].addEventListener(\'click\', del);
			    }

			    function del(){
			      	var id_lay = $(this).attr("id_lay");
			      	var nama = $(this).attr("nama");
			      	var nmtujuan = $(this).attr("nmtujuan");

			      	$(\'#id_lay_del\').val(id_lay);
			      	$(\'#nama_lay_del\').html(nmtujuan + " - " +nama);
			    }

		    });
		</script>
		';

		$jml_lay = $this->db->get('layanan')->result_array();

		$response = array( 
			'list_lay' => $output, 
			'jml_lay' => count($jml_lay), 
		);
		
        echo json_encode($response);
	}

	function tambah_layanan(){
		$tujuan = $this->input->post('tujuan');
		$nama = $this->input->post('nama');
		$s = 0; $m = '';
		

		//cek layanan sudah ada
		$this->db->where('id_tujuan', $tujuan);
		$this->db->where('nama', $nama);
  		$cek = $this->db->get('layanan')->row_array();
		
		if (is_null($cek)) { $this->db->insert('layanan', array('id_tujuan' => $tujuan, 'nama' => $nama)); $s = 1; }
		else { $m = 'Layanan sudah tersedia.'; } 

		$res = array('s' => $s, 'm' => $m );
        echo json_encode($res);
	}

	function edit_layanan(){
		$id = $this->input->post('id');
		$tujuan = $this->input->post('tujuan');
		$nama = $this->input->post('nama');
		$s = 0; $m = '';

		//cek layanan sudah ada
		$this->db->where('id_tujuan', $tujuan);
		$this->db->where('nama', $nama);
  		$cek = $this->db->get('layanan')->row_array();
		
		if (is_null($cek)) { 
			$this->db->where('id', $id);
			$this->db->update('layanan', array('id_tujuan' => $tujuan, 'nama' => $nama)); $s = 1; 
		} else { $m = 'Layanan sudah tersedia.'; } 

		$res = array('s' => $s, 'm' => $m );
        echo json_encode($res);

	}

	function hapus_layanan(){
		$id = $this->input->post('id');

		$this->db->where('id', $id);
		$this->db->delete('layanan');

	}

}
