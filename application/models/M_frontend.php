<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_frontend extends CI_Model {

    public function get_antrian_berjalan() {
        $today = date('Y-m-d');

        $this->db->where('tujuan', 1); // ambil hanya yang layanan = 1
        $this->db->where_in('tanggal', $today); // sesuaikan dengan status yang dimaksud
        $query = $this->db->get('an_reservasi');
        
        if ($query) {
            return $query->result();
        } else {
            log_message('error', 'Query gagal: ' . $this->db->last_query());
            return [];
        }
        
    }

    
    // Ambil kode terakhir dari antrian hari ini
    public function get_last_kode_today()
    {
        $this->db->where('DATE(tanggal)', date('Y-m-d'));
        $this->db->order_by('kode', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('an_reservasi');
        return $query->row(); // hasil: object berisi property 'kode'
    }
}