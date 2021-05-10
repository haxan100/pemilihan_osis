<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Api extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('CalonModel');
		$this->load->model('SiswaModel');
	}	
    public function login()
	{
		$status = false;
		$message = 'Gagal Login <br> Mohon Isi Username dan Password dengan benar!';

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$isUser = $this->SiswaModel->GetSiswaNIS($username, $password);
		$r = $isUser->row();
		// var_dump($r);die;
		if ($isUser->num_rows() == 1) {
			$session = array(
				'admin_session' => false,
				'id_siswa' => $r->id_siswa,
				'nisn' => $r->NIS,
				'nama' => $r->nama,
				'sudah_milih' => $r->sudah_milih,
			);
			$this->session->set_userdata($session); 
			$status = true;
			$message = 'Selamat datang <span class="font-weight-bold">' . $r->nama . '</span>, sedang mengalihkan..';
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
	}
	public function get_calon_osis()
	{

		$data = $this->CalonModel->ListUserCalon();
		if ($data) {
			$data = $data->result();
			$status = 1;
		} else {
			$data = [];
			$status = 0;
		}
		
		echo json_encode(array(
			'status' => $status,
			'data' => $data,
		));
		
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
	public function pilih_calon()
	{
		$this->cekLoginAdmin();
		$pesan = " gagal memilih";
		$status = false;

		$id_calon = $this->input->post('id_calon');

		$id = $this->session->userdata('id_siswa');
		// var_dump($id, $id_calon);die;

		if ($this->getIsUserHasChose($id)) {
			$pesan = " Maaf, Anda Sudah Memilih Calon";
			$status = false;
		} else {
			$getUserByID = $this->SiswaModel->getSiswaById($id)[0];
			$obs['data'] = $getUserByID;
			$getJumlama = $this->CalonModel->getCalonByID($id_calon)->result()[0]->total;
			$total = $getJumlama + 1;

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
	}
	public function getIsUserHasChose($id)
	{
		$data = $this->SiswaModel->getIsUserHasChose($id)[0]->sudah_milih;
		if ($data == 1) {
			return true; // sudah Milih		
		} else {
			return false; // belum Milih 
		}
	}
	public function logout()
	{
		$CI = &get_instance();
		$CI->load->library('session');
		$CI->session->sess_destroy();

		$pesan = "Berhasil Keluar";
		$eror = 0;
		echo json_encode(array(
			'pesan' => $pesan,
			'error' => $eror,
		));
	}
	public function cekSession()
	{
		$this->isLoginUser();
		// var_dump($_SESSION);die;
		$arrayName = array('sess' => $_SESSION);
		// var_dump($login);
		// die;

		echo json_encode(array(
			'message' => "succes",
			'data' => $_SESSION,
		));
		# code...
	}
	public function pilihanku()
	{
		$id = $this->session->userdata('id_siswa');
		$getUserByID = $this->SiswaModel->getSiswaAndCalon($id)->row();
		echo json_encode(array(
			'status' => true,
			'message' => $getUserByID,
		));
	}
	public function quick_count()
	{
		$data = $this->CalonModel->ListUserCalon();
		if ($data) {
			$data = $data->result();
			$status = 1;
		} else {
			$data = [];
			$status = 0;
		}

		echo json_encode(array(
			'status' => $status,
			'data' => $data,
		));
	}
	
}
        
                            