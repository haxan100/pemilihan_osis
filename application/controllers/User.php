<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CalonModel');
	}	

public function index()
{
		$obj['judul'] = "Data Calon";
		$obj['data']= $this->CalonModel->ListUserCalon()->result();
		// var_dump($data);die;
		$this->load->view('templating/header');
		$this->load->view('templating/sidebar');
		$this->load->view('user/pilih', $obj);
		$this->load->view('templating/footer');
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
	$obj['judul'] = "Hasil Quick Count";
	$obj['data'] = $this->CalonModel->ListUserCalon()->result_array();
	$obj['graph'] = $this->CalonModel->GetPie();
	// var_dump($obj['data']);die;
	$this->load->view('templating/header');
	$this->load->view('templating/sidebar');
	$this->load->view('user/cart', $obj);
	$this->load->view('templating/footer');
}
}
        
    /* End of file  User.php */
        
                            