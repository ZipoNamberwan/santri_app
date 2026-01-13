<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reservation extends CI_Controller {

    public function index() {
        $this->load->view('reservation/index');
    }

    function load_layanan(){
        $tujuan = $this->input->post('tujuan');
        $opt = '<option value="">Pilih Layanan</option>'; $form = 0;

        $this->db->where(array('id_tujuan' => $tujuan));
        $list_lay = $this->db->get('layanan')->result_array();

        if (count($list_lay)>0) { $form = 1; }
        for ($i=0; $i < count($list_lay); $i++) { 
            $opt .= '<option value="'.$list_lay[$i]['nama'].'">'.$list_lay[$i]['nama'].'</option>';
        }

        $response = array( 'opt' => $opt, 'form' => $form );
        echo json_encode($response);
    }

    function order() {
        $tanggal = $this->input->post('tanggal');
        $jam = $this->input->post('jam');
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
        
        //***update code 12 Juli 2022***
        if (is_null($tanggal)) { redirect(base_url('reservation')); }

        $this->db->where(array('tanggal' => $tanggal));
        $this->db->order_by('id DESC'); $this->db->limit(1);
        $q_kode = $this->db->get('reservasi')->row_array();

        if (is_null($q_kode)) { $kode_tmp = 1; } else { $kode_tmp = intval(substr($q_kode['kode'], 1, 3)) + 1; }
        $kode = 'R';
        for ($i = 0; $i < 3 - strlen($kode_tmp); $i++) { $kode .= '0'; }
        $kode .= $kode_tmp;
        $qr_code = md5('bps-jatim'.$tanggal.$kode);

        $data = array(
            'kode' => $kode,
            'tanggal' => $tanggal,
            'jam' => $jam,
            'nama' => $nama,
            'jk' => $jk,
            'hp' => $hp,
            'instansi' => $instansi,
            'tujuan' => $tujuan,
            'layanan' => $layanan,
            'email' => $email,
            'keperluan' => $keperluan,
            'jenis' => '1',
            'progres' => '1',
            'qr_code' => $qr_code,
            'log' => 'Reserved at '.date('Y-m-d H:i:s'),
        );

        $this->db->insert('reservasi', $data);

        //kirim email disini
        $this->db->where(array('id' => $tujuan));
        $nmtujuan = $this->db->get('tujuan')->row_array();
        if (is_null($nmtujuan)) { $nmtujuan = 'Tidak Diketahui'; } else { $nmtujuan = $nmtujuan['nama']; }

        //$pesan = '
        //Tanggal : '.date('l, d F Y', strtotime($tanggal)).'<br>
        //Jam : '.date('H:i', strtotime($jam)).' WIB <br>
        //Nama : '.$nama.' <br>
        //Instansi Asal : '.$instansi.' <br>
        //Tujuan : '.$nmtujuan.' '.$layanan.'<br>
        //Keperluan : '.$keperluan.' <br>
        //Kode reservasi: '.$kode.'<br><br>
        //Scan kode QR berikut ketika sampai di BPS Provinsi Jawa Timur <br>
        //<img src="https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl='.$qr_code.'">';
        
        //***update code 12 Juli 2022***
        $pesan = '
        <table style="width:100%;">
          <tr style="text-align: center;"><td colspan="5">No antrian <br> <b style="font-size:300%;">'.$kode.'</b></td></tr>
          <tr><td rowspan="6" style="width:5%;"></td><td style="text-align: right;">Tanggal : </td><td>'.date('l, d F Y', strtotime($tanggal)).'</td><td rowspan="6" style="width:5%;"></td></tr>
          <tr><td style="text-align: right;">Jam : </td><td>'.date('H:i', strtotime($jam)).' WIB</td></tr>
          <tr><td style="text-align: right;">Nama : </td><td>'.$nama.'</td></tr>
          <tr><td style="text-align: right;">Instansi : </td><td>'.$instansi.'</td></tr>
          <tr><td style="text-align: right;">Tujuan : </td><td>'.$nmtujuan.' '.$layanan.'</td></tr>
          <tr><td style="text-align: right;">Keperluan : </td><td>'.$keperluan.'</td></tr>
          <tr style="text-align: center;"><td colspan="5">--------------------------------------------------------------------------------</td></tr>
          <tr style="text-align: center;"><td colspan="5">Scan kode QR berikut ketika sampai di BPS Provinsi Jawa Timur <br><img src="https://quickchart.io/qr?size=400x400&text=' . base_url() . 'qr/new/' . $qr_code . '"></td></tr>
        </table>';

        $this->load->library('email');
        $from_email = 'ipds3500@bps.go.id';
        $config['protocol'] = 'smtp';
        //$config['smtp_host'] = 'ssl://mail.bps.go.id';
         $config['smtp_host'] = 'ssl://smtp.bps.go.id';
        $config['smtp_user'] = $from_email;
        $config['smtp_pass'] = 'Jatimbangkit@3500X';
        $config['smtp_port'] = '465';
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from($from_email, 'Reservasi Antrian Tamu BPS Jawa Timur');
        $this->email->to($email);
        $this->email->subject('Tiket Reservasi dan QR Code Antrian Tamu BPS Jawa Timur');
        $this->email->message($pesan);

        if($this->email->send()){
            $this->session->set_flashdata('notif', 'swal("Berhasil","Reservasi antrian berhasil. Silahkan cek tiket di inbox email atau folder spam jika tidak ditemukan.","success")');
            redirect(base_url());
        } else {
            $print_error = $this->email->print_debugger(array(''));
            
            //print $print_error;
            
            //tampilkan view tiket
            //$this->db->where(array('qr_code' => $qr_code));
            //$cek = $this->db->get('reservasi')->row_array();
            //if (is_null($cek)) {
            //    redirect(base_url('qr'));
            //} else {
            //    $data = array('det' => $cek, 'from' => 'reservation');
            //    $this->load->view('qr/tiket', $data);
            //}
            
            //***update code 12 Juli 2022***
            //tampilkan view tiket
            $this->db->where(array('qr_code' => $qr_code));
            $cek = $this->db->get('reservasi')->row_array();
            if (is_null($cek)) {
                redirect(base_url('qr'));
            } else {
                // cetak pdf 
                $nmfile = 'Ticket-'.date('dmy', strtotime($cek['tanggal'])).'-'.$cek['kode'];
                $nmdir = 'assets/file_tmp/tiket/';
                if( is_dir($nmdir) === true ) { $this->m_model->deleteDir($nmdir); }
                if( is_dir($nmdir) === false ) { mkdir($nmdir, 0777, true); }

                $this->load->library('pdfgenerator');
                $filename = $nmfile;
                $dirname = $nmdir;
                $paper = 'A4';
                $orientation = "portrait";
                $html = $pesan;
                
                // run dompdf
                $this->pdfgenerator->generate($html,$dirname.$filename,$paper,$orientation,false);
                // redirect(base_url($nmdir.$nmfile.'.pdf'));

                $data = array('det' => $cek, 'from' => 'reservation', 'pdf' => $nmdir.$nmfile.'.pdf');
                $this->load->view('qr/tiket', $data);
            }
        }
        
    }

}
