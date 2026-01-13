<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Qr extends CI_Controller {

    public function index(){
		$sudah_login = $this->session->userdata('login_antrian');
    	if ($sudah_login!=TRUE) { redirect(base_url('login')); } 

		$hash_tgl = md5('bps-jatim'.date('Y-m-d'));
		$data = array('hash_tgl' => $hash_tgl);
		$this->load->view('qr/index', $data);
	}

	function new($hash_tgl=null){
		if (md5('bps-jatim'.date('Y-m-d')) != $hash_tgl) {
			redirect(base_url('qr'));
		} else {
			$tanggal = date('Y-m-d');

			$this->db->where(array('tanggal' => $tanggal));
        	$this->db->order_by('id DESC'); $this->db->limit(1);
        	$q_kode = $this->db->get('reservasi')->row_array();
        	
        	if (is_null($q_kode)) { $kode_tmp = 1; } else { $kode_tmp = intval(substr($q_kode['kode'], 1, 3)) + 1; }
			$kode = 'A';
			for ($i=0; $i < 3-strlen($kode_tmp); $i++) { $kode .= '0'; }
			$kode .= $kode_tmp;
			$qr_code = md5('bps-jatim'.$tanggal.$kode);

			$data = array(
		        'kode' => $kode,
		        'tanggal' => $tanggal,
		        'jam' => date('H:i'),
		        'jenis' => '2',
		        'progres' => '2',
		        'qr_code' => $qr_code,
		        'log' => 'Scanned at '.date('Y-m-d H:i:s'),
			);

            //update code tgl 12/07/2022
			$this->db->insert('reservasi_dump', $data);
			redirect(base_url('qr/form/'.$qr_code));
		}
	}

	public function form($qr_code=null){
		$this->db->where(array('qr_code' => $qr_code));
    	$cek = $this->db->get('reservasi_dump')->row_array();

		if (is_null($cek)) {
			redirect(base_url('qr'));
		} else {
			$data = array('det' => $cek);
			$this->load->view('qr/form', $data);
		}
	}

	function update_form(){
		$id = $this->input->post('id');
		$qr_code = $this->input->post('qr_code');
		$kode = $this->input->post('kode');
		$tanggal = $this->input->post('tanggal');
        $nama = $this->input->post('nama');
        $jk = $this->input->post('jk');
        $hp = $this->input->post('hp');
        $email = $this->input->post('email');
        $keperluan = $this->input->post('keperluan');
        $tujuan = $this->input->post('tujuan');
        $layanan = $this->input->post('layanan');
        $instansi = $this->input->post('instansi');
        if ($instansi == 'BPS') { $instansi = $this->input->post('inst_bps'); }
        if ($instansi == '-') { 
            $instansi = $this->input->post('inst_lain'); 
            $this->db->insert('instansi', array( 'nama' => $instansi));
        }

		$this->db->where('qr_code', $qr_code);
  		$cek = $this->db->get('reservasi_dump')->row_array();

		$data = array(
		    'kode' => $kode,
		    'tanggal' => $tanggal,
		    'jam' => date('H:i'),
		    'jenis' => '2',
		    'progres' => '2',
            'nama' => $nama,
            'jk' => $jk,
            'hp' => $hp,
            'instansi' => $instansi,
            'tujuan' => $tujuan,
            'layanan' => $layanan,
            'email' => $email,
            'keperluan' => $keperluan,
            'qr_code' => $qr_code,
	        'log' => $cek['log'].'<br> Updated at '.date('Y-m-d H:i:s'),
		);

		$this->db->where('id', $id);
		$this->db->update('reservasi_dump', $data);
		$this->db->insert('reservasi', $data);

		$this->session->set_flashdata('notif', 'swal("Berhasil","Silahkan tunjukkan tiket berikut kepada resepsionis.","success")');
		redirect(base_url('qr/tiket/'.$qr_code));
	}

	public function tiket($qr_code=null){
		$this->db->where(array('qr_code' => $qr_code));
    	$cek = $this->db->get('reservasi')->row_array();

		if (is_null($cek)) {
			redirect(base_url('qr'));
		} else {
			$data = array('det' => $cek, 'from' => 'qr');
			$this->load->view('qr/tiket', $data);
		}
	}

	function onlocation($qr_code=null){
		$this->db->where(array('qr_code' => $qr_code));
    	$cek = $this->db->get('reservasi')->row_array();

		if (is_null($cek)) {
			$this->session->set_flashdata('notif', 'swal("Gagal","Silahkan scan ulang kode QR Anda.","error")');
		} else {
			//validasi hari dan progres
			if (intval($cek['progres'])>1) {
				$this->session->set_flashdata('notif', 'swal("Info","Anda sudah melakukan check in.","info")');
			} elseif ($cek['tanggal'] != date('Y-m-d')) {
				$this->session->set_flashdata('notif', 'swal("Info","Tiket anda berlaku pada tanggal '.date('d F Y').'. Silahkan reservasi ulang. ","info")');
			} else {
				$this->db->where('qr_code', $qr_code);
				$this->db->update('reservasi', array('progres' => '2', 'log' => $cek['log'].'<br> OnLocation at '.date('Y-m-d H:i:s') ));
				$this->session->set_flashdata('notif', 'swal("Berhasil","Silahkan tunggu nama anda dipanggil oleh resepsionis.","success")');
			}
			
		}

	    redirect(base_url('qr'));
	}

}
