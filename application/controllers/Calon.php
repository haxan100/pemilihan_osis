<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Calon extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('CalonModel');
	}	
public function index()
{
		$obj['judul'] = "Data Siswa";
		$this->load->view('templating/header');
		$this->load->view('templating/sidebar');
		$this->load->view('templating/data', $obj);
		$this->load->view('templating/footer');      
}
	public function getAllCalon()
	{

		$bu = base_url();
		$dt = $this->CalonModel->dt_Calon($_POST);
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
			$fields[] = $row->nama_calon . '<br>';
			$fields[] = $row->nis . '<br>';
			$fields[] = $row->kelas_calon . '<br>';
			$fields[] = $row->foto . '<br>';

			$fields[] = '
        <button class="btn btn-warning my-1  btn-block btnUbah text-white" 
          data-id_calon="' . $row->id_calon . '"
          data-nama_calon="' . $row->nama_calon. '"
          data-kelas_calon="' . $row->kelas_calon . '"
        ><i class="far fa-edit"></i> Ubah</button>
        
        <button class="btn btn-danger my-1  btn-block btnHapus text-white" 
          data-id_calon="' . $row->id_calon . '"          data-nama_calon="' . $row->nama_calon . '"
				><i class="fas fa-trash"></i> Hapus</button>        ';
			$datatable['data'][] = $fields;
		}
		echo json_encode($datatable);
		exit();
	}
        
}
        
    /* End of file  Calon.php */
        
                            