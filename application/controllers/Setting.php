<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Setting extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('SiswaModel');
		$this->load->model('CalonModel');
		$this->load->model('AdminModel');
	}	

public function index()
{
		$this->cekLoginAdmin();
		// $obj['data'] = $this->SiswaModel->getAllSiswa();
		// var_dump($_SESSION);die;
		$obj['judul'] = "Setting";
		$id = $this->session->userdata('id_admin');
		$getUserByID = $this->AdminModel->getAdminById($id)[0];
		$obs['data'] = $getUserByID;
		$this->load->view('templating/header');
		$this->load->view('templating/sidebar', $obs);
		$this->load->view('admin/setting', $obj);
		$this->load->view('templating/footer');


}
	public function isLoggedInAdmin()
	{
		// Cek apakah terdapat session "admin_session"

		if ($this->session->userdata('admin_session'))
			return true; // sudah login
		else
			return false; // belum login
	}
	function cekLoginAdmin()
	{
		if (!$this->isLoggedInAdmin()) {
			$this->session->set_flashdata(
				'notifikasi',
				array(
					'alert' => 'alert-danger',
					'message' => 'Silahkan Login terlebih dahulu.',
				)
			);
			redirect('admin/login');
		}
	}
	public function Setting()
	{
		$mulai= $this->input->post('mulai');
		$akhir= $this->input->post('akhir');
		$m =str_replace('T', " ", $mulai);
		$a = str_replace('T', " ", $akhir);
		$in = array(
			'mulai' => $m,
			'akhir' => $a,
		);

		if($this->AdminModel->edit_waktu($in, 1)){
			$message = "Berhasil Mengedit Data ";
			$status = true;
		}else{
			$message = "Gagal Mengedit ";
			$status = false;
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));

	}
        
}
        
    /* End of file  Setting.php */
        
                            