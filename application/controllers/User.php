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

        if ($this->getIsUserHasChose($id,'bem')) {
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

            $obj['data'] = $this->CalonModel->ListUserCalon('bem')->result();
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

    public function pilih_bem()
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
        $this->cekLoginAdmin();
        $id = $this->session->userdata('id_siswa');
        $obs['login'] = true;
        $obs['admin'] = false;
        if ($this->getIsUserHasChose($id,'bem')) {
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

            $obj['data'] = $this->CalonModel->ListUserCalon('bem')->result();
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
    public function getIsUserHasChose($id,$type)
    {
        $u = "sudah_milih_$type";
        $data = $this->SiswaModel->getIsUserHasChose($id,$type)[0]->$u;

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
        $type = $this->input->post('type');
        $id = $this->session->userdata('id_siswa');

        if ($this->getIsUserHasChose($id,$type)) {
            $pesan = " Maaf, Anda Sudah Memilih Calon";
            $status = false;
        } else {
            $getUserByID = $this->SiswaModel->getSiswaById($id)[0];
            $obs['data'] = $getUserByID;
            $getJumlama = $this->CalonModel->getCalonByID($id_calon,$type)->result()[0]->total;
            $total = $getJumlama + 1;
            // var_dump(date("Y-m-d h:i:s"));die;

            $inSiswa = array(
                "pilih_$type" => $id_calon,
                "sudah_milih_$type" => 1,
                "waktu_pilih_$type" => date("Y-m-d h:i:s"),
            );
            $inCalon = array(
                'id_calon' => $id_calon,
                'total' => $total,
                // 'siswa' => $id_siswa,
            );
            if ($this->CalonModel->edit_calon($inCalon, $id_calon,$type)) {

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
    public function cart_bem()
    {
        if ($this->isLoginUser()) {
            $obs['login'] = true;
            $obs['admin'] = false;

            $id = $this->session->userdata('id_siswa');
            $getUserByID = $this->SiswaModel->getSiswaById($id)[0];
            $obs['data'] = $getUserByID;

            $obj['judul'] = "Hasil Quick Count";
            $obj['data'] = $this->CalonModel->ListUserCalon('bem')->result_array();
            $obj['graph'] = $this->CalonModel->GetPie('bem');
            // var_dump($obj['data']);die;
            $this->load->view('templating/header');
            $this->load->view('templating/sidebar', $obs);
            $this->load->view('User/cart_bem', $obj);
            $this->load->view('templating/footer');
        } else {

            $obs['admin'] = false;
            $obs['login'] = false;
            $obj['judul'] = "Hasil Quick Count";
            
            $obj['data'] = $this->CalonModel->ListUserCalon('bem')->result_array();
            $obj['graph'] = $this->CalonModel->GetPie('bem');
            // var_dump($obj['data']);die;
            $this->load->view('templating/header');
            // $this->load->view('templating/sidebar');

            $this->load->view('templating/sidebar', $obs);
            $this->load->view('User/cart_bem', $obj);
            
            $this->load->view('templating/footer');
        }
    }
    public function profile()
    {
        $id = $this->session->userdata('id_siswa');
        $this->cekLoginAdmin();
        $obs['admin'] = false;
        $obs['login'] = true;

        if ($this->getIsUserHasChose($id,'bem')) {
            $dataCalon = $this->SiswaModel->getIsUserHasChoseAndCalon($id)[0];
            $obj['calon'] = $dataCalon;
            $obj['statcalon'] = true;
            $getUserByID = $this->SiswaModel->getSiswaById($id)[0];
            $obs['data'] = $getUserByID;
            $obj['judul'] = "Profile";
            $obj['graph'] = $this->CalonModel->GetPie('bem');
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
    public function pilih_dpm($id=1)
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

        $this->cekLoginAdmin();
        $id = $this->session->userdata('id_siswa');
        
        $dataSiswa = $this->SiswaModel->getSiswaByIdSiswa($id)->row();
        $prodi =$dataSiswa->prodi;
        $obs['login'] = true;
        $obs['admin'] = false;
        if ($this->getIsUserHasChose($id,'dpm')) {
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

            $obj['data'] = $this->CalonModel->ListUserCalon('bem')->result();
            $this->load->view('templating/header');
            $this->load->view('templating/sidebar', $obs);
            $this->load->view('User/pilih', $obj);
            $this->load->view('templating/footer');

        } else {

            $getUserByID = $this->SiswaModel->getSiswaById($id)[0];
            $obs['data'] = $getUserByID;

            $obj['judul'] = "Data Calon";

            $obj['data'] = $this->CalonModel->ListUserCalonDPM($prodi)->result();
            $obj['prodi']  =$prodi;
            $this->load->view('templating/header');
            $this->load->view('templating/sidebar', $obs);
            $this->load->view('User/pilih_dpm', $obj);
            $this->load->view('templating/footer');
        }

    }
    public function cart_dpm($prodi=1)
    {
        if ($this->isLoginUser()) {
            $obs['login'] = true;
            $obs['admin'] = false;

            $id = $this->session->userdata('id_siswa');
            $getUserByID = $this->SiswaModel->getSiswaById($id)[0];
            $prodi =$getUserByID->prodi;
            $obs['data'] = $getUserByID;
            $obs['prodi'] = $prodi;

            $obj['judul'] = "Hasil Quick Count";
            $obj['data'] = $this->CalonModel->ListUserCalonDPM($prodi)->result_array();
            // var_dump( $obj['data']);die;
            $obj['graph'] = $this->CalonModel->GetPieDPM($prodi);
            
            $this->load->view('templating/header');
            $this->load->view('templating/sidebar', $obs);
            $this->load->view('User/cart_dpm', $obj);
            $this->load->view('templating/footer');
        } else {

            $obs['admin'] = false;
            $obs['login'] = false;
            $obj['judul'] = "Hasil Quick Count";
            
            $obj['data'] = $this->CalonModel->ListUserCalonDPM($prodi)->result_array();
            $obj['graph'] = $this->CalonModel->GetPieDPM($prodi);
            // var_dump($obj['data']);die;
            $this->load->view('templating/header');
            // $this->load->view('templating/sidebar');

            $this->load->view('templating/sidebar', $obs);
            $this->load->view('User/cart_bem', $obj);
            
            $this->load->view('templating/footer');
        }
    }

}

/* End of file  User.php */
