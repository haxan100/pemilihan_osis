<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CalonModel');
        $this->load->model('SiswaModel');
        $this->load->model('AdminModel');
    }
		// bem = semua murid
		// dpm = perprodi

    public function index()
    {
        $wak = $this->AdminModel->getWaktuSetting()->row();
        $now = date('Y-m-d H:m:s');

        if ($now <= $wak->mulai) {
            $this->session->set_flashdata(
                'notifikasi',
                array(
                    'alert' => 'alert-danger',
                    'message' => 'Maaf, Waktu Memilih Belum Di Mulai',
                )
            );
        } else if ($now >= $wak->akhir) {
            $this->session->set_flashdata(
                'notifikasi',
                array(
                    'alert' => 'alert-danger',
                    'message' => 'Maaf, Waktu Memilih Sudah Terlewatkan',
                )
            );
        }
        // var_dump(date('Y-m-d H:m:s')<=$wak->akhir ,
        //                  date('Y-m-d H:m:s') ,$wak->akhir);die;

        $this->cekLoginAdmin();
        // if($this->isLoginUser()){
        $id = $this->session->userdata('id_siswa');
        $obs['login'] = true;
        $obs['admin'] = false;

        if ($this->getIsUserHasChose($id)) {
            $this->session->set_flashdata(
                'notifikasi',
                array(
                    'alert' => 'alert-danger',
                    'message' => 'Maaf, Anda Sudah Memilih Calon',
                )
            );
            $getUserByID = $this->SiswaModel->getSiswaById($id)[0];
            $obs['data'] = $getUserByID;

            $obj['judul'] = "Data Calon";

            $obj['data'] = $this->CalonModel->ListUserCalon()->result();
            // var_dump($data);die;
            $this->load->view('templating/header');
            $this->load->view('templating/sidebar', $obs);
            $this->load->view('User/pilih', $obj);
            $this->load->view('templating/footer');

        } else {

            $getUserByID = $this->SiswaModel->getSiswaById($id)[0];
            $obs['data'] = $getUserByID;

            $obj['judul'] = "Data Calon";

            $obj['data'] = $this->CalonModel->ListUserCalon("bem")->result();
            // var_dump($data);die;
            $this->load->view('templating/header');
            $this->load->view('templating/sidebar', $obs);
            $this->load->view('User/pilih', $obj);
            $this->load->view('templating/footer');
        }

    }
    public function bem()
    {
        $wak = $this->AdminModel->getWaktuSetting()->row();
        $now = date('Y-m-d H:m:s');

        if ($now <= $wak->mulai) {
            $this->session->set_flashdata(
                'notifikasi',
                array(
                    'alert' => 'alert-danger',
                    'message' => 'Maaf, Waktu Memilih Belum Di Mulai',
                )
            );
        } else if ($now >= $wak->akhir) {
            $this->session->set_flashdata(
                'notifikasi',
                array(
                    'alert' => 'alert-danger',
                    'message' => 'Maaf, Waktu Memilih Sudah Terlewatkan',
                )
            );
        }
        // var_dump(date('Y-m-d H:m:s')<=$wak->akhir ,
        //                  date('Y-m-d H:m:s') ,$wak->akhir);die;

        $this->cekLoginAdmin();
        // if($this->isLoginUser()){
        $id = $this->session->userdata('id_siswa');
        $obs['login'] = true;
        $obs['admin'] = false;

        if ($this->getIsUserHasChose($id)) {
            $this->session->set_flashdata(
                'notifikasi',
                array(
                    'alert' => 'alert-danger',
                    'message' => 'Maaf, Anda Sudah Memilih Calon',
                )
            );
            $getUserByID = $this->SiswaModel->getSiswaById($id)[0];
            $obs['data'] = $getUserByID;

            $obj['judul'] = "Data Calon";

            $obj['data'] = $this->CalonModel->ListUserCalon()->result();
            // var_dump($data);die;
            $this->load->view('templating/header');
            $this->load->view('templating/sidebar', $obs);
            $this->load->view('User/pilih', $obj);
            $this->load->view('templating/footer');

        } else {

            $getUserByID = $this->SiswaModel->getSiswaById($id)[0];
            $obs['data'] = $getUserByID;

            $obj['judul'] = "Data Calon";

            $obj['data'] = $this->CalonModel->ListUserCalon()->result();
            // var_dump($data);die;
            $this->load->view('templating/header');
            $this->load->view('templating/sidebar', $obs);
            $this->load->view('User/pilih', $obj);
            $this->load->view('templating/footer');
        }

    }
    public function getIsUserHasChose($id)
    {
        $data = $this->SiswaModel->getIsUserHasChose($id)[0]->sudah_milih_bem;
        if ($data == 1) {
            return true; // sudah Milih
        } else {
            return false; // belum Milih
        }
    }
    public function pilih()
    {

        $this->cekLoginAdmin();
        $pesan = " gagal memilih";
        $status = false;

        $id_calon = $this->input->post('pilih');

        $id = $this->session->userdata('id_siswa');

        if ($this->getIsUserHasChose($id)) {
            $pesan = " Maaf, Anda Sudah Memilih Calon";
            $status = false;
        } else {
            $getUserByID = $this->SiswaModel->getSiswaById($id)[0];
            $obs['data'] = $getUserByID;
            $getJumlama = $this->CalonModel->getCalonByID($id_calon)->result()[0]->total;
            $total = $getJumlama + 1;
            // var_dump(date("Y-m-d h:i:s"));die;

            $inSiswa = array(
                'pilih' => $id_calon,
                'sudah_milih' => 1,
                'waktu_milih' => date("Y-m-d h:i:s"),
            );
            $inCalon = array(
                'id_calon' => $id_calon,
                'total' => $total,
                // 'siswa' => $id_siswa,
            );
            if ($this->CalonModel->edit_calon($inCalon, $id_calon)) {

                $this->SiswaModel->edit_siswa($inSiswa, $getUserByID->id_siswa);
                $pesan = " berhasil memilih";
                $status = true;
            }
        }

        echo json_encode(array(
            'status' => $status,
            'message' => $pesan,
        ));

        # code...
    }
    public function cart()
    {

        // $this->cekLoginAdmin();
        if ($this->isLoginUser()) {
            $obs['login'] = true;
            $obs['admin'] = false;

            $id = $this->session->userdata('id_siswa');
            $getUserByID = $this->SiswaModel->getSiswaById($id)[0];
            $obs['data'] = $getUserByID;

            $obj['judul'] = "Hasil Quick Count";
            $obj['data'] = $this->CalonModel->ListUserCalon()->result_array();
            $obj['graph'] = $this->CalonModel->GetPie();
            // var_dump($obj['data']);die;
            $this->load->view('templating/header');
            // $this->load->view('templating/sidebar');

            $this->load->view('templating/sidebar', $obs);
            $this->load->view('User/cart', $obj);
            $this->load->view('templating/footer');
        } else {

            $obs['admin'] = false;
            $obs['login'] = false;
            $obj['judul'] = "Hasil Quick Count";
            $obj['data'] = $this->CalonModel->ListUserCalon()->result_array();
            $obj['graph'] = $this->CalonModel->GetPie();
            // var_dump($obj['data']);die;
            $this->load->view('templating/header');
            // $this->load->view('templating/sidebar');

            $this->load->view('templating/sidebar', $obs);
            $this->load->view('User/cart', $obj);
            $this->load->view('templating/footer');
        }
    }
    public function profile()
    {
        $id = $this->session->userdata('id_siswa');
        $this->cekLoginAdmin();
        $obs['admin'] = false;
        $obs['login'] = true;

        if ($this->getIsUserHasChose($id)) {
            $dataCalon = $this->SiswaModel->getIsUserHasChoseAndCalon($id)[0];
            $obj['calon'] = $dataCalon;
            $obj['statcalon'] = true;
            $getUserByID = $this->SiswaModel->getSiswaById($id)[0];
            $obs['data'] = $getUserByID;
            $obj['judul'] = "Profile";
            $obj['graph'] = $this->CalonModel->GetPie();
            $id = $_SESSION['id_siswa'];
            $getUser = $this->SiswaModel->getSiswaByIdSiswa($id);
            $obj['data'] = $getUser->row();

            $this->load->view('templating/header');
            $this->load->view('templating/sidebar', $obs);
            $this->load->view('User/profile', $obj);
            $this->load->view('templating/footer');

        } else {
            $obj['calon'] = "Belum Memilih";
            $obj['statcalon'] = false;

            $getUserByID = $this->SiswaModel->getSiswaById($id)[0];
            $obs['data'] = $getUserByID;

            $obj['judul'] = "Profile";
            // $obj['graph'] = $this->CalonModel->GetPie();
            $id = $_SESSION['id_siswa'];
            $getUser = $this->SiswaModel->getSiswaByIdSiswa($id);
            $obj['data'] = $getUser->row();
            // var_dump($r);die;

            $this->load->view('templating/header');
            $this->load->view('templating/sidebar', $obs);
            $this->load->view('User/profile', $obj);
            $this->load->view('templating/footer');

        }
        // if($this->isLoginUser()){

        # code...
    }
    public function isLoginUser()
    {
        // var_dump($this->session->userdata());die;
        if ($this->session->userdata('id_siswa')) {
            return true;
        }
        // sudah login
        else {
            return false;
        }
        // belum login
    }
    public function cekLoginAdmin()
    {
        if (!$this->isLoginUser()) {
            $this->session->set_flashdata(
                'notifikasi',
                array(
                    'alert' => 'alert-danger',
                    'message' => 'Silahkan Login terlebih dahulu.',
                )
            );
            redirect('login');
        }
    }
    public function ubah_siswa_proses()
	{
		// var_dump($_POST);die;
		$id_siswa = $this->input->post('id_siswa', TRUE);
		$nama = $this->input->post('nama', TRUE);
        
		$message = 'Gagal mengedit data siswa!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(
			'nama' => $nama,
		);
		if (empty($nama)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi Nama');
		}
    
		if ($status) {
			$this->SiswaModel->edit_siswa($in, $id_siswa);
			$message = "Berhasil Mengedit Data ";
			 $status = true;



		} else {
			$message = "Gagal Mengubah Siswa #1";
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}

}

/* End of file  User.php */
