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

		$obs['admin'] = true;
		$obs['login'] = true;
		$obj['waktu'] = $this->AdminModel->getWaktuSetting()->row();
		// var_dump($obj);die;
		$obj['judul'] = "Setting";
		$id = $this->session->userdata('id_admin');
		$getUserByID = $this->AdminModel->getAdminById($id)[0];
		$obs['data'] = $getUserByID;
		$this->load->view('templating/header');
		$this->load->view('templating/sidebar', $obs);
		$this->load->view('admin/settings', $obj);
		// $this->load->view('admin/setting', $obj);
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
	public function getSetting()
	{
		$bu = base_url();
		$dt = $this->AdminModel->dt_Setting($_POST);
		// var_dump($dt);die;
		$datatable['draw']   = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $dt['totalData'];
		$datatable['recordsFiltered'] = $dt['totalData'];
		$datatable['data']            = array();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		// var_dump($dt['data']->result());die();
		$no = $start + 1;
		foreach ($dt['data']->result() as $row) {

			$fields = array($no++);
			$fields[] = $row->mulai . '<br>';
			$fields[] = $row->akhir . '<br>';
			$fields[] = '
        <button class="btn btn-warning my-1  btn-block btnUbah text-white" 
		  data-id_setting="' . $row->id_setting . '"
		  
          data-akhir="' . $row->akhir . '"
          data-mulai="' . $row->mulai . '"
        ><i class="far fa-edit"></i> Ubah</button>   ';
			$datatable['data'][] = $fields;
		}
		echo json_encode($datatable);
		exit();
	}
        
}
        
    /* End of file  Setting.php */
        
                            