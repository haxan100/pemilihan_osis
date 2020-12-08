<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/third_party/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

        
class Import extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('SiswaModel');
		// $this->load->model('BidModel');
		// $this->load->model('ProdukModel');
		// $this->load->model('UserModel');
		// $this->load->library('image_lib');
	}
	public function import_siswa()
	{
		$berhasil = 0;
		$excelreader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$data = array();
		$data['title'] = 'Import Excel Sheet | TechArise';
		$data['breadcrumbs'] = array('Home' => '#');

		// var_dump(($_FILES['fileURL']['name']));die;

		if (!empty($_FILES['fileURL']['name'])) {
			// get file extension
			$extension = pathinfo($_FILES['fileURL']['name'], PATHINFO_EXTENSION);
			$berhasil = 0;

			if ($extension == 'csv') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} elseif ($extension == 'xlsx') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			}
			// file path
			$spreadsheet = $reader->load($_FILES['fileURL']['tmp_name']);
			// var_dump($spreadsheet);die;
			$allDataInSheet = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

			// array Count
			$arrayCount = count($allDataInSheet);
			$hasilRow = $arrayCount - 1;
			$ugagal = "";
			$duplicateuser = '';
			$duplicateCount = 0;
			// var_dump($arrayCount);die;
			$numrow = 1; // untuk mengecek duplikat 

			foreach ($allDataInSheet as $row) {

				// var_dump($row);die;
				if ($numrow > 1) {
					// var_dump($row);die;
					$cek = $this->db->query("SELECT * FROM `spek_handphone` where merk= '" . $row['A'] . "' AND model= '" . $row['B'] . "'  AND ram= '" . $row['E'] . "' AND storage= '" . $row['F'] . "' ");

					// 	var_dump($this->db->last_query());
					// die;

					$hasil = count($cek->result());

					// var_dump($hasil);
					// die;

					if ($hasil >= 1) {
						$duplicateCount++;
						$duplicateuser .= $row['A'] . "/" . $row['B'] . "/" . $row['E'] . "/" . $row['F'] .  ",	 ";
					}
				}
				$numrow++;
			}
			if ($duplicateCount >= 1) {
				$numrow = 1;
				$this->session->set_flashdata('flash_data', "Error.: <br> $duplicateCount Spesifikasi HP terdapat duplikat! <br> $duplicateuser");
			} else {
				$numrow = 1;
				foreach ($allDataInSheet as $row) {
					if ($numrow > 1) {
						$data = array(
							'merk' => $row['A'],
							'type' => $row['B'],
							'model' => $row['C'],
							// 'screen_resolution' => $row['D'],
							'back_camera' => $row['D'],
							'front_camera' => $row['E'],
							// 'os' => $row['G'],
							'ram' => $row['F'],
							'storage' => $row['G'], 	  	  
						);
						$this->ProdukModel->tambah_spek_hp($data);

						$this->session->set_flashdata('flash_data', "$hasilRow  Spesifikasi Handphone berhasil di import.");
						$sukses = true;
						$this->load->view('admin/master_spek_hp', $data);
					}
					$numrow++;
				}
			}
			if ($sukses) {
				$id_admin = $this->session->userdata('id_admin');

				$aksi = 'Import Spek Hp';
				$id_kategori = 31;
				$this->AdminModel->log($id_admin, $id_kategori, $aksi);
			}
		}

		redirect("admin/master_spek_hp"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
        
}
        
    /* End of file  Import.php */
        
                            