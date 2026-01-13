<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct(){
		parent::__construct();
		$sudah_login = $this->session->userdata('login_antrian');
    	if ($sudah_login!=TRUE) { redirect(base_url('login')); } 
	}

	public function index() {
        $data_session = $this->session->userdata();
		$role = $data_session['role'];
		$tujuan = $data_session['tujuan'];

		$data = array(
			'session' => $data_session,
			'hal' => 'users',
			'tujuan' => $tujuan,
		);

		$this->load->view('layout/head', $data);
		$this->load->view('users/index', $data);
		$this->load->view('layout/foot');
    }

    function list_users(){
		$data_session = $this->session->userdata();
		$role = $data_session['role'];
		$input_t = $this->input->post('tujuan');

		if ($role>1) { $this->db->where('tujuan', $input_t); $th_edit = ''; } else { $th_edit = '<th>Edit</th>'; }
  		$this->db->order_by('role ASC, tujuan ASC, id ASC');
  		$list_user = $this->db->get('users')->result_array();

  		$output = '
		<table class="table align-items-center table-flush table-hover" id="dataTableHover">
	      <thead class="thead-light" style="text-align:center; font-size: 90%;">
	        <tr>
	          <th>No</th>
	          <th>Nama</th>
	          <th>Username</th>
	          <th>Role</th>
	          <th>Fungsi/Bagian</th>
	          <th>Last Active</th>
	          '.$th_edit.'
	        </tr>
	      </thead>
	      <tbody style="text-align:center; font-size: 90%;">';

		for ($i=0; $i < count($list_user); $i++) { 
			$tujuan = $list_user[$i]['tujuan'];
			$this->db->where('id', $tujuan);
    		$nmtujuan = $this->db->get('tujuan')->row_array();
			if (is_null($nmtujuan)) { $nmtujuan = '-'; } else { $nmtujuan = $nmtujuan['nama']; }

			//last_active
			$lastActive = new DateTime($list_user[$i]['last_active']);
			$now = new DateTime();
			$diff = $now->diff($lastActive, true);
			$last_active = '';
			if ($diff->d > 0) { $last_active .= $diff->d.' day '; }
			if ($diff->h > 0) { $last_active .= $diff->h.' hour '; }
			if ($diff->i > 0) { $last_active .= $diff->i.' min '; }
			$last_active .= $diff->s.' sec ago.';

			if ($role == 1) {
				$td_edit = '<td><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEdit" id="btn_edit" username="'.$list_user[$i]['username'].'" role="'.$list_user[$i]['role'].'" nama="'.$list_user[$i]['nama'].'" tujuan="'.$list_user[$i]['tujuan'].'"><i class="fas fa-user-edit"></i></button></td>';
			} else { $td_edit = ''; }

			$output .= '
			<tr style="text-align: center;">
	    		<td>'.($i+1).'</td>
	    		<td style="text-align: left;">'.$list_user[$i]['nama'].'</td>
	    		<td>'.$list_user[$i]['username'].'</td>
	    		<td>'.$list_user[$i]['role'].'</td>
	    		<td style="text-align: left;">'.$nmtujuan.'</td>
	    		<td>'.$last_active.'</td>
	    		'.$td_edit.'
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
	          $("#dataTableHover").DataTable({
	            "paging": false,
	            "searching": false,
	    	  });

	    	  	var btn_edit = document.querySelectorAll(\'button[id="btn_edit"]\');
			    for(var i = 0; i < btn_edit.length; i++) {
			      btn_edit[i].addEventListener(\'click\', edit);
			    }

			    function edit(){
			      	var username = $(this).attr("username");
			      	var role = $(this).attr("role");
			      	var nama = $(this).attr("nama");
			      	var tujuan = $(this).attr("tujuan");
			      	
			      	$(\'#username_ed_txt\').html(username);
			      	$(\'#username_ed\').val(username);
			      	$(\'#role_ed\').val(role);
			      	$(\'#nama_ed\').val(nama);
			      	$(\'#tujuan_ed\').val(tujuan);

			      	if(role == 1){
			      		document.getElementById("div_tujuan_ed").style.display = "none";
				        document.getElementById("tujuan_ed").required = false;
				        $("#tujuan_ed").val();
			      	} else {
			      		document.getElementById("div_tujuan_ed").style.display = "";
        				document.getElementById("tujuan_ed").required = true;
			      	}

			      	$(\'#username_del_txt\').html(username);
			      	$(\'#username_del\').val(username);
			      	$(\'#username_res_txt\').html(username);
			      	$(\'#username_res\').val(username);
			    }

		    });
		</script>
		';

		echo $output;
	}

	function tambah(){
		$username = $this->input->post('username');
		$role = $this->input->post('role');
		$nama = $this->input->post('nama');
		if ($role == 1) { $tujuan = 0; } else { $tujuan = $this->input->post('tujuan'); }
		$password = hash('sha256', $username.'antrian-3500');

		$data = array(
			'username' => $username,
			'role' => $role,
			'nama' => $nama,
			'tujuan' => $tujuan,
			'password' => $password,
		);

		//cek username udah ada
		$this->db->where('username', $username);
  		$cek = $this->db->get('users')->row_array();
		
		if (is_null($cek)) {
			//insert ke db
			$this->db->insert('users', $data);
			$this->session->set_flashdata('notif', 'swal("Success","Tambah User Baru Berhasil. Password default sama dengan username.","success")');
		} else {
			$this->session->set_flashdata('notif', 'swal("Info","Username sudah ditambahkan.","info")');
		}

		redirect(base_url('users'));
	}

	function edit(){
		$username = $this->input->post('username');
		$role = $this->input->post('role');
		$nama = $this->input->post('nama');
		if ($role == 1) { $tujuan = 0; } else { $tujuan = $this->input->post('tujuan'); }

		$data = array(
			'role' => $role,
			'nama' => $nama,
			'tujuan' => $tujuan,
		);

		//cek username udah ada
		$this->db->where('username', $username);
  		$cek = $this->db->get('users')->row_array();

		if (!is_null($cek)) {
			//update ke db
			$this->db->where('username', $username);
			$this->db->update('users', $data);
			$this->session->set_flashdata('notif', 'swal("Success","Edit User Berhasil.","success")');
		} else {
			$this->session->set_flashdata('notif', 'swal("Error","Username tidak ditemukan.","error")');
		}

		redirect(base_url('users'));
	}

	function delete(){
		$username = $this->input->post('username');
		$this->db->where('username', $username);
		$this->db->delete('users');
		$this->session->set_flashdata('notif', 'swal("Success","Delete User Berhasil.","success")');
		redirect(base_url('users'));
	}

	function reset(){
		$username = $this->input->post('username');
		$password = hash('sha256', $username.'antrian-3500');

		$this->db->where('username', $username);
		$this->db->update('users', array('password' => $password));
		$this->session->set_flashdata('notif', 'swal("Success","Reset Password User Berhasil.","success")');
		redirect(base_url('users'));
	}

	//khusus user session sendiri
	public function ganti_password(){
		$data_session = $this->session->userdata();

		$data = array(
			'session' => $data_session,
			'hal' => 'users',
		);

		$this->load->view('layout/head', $data);
		$this->load->view('users/ganti_pw', $data);
		$this->load->view('layout/foot');
	}

	function ganti_pw(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$konf_pass = $this->input->post('konf_pass');

		if (strlen($password) < 6) {
			$this->session->set_flashdata('notif', 'swal("Error","Password terdiri dari minimal 6 Karakter!","error")');
			redirect(base_url('users/ganti_password'));
		} elseif ($password != $konf_pass) {
			$this->session->set_flashdata('notif', 'swal("Error","Password dan Konfirmasi Password harus sesuai!","error")');
			redirect(base_url('users/ganti_password'));
		} else {
			$pw_hash = hash('sha256', $password.'antrian-3500');

			$this->db->where('username', $username);
			$this->db->update('users', array('password' => $pw_hash));
			$this->session->set_flashdata('notif', 'swal("Success","Ganti Password Berhasil.","success")');
			redirect(base_url('admin'));
		}

	}

}
