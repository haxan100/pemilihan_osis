<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Register extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('CalonModel');
        $this->load->model('SiswaModel');

    }
    public function index()
    {
        $obj['judul'] = "Data Calon";
        $dataProdi = $this->ConfigModel->getData('prodi');
		$obj['prodi'] = $dataProdi;
        // $obj['data'] = $this->CalonModel->ListUserCalon()->result();
        $obj['ci'] = $this;
        $this->load->view('User/Register', $obj);
    }
    public function process()
    {			
				// NIM, Nama, Angkatan, Prodi, Foto KTM, Foto diri🙏
        $nim = $this->input->post('nim');
        $nama = $this->input->post('nama');
        $angkatan = $this->input->post('angkatan');
        $prodi = $this->input->post('prodi');
        $nim_cek = $this->ConfigModel->getDataWhereFromTable('siswa', '*', ['nim' => $nim]);
        $nim_db_mhs = $this->ConfigModel->getDataWhereFromTable('mahasiswa', '*', ['nim' => $nim]);		
        if (count($nim_db_mhs) <1) {
			$this->res([], "Nim Tidak Ada Di Table Mahasiswa!", 401);die();
        }
        if (count($nim_cek) > 0) {
            $this->res([], "Nim Sudah Pernah Ada!", 401);die();
        }
        if (empty($nim) || empty($nama) || empty($angkatan) || empty($prodi)) {
            $this->res([], "Mohon Isi Data Dengan Lengkap!", 401);die;
        }
        $data = array(
            'nim' => $nim,
            'nama' => $nama,
            'angkatan' => $angkatan,
            'prodi' => $prodi,
            'password' => $this->bizEncrypt($nim),
        );
        $nama_file  = $nama ;
        if ($_FILES['foto_ktm']['name'] != null) {
            $config['upload_path'] = './images/ktm';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2000 *7000;
            $config['max_width'] = 1500 *7000;
            $config['max_height'] = 1500 *7000;
            $foto_ext = pathinfo($_FILES["foto_ktm"]["name"], PATHINFO_EXTENSION);
            $config['file_name'] = 'cover' . $this->generateRandomString() . '.' . $foto_ext;
            $configClone['file_name'] = $config['file_name'];
            $configClone['allowed_types'] = $config['allowed_types'];
            $configClone['upload_path'] = './images/ktm';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto_ktm')) {
                $errorS = array('error' => $this->upload->display_errors());
                $this->res(null, $errorS['error'], 401);
                die;
            } else {
                $data += array(
                    'foto_ktm' => $configClone['file_name'],
                );
            }
        } else {
            $this->res(null, "Mohon Upload Foto KTM!", 401);
            die;
        }
        if ($_FILES['foto_diri']['name'] != null) {
            $config['upload_path'] = './images/mahasiswa';
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size'] = 2000 *7000;
            $config['max_width'] = 1500 *7000;
            $config['max_height'] = 1500 *7000;
            $foto_ext = pathinfo($_FILES["foto_diri"]["name"], PATHINFO_EXTENSION);
            $config['file_name'] = 'cover' . $this->generateRandomString() . '.' . $foto_ext;
            $configClone['file_name'] = $config['file_name'];
            $configClone['allowed_types'] = $config['allowed_types'];
            $configClone['upload_path'] = './images/mahasiswa';
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('foto_ktm')) {
                $errorS = array('error' => $this->upload->display_errors());
                $this->res(null, $errorS['error'], 401);
                die;
            } else {
                $data += array(
                    'foto_diri' => $configClone['file_name'],
                );
            }
        } else {
            $this->res(null, "Mohon Upload Foto Diri!", 401);
            die;
					}
				if($id = $this->ConfigModel->insertData($data,'siswa')){						
						$this->res(null, "Berhasil Registrasi !", 200);
						
						$session = array(
							'admin_session' => false,
							'id_siswa' => $id,
							'nim' => $nim,
							'nama' => $nama,
							'sudah_milih' => 0,
					);

					$this->session->set_userdata($session); // Buat session sesuai $session
					$status = true;


						die;

				}
    }

}

/* End of file  Login.php */
