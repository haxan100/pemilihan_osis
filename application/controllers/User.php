<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CalonModel');
		$this->load->model('SiswaModel');
	}	

public function index()
{
		$this->cekLoginAdmin();
	// if($this->isLoginUser()){
		$id = $this->session->userdata('id_siswa');
		$getUserByID = $this->SiswaModel->getSiswaById($id)[0];
		$obs['data']= $getUserByID;

		$obj['judul'] = "Data Calon";

		$obj['data'] = $this->CalonModel->ListUserCalon()->result();
		// var_dump($data);die;
		$this->load->view('templating/header');
		$this->load->view('templating/sidebar', $obs);
		$this->load->view('user/pilih', $obj);
		$this->load->view('templating/footer');
		
}
public function getIsUserHasChose($id)
{
	$data = $this->SiswaModel->getIsUserHasChose($id);
	# code...
}
public function pilih()
{
		$pesan = " gagal memilih";
		$status = false;

	$id_calon = $this->input->post('pilih');
		// $this->session->userdata('');

		$getJumlama = $this->CalonModel->getCalonByID($id_calon)->result()[0]->total;
		$total = $getJumlama + 1;

		$inSiswa = array(
			'id_calon' => $id_calon,
			// 'siswa' => $id_siswa,
		);
		$inCalon = array(
			'id_calon' => $id_calon,
			'total' => $total,
			// 'siswa' => $id_siswa,
		);
		if($this->CalonModel->edit_calon($inCalon, $id_calon)){
			$pesan = " berhasil memilih";
			$status = true;

		}

		echo json_encode(array(
			'status' => $status,
			'message' => $pesan,
		));


	

	

	# code...
}
public function cart()
{
	$this->cekLoginAdmin();
	// if($this->isLoginUser()){
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
}
public function profile()
	{
		$this->cekLoginAdmin();
		// if($this->isLoginUser()){
		$id = $this->session->userdata('id_siswa');
		$getUserByID = $this->SiswaModel->getSiswaById($id)[0];
		$obs['data']= $getUserByID;

		$obj['judul'] = "Profile";
		$obj['graph'] = $this->CalonModel->GetPie();
		$id = $_SESSION['id_siswa'];
		$getUser = $this->SiswaModel->getSiswaByIdSiswa($id);
		$obj['data']= $getUser->row();
		// var_dump($r);die;

		$this->load->view('templating/header');
		$this->load->view('templating/sidebar', $obs);
		$this->load->view('user/profile', $obj);
		$this->load->view('templating/footer');

		# code...
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
        
    /* End of file  User.php */
        
                            