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
        $idKaryawan = $this->input->post('idKaryawan');
        $keterangan = $this->input->post('keterangan');

        if ($nama != null) {
            $this->db->where('nama', $nama);
        }

        if ($tanggal != null) {
            $this->db->where('tanggal', $tanggal);
        }
        if ($idKaryawan != null) {
            $this->db->where('id_karyawan', $idKaryawan);
        }
        if ($keterangan != null) {
            $this->db->where('keterangan', $keterangan);
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


    public function export()
    {
        $this->load->view('header/header');
        $this->load->view('v_export');
        $this->load->view('header/footer');
    }

    public function export_pdf()
    {
        $nama = $this->input->post('nama');
        $tanggal = $this->input->post('tanggal');
        $idKaryawan = $this->input->post('idKaryawan');
        $keterangan = $this->input->post('keterangan');

        if ($nama != null) {
            $this->db->where('nama', $nama);
        }

        if ($tanggal != null) {
            $this->db->where('tanggal', $tanggal);
        }
        if ($idKaryawan != null) {
            $this->db->where('id_karyawan', $idKaryawan);
        }
        if ($keterangan != null) {
            $this->db->where('keterangan', $keterangan);
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
        $this->load->view('v_exportpdf', $data);
        $this->load->view('header/footer');
    }


    public function export_csv()
    {
        $nama = $this->input->post('nama');
        $tanggal = $this->input->post('tanggal');
        $idKaryawan = $this->input->post('idKaryawan');
        $keterangan = $this->input->post('keterangan');

        if ($nama != null) {
            $this->db->where('nama', $nama);
        }

        if ($tanggal != null) {
            $this->db->where('tanggal', $tanggal);
        }
        if ($idKaryawan != null) {
            $this->db->where('id_karyawan', $idKaryawan);
        }
        if ($keterangan != null) {
            $this->db->where('keterangan', $keterangan);
        }

        $file_name = 'Riwayat Makan_' . date('Ymd') . '.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Type: application/csv;");

        // get data 
        $data = $this->db->get('riwayat_makan');

        // file creation 
        $file = fopen('php://output', 'w');

        $header = array("No", "Nama", "Tanggal", "Jam", "Keterangan");
        fputcsv($file, $header);
        $no = 0;
        foreach ($data->result_array() as $key) {
            $no += 1;
            $nm = $key['nama'];
            $tgl = $key['tanggal'];
            $jam = $key['jam'];
            $ket = $key['keterangan'];
            $value = array(
                "no" => $no,
                "nama" => $nm,
                "tanggal" => $tgl,
                "jam" => $jam,
                "keterangan" => $ket,
            );
            fputcsv($file, $value);
        }
        // var_dump($value);
        // die;
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
        // $this->db->limit(10);
        $this->db->select('*');
        $this->db->from('karyawan');
        $this->db->join('departemen', 'departemen.departemen_id = karyawan.departemen_id');
        $query = $this->db->get();

        // var_dump($query);
        // die;

        $data = array(
            'karyawan' => $query
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
            'karyawan' => $this->db->get('karyawan'),
            'departemen' =>
            $this->db->get('departemen'),
        );

        $this->load->view('header/header');
        $this->load->view('v_update_karyawan', $data);
        $this->load->view('header/footer');
    }

    public function update_karyawan_()
    {
        $id = $this->input->post('id');
        $data = array(
            'nrp' => htmlspecialchars($this->input->post('nrp')),
            'nama' => htmlspecialchars($this->input->post('nama')),
            'email' => $this->input->post('email'),
            'departemen_id' => htmlspecialchars($this->input->post('departemen')),
        );

        $this->db->where('id', $id);

        if ($this->db->update('karyawan', $data)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data karyawan berhasil diperbarui</div>');
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

        $this->form_validation->set_rules('nrp', 'nrp', 'trim|required|numeric');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('idkartu', 'idkartu', 'trim|required');
        $this->form_validation->set_rules('departemen', 'departemen', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');

        $data = [
            'departemen' =>
            $this->db->get('departemen'),
        ];


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('header/header');
            $this->load->view('v_addKaryawan', $data);
            $this->load->view('header/footer');
        } else {
            $data = array(
                'nrp' => htmlspecialchars($this->input->post('nrp', true)),
                'nama' => htmlspecialchars($this->input->post('nama', true)),
                'id_karyawan' => htmlspecialchars($this->input->post('idkartu', true)),
                'departemen_id' => htmlspecialchars($this->input->post('departemen', true)),
                'email' => $this->input->post('email'),
                'status' => htmlspecialchars($this->input->post('status', true)),
            );
            if ($this->db->insert('karyawan', $data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Karyawan berhasil ditambahkan</div>');
                redirect('monitoring/Karyawan');
            } else {
                echo "error";
            }
        }
    }



    public function delete_karyawan($id = NULL)
    {
        $id = $this->input->get('id');
        $this->db->where('id', $id);

        if ($this->db->delete('karyawan')) {
            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus</div>');
            redirect('monitoring/karyawan');
        } else {
            // $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal dihapus</div>');
            redirect('monitoring/karyawan');
        }
    }
}
