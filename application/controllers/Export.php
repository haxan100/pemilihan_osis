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
		$this->load->model('CalonModel');
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
	public function master_list_Calon()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$lisUser = $this->CalonModel->ListUserCalon();

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID Calon')
			->setCellValue('B1', 'NISN')
			->setCellValue('C1', 'Nama Siswa')
			->setCellValue('D1', 'Misi')
			->setCellValue('E1', 'Visi');
		$i = 1;
		foreach ($lisUser->result() as $row) {
			$i++;
			$sheet->setCellValue('A' . $i, $row->id_calon);
			$sheet->setCellValue('B' . $i, $row->nis);
			$sheet->setCellValue('C' . $i, $row->nama_calon);
			$sheet->setCellValue('D' . $i, $row->moto);
			$sheet->setCellValue('E' . $i, $row->visi);
		}

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(17);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);


		$writer = new Xlsx($spreadsheet);

		$filename = 'List_Calon';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}
	public function master_list_admin()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$lisUser = $this->AdminModel->ListUserAdmin();

		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A1', 'ID')
			->setCellValue('B1', 'Nama Admin')
			->setCellValue('C1', 'No HP')
			->setCellValue('D1', 'UserName')
			->setCellValue('E1', 'Role');
		$i = 1;
		foreach ($lisUser->result() as $row) {
			$role = "Master Admin";
			if ($row->id_role != 1) {
				$role = "Admin";
			}
			$i++;
			$sheet->setCellValue('A' . $i, $row->id);
			$sheet->setCellValue('B' . $i, $row->nama);
			$sheet->setCellValue('C' . $i, $row->no_telpon);
			$sheet->setCellValue('D' . $i, $row->username);
			$sheet->setCellValue('E' . $i, $role);
		}

		$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(17);
		$spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
		$spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);


		$writer = new Xlsx($spreadsheet);

		$filename = 'List_Admin';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}
	public function master_Bem()
	{
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $lisUser = $this->CalonModel->ListUserCalon('bem');

    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'ID Calon')
        ->setCellValue('B1', 'NIM')
        ->setCellValue('C1', 'Nama Siswa')
        ->setCellValue('D1', 'Misi')
        ->setCellValue('E1', 'Visi')
        ->setCellValue('E1', 'Total Di Pilih')
				
				;
    $i = 1;
    foreach ($lisUser->result() as $row) {
        $i++;
        $sheet->setCellValue('A' . $i, $row->id_calon);
        $sheet->setCellValue('B' . $i, $row->nim);
        $sheet->setCellValue('C' . $i, $row->nama_calon);
        $sheet->setCellValue('D' . $i, $row->moto);
        $sheet->setCellValue('E' . $i, $row->visi);
        $sheet->setCellValue('E' . $i, $row->total);
    }

    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(17);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);

    $writer = new Xlsx($spreadsheet);

    $filename = 'List_Calon_BEM';

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
	}	
	public function master_DPM($id=0)
	{
		
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $lisUser = $this->CalonModel->ListUserCalonDPM($id);

    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'ID Calon')
        ->setCellValue('B1', 'NIM')
        ->setCellValue('C1', 'Prodi')
        ->setCellValue('D1', 'Nama Siswa')
        ->setCellValue('E1', 'Misi')
        ->setCellValue('F1', 'Visi')
        ->setCellValue('G1', 'Total Di Pilih')
				
				;
    $i = 1;
    foreach ($lisUser->result() as $row) {
        $i++;
        $sheet->setCellValue('A' . $i, $row->id_calon);
        $sheet->setCellValue('B' . $i, $row->nim);
        $sheet->setCellValue('C' . $i, $row->prodi);
        $sheet->setCellValue('D' . $i, $row->nama_calon);
        $sheet->setCellValue('E' . $i, $row->moto);
        $sheet->setCellValue('F' . $i, $row->visi);
        $sheet->setCellValue('G' . $i, $row->total);
    }

    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(17);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);

    $writer = new Xlsx($spreadsheet);

    $filename = 'List_Calon_dpm';

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
	}	

        
}
        
    /* End of file  Export.php */
        
                            