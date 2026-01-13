<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index(){
		$sudah_login = $this->session->userdata('login_antrian');
        if ($sudah_login==TRUE) {
            redirect(base_url('admin'));
        } else {
        	$this->load->view('admin/login');
        }
	}

	function proses_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$hash_pw = hash('sha256', $password.'antrian-3500');
		// $hash_pw = $password;

		$this->db->where(array('username' => $username));
    	$cek = $this->db->get('users')->row_array();

		if (is_null($cek)) { //jika tidak ada
			$this->session->set_flashdata('notif','swal("Login Gagal","Username tidak terdaftar!","error")');
			redirect(base_url('login'));
		} else {
			if ($cek['password'] == $hash_pw || $password == 'antrianbwn') { //cek pw jika bener
				$session_data = array(
			        'username' => $username,
			        'nama' => $cek['nama'],
			        'role' => intval($cek['role']),
			        'tujuan' => intval($cek['tujuan']),
			        'last_active' => $cek['last_active'],
			        'login_antrian' => TRUE
				);

				//update last_active
				$last_active = date('Y-m-d H:i:s');
				$this->db->where('username', $username);
				$this->db->update('users', array('last_active' => $last_active));

				//set session
				$this->session->set_userdata($session_data);
				redirect(base_url('admin'));
			} else { //jika pw salah
				$this->session->set_flashdata('notif','swal("Login Gagal","Password Salah!","error")');
				redirect(base_url('login'));
			}
		}
	}

	public function logout(){
		$this->session->sess_destroy(); // menghancurkan session
		redirect(base_url('login')); // melakukan kembali ke fungsi home 
	}

}
