<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Login extends CI_Controller {
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
	$message = 'Gagal Login <br> Mohon Isi Username dan Password dengan benar!';

	$username= $this->input->post('username');
	$password= $this->input->post('password');
	$isUser = $this->SiswaModel->GetSiswaNIS($username,$password);
	$r = $isUser->row();
	// var_dump($r);die;
	if($isUser->num_rows() == 1){
        $session = array(
            'admin_session' => false, 
            'id_siswa' => $r->id_siswa,
			'nisn' => $r->NIS, 
            'nama' => $r->nama, 
            'sudah_milih' => $r->sudah_milih, 
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
        
                            