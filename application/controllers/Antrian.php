<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antrian extends CI_Controller {

    // username petugas (an_users.username) => label loket di layar
    private $loket = array(
        'loket1'       => 'Loket 1',
        'loket2'       => 'Loket 2',
        'loket3'       => 'Loket 3',
        'loketdifabel' => 'Loket Disabilitas',
    );

    // Halaman display antrian: /antrian
    public function index() {
        $this->load->view('antrian/index', array('loket' => $this->loket));
    }

    // Data untuk display: /antrian/status
    public function status() {
        $today = date('Y-m-d');
        $loket = array();

        foreach ($this->loket as $username => $label) {
            $this->db->select('id, kode, nama, layanan, last_update');
            $this->db->where('tanggal', $today);
            $this->db->where('tujuan', 1);
            $this->db->where('progres', 3);
            $this->db->where('process_by', $username);
            $this->db->order_by('last_update DESC, id DESC');
            $this->db->limit(1);
            $row = $this->db->get('reservasi')->row_array();

            $loket[] = array(
                'id'      => $username,
                'label'   => $label,
                'current' => $row ? array(
                    'id'          => (int) $row['id'],
                    'kode'        => $row['kode'],
                    'nama'        => $row['nama'],
                    'layanan'     => $row['layanan'],
                    'last_update' => $row['last_update'],
                ) : null,
            );
        }

        $this->db->select('id, kode, nama, layanan');
        $this->db->where('tanggal', $today);
        $this->db->where('tujuan', 1);
        $this->db->where('progres', 2);
        $this->db->order_by('last_update ASC, id ASC');
        $tunggu = $this->db->get('reservasi')->result_array();

        $this->output
            ->set_header('Cache-Control: no-store')
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'tanggal' => $today,
                'loket'   => $loket,
                'tunggu'  => $tunggu,
            )));
    }

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