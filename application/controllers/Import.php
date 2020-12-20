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
	}
	public function import_siswa()
	{
		$berhasil = 0;
		$excelreader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		$data = array();
		$data['title'] = 'Import Excel Sheet | TechArise';
		$data['breadcrumbs'] = array('Home' => '#');
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
				if ($numrow > 1) {
					// var_dump($row);die;
					$cek = $this->db->query("SELECT * FROM `siswa` where NIS= '" . $row['B'] . "' AND id_kelas= '" . $row['D'] . "' ");
					$hasil = count($cek->result());

					if ($hasil >= 1) {
						$duplicateCount++;
						$duplicateuser .= $row['B'] ;
					}
				}
				$numrow++;
			}
			if ($duplicateCount >= 1) {
				$numrow = 1;
				$this->session->set_flashdata('flash_data', "Error.: <br> $duplicateCount Data Siswa terdapat duplikat! <br> $duplicateuser");
			} else {
				$numrow = 1;
				foreach ($allDataInSheet as $row) {
					if ($numrow > 1) {
						$data = array(
							'NIS' => $row['B'],
							'nama' => $row['C'],
							'id_kelas' => $row['D'],
							'no_telpon' => $row['E'],
							'tgl_lahir' => $row['F'],
							'jenis_kelamin' => $row['G'],
							'alamat' => $row['H'], 	  	  
							'username' => $row['I'], 	  	  
							'password' => $row['J'], 	  	  
						);
						$this->SiswaModel->tambah_siswa($data);
						$this->session->set_flashdata('flash_data', "$hasilRow  Data Siswa berhasil di import.");
						$sukses = true;

						$this->load->view('templating/data', $data);
					}
					$numrow++;
				}
			}
			if ($sukses) {
				
			}
		}

		redirect("admin/siswa"); // Redirect ke halaman awal (ke controller siswa fungsi index)
	}
        
}
        
    /* End of file  Import.php */
        
                            