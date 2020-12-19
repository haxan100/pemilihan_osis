<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Cart extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CalonModel');
		$this->load->model('SiswaModel');
		$this->load->model('AdminModel');
	}	

	public function index()
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
			$this->load->view('user/cart', $obj);
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
			$this->load->view('user/cart', $obj);
			$this->load->view('templating/footer');
		}
	}
	public function isLoginUser()
	{
		// var_dump($this->session->userdata());die;
		if ($this->session->userdata('id_siswa'))
			return true; // sudah login
		else
			return false; // belum login
	}
	function cekLoginAdmin()
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
        
}
        
    /* End of file  Cart.php */
        
                            