<?php 
defined('BASEPATH') OR exit('No direct script access allowed');        
class Admin extends CI_Controller {	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('SiswaModel');		
	}	

public function index()
{ 
		$this->load->view('templating/header');
		$this->load->view('templating/sidebar');
		$this->load->view('templating/index');
		$this->load->view('templating/footer');
		
}
public function siswa()
{
	// $obj['data'] = $this->SiswaModel->getAllSiswa();
	// var_dump($data);die;
		$obj['judul'] = "Data Siswa";
		$this->load->view('templating/header');
		$this->load->view('templating/sidebar');
		$this->load->view('templating/data',$obj);
		$this->load->view('templating/footer');
	

	# code...
}
	public function getAllSiswa()
	{

		$bu = base_url();
		$dt = $this->SiswaModel->dt_Siswa($_POST);
		// var_dump($dt);die;
		$datatable['draw']   = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $dt['totalData'];
		$datatable['recordsFiltered'] = $dt['totalData'];
		$datatable['data']            = array();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		// var_dump($dt['data']->result());die();
		$no = $start + 1;
		foreach ($dt['data']->result() as $row) {
			$sudah = " Belum Memilih";
			if($row->sudah_milih==1){
				$sudah = " Sudah Memilih";
			}
			$fields = array($no++);
			$fields[] = $row->nama . '<br>';
			$fields[] = $row->NIS . '<br>';
			$fields[] = $row->id_kelas . '<br>';
			$fields[] = $row->no_telpon . '<br>';
			$fields[] = $sudah . '<br>';

			$fields[] = '
        <button class="btn btn-warning my-1  btn-block btnUbah text-white" 
          data-id_siswa="' . $row->id_siswa . '"
          data-id_kelas="' . $row->id_kelas . '"
          data-nis="' . $row->NIS . '"
        ><i class="far fa-edit"></i> Ubah</button>
        
        <button class="btn btn-danger my-1  btn-block btnHapus text-white" 
          data-id_siswa="' . $row->id_siswa . '"          data-nama="' . $row->nama . '"
				><i class="fas fa-trash"></i> Hapus</button>        ';
			$datatable['data'][] = $fields;
		}
		echo json_encode($datatable);
		exit();
	}
	public function tambah_siswa_proses()
	{
		$nisn = $this->input->post('nisn', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$kelas = $this->input->post('kelas', TRUE);
		$alamat = $this->input->post('alamat', TRUE);
		$jk = $this->input->post('jk', TRUE);
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);

		$tanggal_lahir = $this->input->post('tanggal_lahir', TRUE);
		$tempat_lahir = $this->input->post('tempat_lahir', TRUE);

		$message = 'Gagal menambah data siswa!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;
		
		if (empty($nama)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi Nama');
		}
		if (empty($kelas)) {
			$status = false;
			$errorInputs[] = array('#kelas', 'Silahkan pilih Kelas');
		}
		if (empty($alamat)) {
			$status = false;
			$errorInputs[] = array('#alamat', 'Silahkan isi Alamat');
		}
		$cekFoto = empty($_FILES['foto']['name'][0]) || $_FILES['foto']['name'][0] == '';
		if (!$cekFoto) {


			$_FILES['f']['name']     = $_FILES['foto']['name'];
			$_FILES['f']['type']     = $_FILES['foto']['type'];
			$_FILES['f']['tmp_name'] = $_FILES['foto']['tmp_name'];
			$_FILES['f']['error']     = $_FILES['foto']['error'];
			$_FILES['f']['size']     = $_FILES['foto']['size'];

			$config['upload_path']          = './upload/images/siswa';
			$config['allowed_types']        = 'jpg|jpeg|png|gif';
			$config['max_size']             = 3 * 1024; // kByte
			$config['max_width']            = 10 * 1024;
			$config['max_height']           = 10 * 1024;
			$config['file_name'] = $nisn . "-" . date("Y-m-d-H-i-s") . ".jpg";
			$this->load->library('image_lib');
			$this->load->library('upload', $config);
			$this->upload->initialize($config);


			$this->image_lib->resize();

			if (!$this->upload->do_upload('f')) {
				$errorUpload = $this->upload->display_errors() . '<br>';
			} else {
				// Uploaded file data
				$fileName = $this->upload->data()["file_name"];
				$foto = array(
					'foto' => $fileName,
				);
				$in = array(
					'foto' => $fileName,
					'NIS' => $nisn,
					'nama' => $nama,
					'tgl_lahir' => $tanggal_lahir,
					'tempat_lahir' => $tempat_lahir,
					'jenis_kelamin' => $jk,
					'alamat' => $alamat,
					'id_kelas' => $kelas,
					'username' => $username,
					'password' => $password,
				);
				$this->SiswaModel->tambah_siswa($in);

				$message = "Berhasil Menambah Siswa #1";
			}
		} else {
			$message = "Gagal menambah Siswa #1";
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function hapusSiswa()
	{
		$id_siswa = $this->input->post('id_siswa', TRUE);
		$data = $this->SiswaModel->getSiswaById($id_siswa);
		$status = false;
		$message = 'Gagal menghapus Siswa!';
		if (count($data) == 0) {
			$message .= '<br>Tidak terdapat Siswa yang dimaksud.';
		} else {
			$this->SiswaModel->HapusSiswa($id_siswa);
			$status = true;
			$message = 'Berhasil menghapus Siswa: <b>' . $data[0]->nama . '</b>';
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
	}
        
}
        
                            