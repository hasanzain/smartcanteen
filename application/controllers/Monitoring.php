<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

class Monitoring extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('username') == '') {
            redirect('auth');
        }
    }

    public function index()
    {
        $nama = $this->input->post('nama');
        $tanggal = $this->input->post('tanggal');

        if ($nama != null) {
            $this->db->where('nama', $nama);
        }

        if ($tanggal != null) {
            $this->db->where('tanggal', $tanggal);
        }
        // else{
        //     $this->db->where('tanggal', date("Y-m-d"));
        // }

        if ($tanggal != null && $nama != null) {
            $this->db->limit(50);
        }
        $this->db->distinct('nama');


        $this->db->order_by('id', "DESC");
        $data = array(
            'riwayat_makan' => $this->db->get('riwayat_makan'),
            'tanggal' => $tanggal
        );

        $this->load->view('header/header');
        $this->load->view('v_monitoring', $data);
        $this->load->view('header/footer');
    }

    public function riwayat()
    {
        $nama = $this->input->post('nama');
        $tanggal = $this->input->post('tanggal');

        if ($nama != null) {
            $this->db->where('nama', $nama);
        }

        if ($tanggal != null) {
            $this->db->where('tanggal', $tanggal);
        } else {
            $this->db->where('tanggal', date("Y-m-d"));
        }

        if ($tanggal != null && $nama != null) {
            $this->db->limit(50);
        }
        $this->db->distinct('nama');


        $this->db->order_by('id', "DESC");
        $data = array(
            'absensi' => $this->db->get('login_record'),
            'tanggal' => $tanggal
        );

        $this->load->view('header/header');
        $this->load->view('v_riwayat_absen', $data);
        $this->load->view('header/footer');
    }


    public function export_csv()
    {
        $nama = $this->input->post('nama');
        $tanggal = $this->input->post('tanggal');

        if ($nama != null) {
            $this->db->where('nama', $nama);
        }

        if ($tanggal != null) {
            $this->db->where('tanggal', $tanggal);
        }

        $file_name = 'Riwayat Akses_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/csv;");

        // get data 
        $data = $this->db->get('login_record');

        // file creation 
        $file = fopen('php://output', 'w');

        $header = array("No", "Nama", "Pangkat", "Foto Masuk", "Tanggal");
        fputcsv($file, $header);
        foreach ($data->result_array() as $key => $value) {
            fputcsv($file, $value);
        }
        fclose($file);
        exit;
    }

    public function viewImage()
    {
        $lokasi = $this->input->get('lokasi');
        $data = array(
            'lokasi' => $lokasi
        );

        $this->load->view('header/header');
        $this->load->view('v_view_image', $data);
        $this->load->view('header/footer');
    }

    public function karyawan()
    {
        $this->db->limit(10);
        $data = array(
            'karyawan' => $this->db->get('karyawan')
        );

        $this->load->view('header/header');
        $this->load->view('v_karyawan', $data);
        $this->load->view('header/footer');
    }


    public function update_karyawan()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $this->db->limit(10);
        $data = array(
            'karyawan' => $this->db->get('karyawan')
        );

        $this->load->view('header/header');
        $this->load->view('v_update_karyawan', $data);
        $this->load->view('header/footer');
    }

    public function update_karyawan_()
    {
        $id = $this->input->post('id');
        $data = array(
            'nama' => htmlspecialchars($this->input->post('nama')),
            'email' => $this->input->post('email')
        );

        $this->db->where('id', $id);

        if ($this->db->update('karyawan', $data)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Karyawan berhasil diperbarui</div>');
            redirect('monitoring/karyawan');
        } else {
            echo "error";
        }
    }

    public function update_status()
    {
        $id = $this->input->get('id');
        $status = null;

        $this->db->where('id', $id);
        $karyawan = $this->db->get('karyawan');

        foreach ($karyawan->result_array() as $row) {
            $status = $row['status'];
        }

        if ($status == "0") {
            $data = array(
                'status' => "1",
            );
        } else {
            $data = array(
                'status' => "0",
            );
        }
        $this->db->where('id', $id);

        if ($this->db->update('karyawan', $data)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Status berhasil diperbarui</div>');
            redirect('monitoring/karyawan');
        } else {
            echo "error";
        }
    }

    public function jamMakan()
    {
        $data = array(
            'jam_makan' => $this->db->get('jam_makan')
        );

        $this->load->view('header/header');
        $this->load->view('v_jam_makan', $data);
        $this->load->view('header/footer');
    }

    public function update_jamMakan()
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);
        $data = array(
            'jam_makan' => $this->db->get('jam_makan')
        );

        $this->load->view('header/header');
        $this->load->view('v_update_jam_makan', $data);
        $this->load->view('header/footer');
    }

    public function update_JamMakan_()
    {
        $id = $this->input->post('id');
        $jam = $this->input->post('jam');


        $data = [
            'jam' => $jam,
        ];

        $this->db->where('id', $id);
        $this->db->update('jam_makan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Jam Makan Berhasil Diperbarui</div>');
        redirect('monitoring/jamMakan');
    }



    public function addKaryawan()
    {

        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('pangkat', 'pangkat', 'trim|required');
        $this->form_validation->set_rules('fingerID', 'fingerID', 'trim|required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header/header');
            $this->load->view('v_addKaryawan');
            $this->load->view('header/footer');
        } else {
            $data = array(
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'pangkat' => htmlspecialchars($this->input->post('pangkat', true)),
                'finger_location' => htmlspecialchars($this->input->post('fingerID', true)),
            );
            if ($this->db->insert('user_fingerprint', $data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User berhasil ditambahkan</div>');
                redirect('monitoring/adduser');
            } else {
                echo "error";
            }
        }
    }



    public function delete_user($id = NULL)
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);

        if ($this->db->delete('user_fingerprint')) {
            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
            redirect('monitoring/user_list');
        } else {
            // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal dihapus</div>');
            redirect('monitoring/user_list');
        }
    }
}
