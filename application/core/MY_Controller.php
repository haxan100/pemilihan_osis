<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ConfigModel');

    }

    public function namaAplikasi()
    {
        return 'I Print';
    }
    public function dateNow($no = 0)
    {
        if ($no == 0) {
            return date('d-m-Y H:i:s');
        } else {
            return date('d-m-Y');
        }
    }
    public function res($data = [], $m = null, $code = 401)
    {
        $status = false;
        if ($code == 200 || $code == '200') {
            $status = true;
        }
        $res = array(
            'message' => $m,
            'code' => $code,
            'status' => $status,
            'data' => $data,
        );
        echo json_encode($res);
    }
    public function cekLoginAdmin()
    {
        if (!isset($_SESSION["admin_session"]) || $_SESSION["admin_session"] == false) {
            header("location:login");
            exit();
        }
    }
    public function logoutAdmin()
    {
        session_destroy();
        // if(session_destroy()){
        //     header("location:login");
        //     exit();
        // }
    }
    public function cekGoogleToken($access_token = null)
    {
        // $access_token = 'ya29.A0ARrdaM8eWVeRJEV91e362swXa15G92vki1ZjQMFgIE3xtXnYYmUu5g4pBn-nf32YGoIs5LnElbk4lj6zZu55jo7If7oJQdD9dxZpRV3JEgNLto42j8ewSJIpbAqvmJtHmcvpxPkX8WIt8dcrZMYcpt55EOAcWA';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.googleapis.com/oauth2/v2/tokeninfo?accessToken=' . $access_token,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $manage = json_decode($response, true);
        // var_dump(json_decode($response)->error_description);die;
        return $manage;

        $res = array(
            'message' => '$data->error_description',
            'status' => false,
            'data' => 's',
            'email' => '',
        );
        echo json_encode($res);die;

    }
    public function siCepatCode()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://order.ayosukses.net/upload/sicepatdestination.txt',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $manage = json_decode($response, true);
        return $manage['sicepat']['results'];
        echo $response;
        # code...
        # code...
    }
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function generateRandomNumbers($length = 10)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function pembulatan($uang)
    {
        $ratusan = substr($uang, -3);
        if ($ratusan < 500) {
            $akhir = $uang - $ratusan;
        } else {
            $akhir = $uang + (1000 - $ratusan);
        }

        return number_format($akhir, 2, ',', '.');
    }
    public function rupiah($angka)
    {

        $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;

    }
    public function passwordMatch($plain_password, $encrypted)
    {

        return $plain_password == $this->bizDecrypt($encrypted);
    }

    public function bizDecrypt($enc)
    {

        $dec64 = base64_decode($enc);

        $substr1 = substr($dec64, 12, strlen($dec64) - 12);

        $substr2 = substr($substr1, 0, strlen($substr1) - 6);

        $dec = base64_decode(base64_decode($substr2));

        return $dec;
    }
    public function bizEncrypt($plaintext)
    {

        $tahun = date('Y');

        $bulan = date('m');

        $hari = date('d');

        $jam = date('H');

        $menit = date('i');

        $detik = date('s');

        $pool = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_+&';

        $word1 = '';

        for ($i = 0; $i < 4; $i++) {

            $word1 .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
        }

        $plain = $hari . $bulan . $tahun . $word1 . base64_encode(base64_encode($plaintext)) . $detik . $menit . $jam;

        $enc = base64_encode($plain);

        return $enc;
    }

}
