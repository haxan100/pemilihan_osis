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
	public function cart_dpm($prodi=1)
	{
		$obj['judul'] = "Data Calon";

		$obs['admin'] = false;
		$obs['login'] = false;
		$obj['data'] = $this->CalonModel->ListUserCalon('bem')->result_array();
		$obs['prodi'] = $prodi;
		
		$obj['judul'] = "Hasil Quick Count";
		$obj['data'] = $this->CalonModel->ListUserCalonDPM($prodi)->result_array();
		// var_dump( $obj['data']);die;
		$obj['graph'] = $this->CalonModel->GetPieDPM($prodi);

		$this->load->view('templating/header');
		$this->load->view('templating/sidebar', $obs);
		$this->load->view('User/cart_dpm', $obj);
		$this->load->view('templating/footer');
	}
        
}
        
    /* End of file  Cart.php */
        
                            