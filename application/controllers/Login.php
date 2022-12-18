<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Login extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CalonModel');
		$this->load->model('SiswaModel');
	}	
public function index()
{
		$obj['judul'] = "Data Calon";
		// $obj['data'] = $this->CalonModel->ListUserCalon()->result();
		$obj['ci'] = $this;
		// var_dump($data);die;
		// $this->load->view('templating/header');
		// $this->load->view('templating/sidebar');
		$this->load->view('User/Login', $obj);
		// $this->load->view('templating/footer');
}
public function login_proses()
{	$status = false;
	$message = 'Gagal Login <br> Mohon Isi Nim dan Password dengan benar!';

	$username= $this->input->post('username');
	$password= $this->input->post('password');

	$isUser = $this->SiswaModel->GetSiswaUName($username);
	$r = $isUser->row();
	
	$pw = $this->passwordMatch($password,$r->password);

	if($pw){
        $session = array(
            'admin_session' => false, 
            'id_siswa' => $r->id_siswa,
						'nim' => $r->nim, 
            'nama' => $r->nama, 
            'sudah_milih_bem' => $r->sudah_milih_bem, 
            'sudah_milih_dpm' => $r->sudah_milih_dpm, 
          );

		  $this->session->set_userdata($session); // Buat session sesuai $session
			$status = true;

			$message = 'Selamat datang <span class="font-weight-bold">' . $r->nama . '</span>, sedang mengalihkan..';
	}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
}
        
}
        
    /* End of file  Login.php */
        
                            