<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antrian extends CI_Controller {

    public function data() {
        // Handle CORS
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");

        // Tangani request preflight OPTIONS
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }

        $today = date('Y-m-d');
        $this->db->where('tanggal', $today);
        $this->db->where('tujuan', 1);
        $this->db->where('progres !=', 4);
        $this->db->order_by('id', 'DESC');
        $data = $this->db->get('an_reservasi')->result();

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}