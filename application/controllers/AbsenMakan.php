<?php
defined('BASEPATH') or exit('No direct script allowed');
date_default_timezone_set("Asia/Jakarta");

/*----------------------------------------REQUIRE THIS PLUGIN----------------------------------------*/
require APPPATH . '/libraries/REST_Controller.php';
//use Restserver\Libraries\REST_Controller;

class AbsenMakan extends REST_Controller
{
    /*----------------------------------------CONSTRUCTOR----------------------------------------*/
    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    function getTime($part, $param)
    {
        $this->db->where('keterangan', $param);
        $jam = "";

        $jamMakan = $this->db->get('jam_makan');

        foreach ($jamMakan->result_array() as $row) {
            $jam = $row['jam'];
        }
        $waktu = explode(":", $jam);

        if ($part == "jam") {
            return (int)$waktu[0];
        } else {
            return (int)$waktu[1];
        }
    }


    function cekMakan($id_karyawan, $query, $limit)
    {
        // $id = 12345678;
        $this->db->where('id_karyawan', $id_karyawan);
        $this->db->where('tanggal', date("Y-m-d"));
        $riwayat_makan = $this->db->get('riwayat_makan')->result_array();
        // return count($riwayat_makan);

        if ($query == "<=") {
            $param = count($riwayat_makan) <= $limit;
        } else {
            $param = count($riwayat_makan) < $limit;
        }

        if ($param) {
            return true;
        } else {
            return false;
        }
    }

    function ambilMakan($id, $keterangan)
    {
        $id_karyawan = "";
        $status = "";

        $this->db->where('id_karyawan', $id);
        $karyawan = $this->db->get('karyawan');

        if ($karyawan) {

            foreach ($karyawan->result_array() as $row) {
                $id_karyawan = $row['id_karyawan'];
                $status = $row['status'];
                $nama = $row['nama'];
            }
            if ($status == "1") {

                $data = array(
                    'id_karyawan' => $id_karyawan,
                    'nama' => $nama,
                    'tanggal' => date("Y-m-d"),
                    'jam' => date("H:i:s"),
                    'keterangan' => $keterangan,
                );

                if ($this->db->insert('riwayat_makan', $data)) {
                    $this->response(array('Status' => 'SILAHKAN AMBIL'), 200);
                } else {
                    $this->response(array('Status' => 'Data Gagal Dimasukan'), 200);
                }
            } else {
                $this->response(array('Status' => 'AKUN ANDA TERKUNCI'), 200);
            }
        } else {
            $this->response(array('Status' => 'KARYAWAN TIDAK TERDAFTAR'), 200);
        }
    }

    /*----------------------------------------GET KONTAK----------------------------------------*/
    function index_get()
    {
        $id = $this->get('idKaryawan');

        $mydate = getdate(date("U"));
        $jam = (int) $mydate["hours"];
        $menit = (int) $mydate["minutes"];

        // $jam = 7;
        // $menit = 59;


        if ($jam >= $this->getTime("jam", "pagi") && $jam < $this->getTime("jam", "siang")) {
            if ($menit >= $this->getTime("menit", "pagi")) {
                if ($this->cekMakan(12345678, "<", 1)) {
                    $this->ambilMakan($id, "pagi");
                } else {
                    $this->response(array('Status' => 'SUDAH MAKAN!'), 200);
                }
            }
        } elseif ($jam >= $this->getTime("jam", "siang") && $jam < $this->getTime("jam", "sore")) {
            if ($menit >= $this->getTime("menit", "siang")) {
                if ($this->cekMakan(12345678, "<=", 2)) {
                    $this->ambilMakan($id, "siang");
                } else {
                    $this->response(array('Status' => 'SUDAH MAKAN!'), 200);
                }
            }
        } elseif ($jam >= $this->getTime("jam", "sore") && $jam < 17) {
            if ($menit >= $this->getTime("menit", "sore")) {
                if ($this->cekMakan(12345678, "<", 3)) {
                    $this->ambilMakan($id, "sore");
                } else {
                    $this->response(array('Status' => 'SUDAH MAKAN!'), 502);
                }
            }
        } else {
            $this->response(array('Status' => 'DILUAR JAM MAKAN!'), 502);
        }
    }

    function index_post()
    {

        // $id = $this->post('idKaryawan');

        // $this->db->where('id_karyawan', $id);
        // $karyawan = $this->db->get('karyawan');

        // foreach ($karyawan->result_array() as $key) {
        //     $id_karyawan = $key['id_karyawan']
        // }
        // var_dump($id_karyawan);
        // die;

        // $this->response($data, 200);

        // $data = array(
        //     'nama_relay'    =>   $this->post('nama_relay'),
        //     'nilai' => $nilai,
        //     'button' => $button,
        //     'status' => $status,
        // );
        // $insert = $this->db->insert('relay', $data);
        // if ($insert) {
        //     $this->response($data, 200);
        // } else {
        //     $this->response(array('status' => 'fail', 502));
        // }
    }

    // function index_put()
    // {
    //     $nama_relay = $this->put('nama_relay');
    //     $nilai = $this->put('nilai');

    //     if ($nilai != null){
    //         if ($nilai == 1) {
    //             $data['status'] = "ON";
    //             $data['button'] = "succes";
    //             $data['nilai'] = $nilai;
    //         }else{
    //             $data['status'] = "OFF";
    //             $data['button'] = "danger";
    //             $data['nilai'] = $nilai;
    //         }
    //     }

    //     $this->db->where('nama_relay', $nama_relay);
    //     $update = $this->db->update('relay', $data);

    //     if ($update) {
    //         $this->response($data, 200);
    //     } else {
    //         $this->response(array('status' => 'fail'), 502);
    //     }
    // }

    // function index_delete()
    // {
    //     $id = $this->delete('id');
    //     $auth = $this->delete('auth');


    //     if ($auth == "batman") {
    //         $delete = $this->db->empty_table('relay');
    //     }else{
    //         $this->db->where('id', $id);
    //         $delete = $this->db->delete('arus_pompa_1');
    //     }
    //     if ($delete) {
    //         $this->response(array('status' => 'success'), 201);
    //     } else {
    //         $this->response(array('status' => 'fail'), 502);
    //     }
    // }
}
