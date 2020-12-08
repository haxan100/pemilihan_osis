<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/third_party/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Export extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('SiswaModel');
	}
public function index()
{
                
}
	public function master_list_siswa()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$lisUser = $this->SiswaModel->ListUserSiswa();

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'NISN')
			->setCellValue('B1', 'Nama Siswa')
			->setCellValue('C1', 'No HP')
			->setCellValue('D1', 'Tanggal Lahir')
			->setCellValue('E1', 'Jenis Kelamin')
			->setCellValue('F1', 'Alamat')
		;
		$i = 1;
		foreach ($lisUser->result() as $row) {
			$i++;
			$sheet->setCellValue('A' . $i, $row->NIS);
			$sheet->setCellValue('B' . $i, $row->nama);
			$sheet->setCellValue('C' . $i, $row->no_telpon);
			$sheet->setCellValue('D' . $i, $row->tgl_lahir);
			$sheet->setCellValue('E' . $i, $row->jenis_kelamin);
			$sheet->setCellValue('F' . $i, $row->alamat);
		}

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(17);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);


		$writer = new Xlsx($spreadsheet);

		$filename = 'List_Siswa';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}
        
}
        
    /* End of file  Export.php */
        
                            