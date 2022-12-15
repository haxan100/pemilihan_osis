<?php 
defined('BASEPATH') OR exit('No direct script access allowed');        
class Admin extends MY_Controller {	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('SiswaModel');
		$this->load->model('CalonModel');
		$this->load->model('AdminModel');		
	}	

public function index()
{

	$obs['login'] = true;
	$obs['admin'] = true;
	$this->cekLoginAdmin();
		// var_dump($this->session->userdata('id_admin'));die;
		$id = $this->session->userdata('id_admin');
		$getUserByID = $this->AdminModel->getAdminById($id)[0];
		$obs['data'] = $getUserByID;
		$obj['siswa']= count($this->SiswaModel->getAllSiswa()->result());
		$obj['siswaSudahMilih'] = count($this->SiswaModel->getAllSiswaHasChose()->result());
		$obj['calon_bem'] = count($this->CalonModel->ListUserCalon('bem')->result());
		$obj['calon_dpm'] = count($this->CalonModel->ListUserCalon('dpm')->result());
		// var_dump($siswa);die;
		$this->load->view('templating/header');
		$this->load->view('templating/sidebar', $obs);
		// $this->load->view('templating/sidebar');
		$this->load->view('templating/index',$obj);
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
	public function siswa()
	{

		$obs['admin'] = true;
		$obs['login'] = true;
			$this->cekLoginAdmin();
			$obj['judul'] = "Data Siswa";
			$id = $this->session->userdata('id_admin');
			$getUserByID = $this->AdminModel->getAdminById($id)[0];
			$obs['data'] = $getUserByID;
			$this->load->view('templating/header');
			$this->load->view('templating/sidebar', $obs);
			$this->load->view('templating/data',$obj);
			$this->load->view('templating/footer');
		

		# code...
	}
	public function getAllSiswa()
	{

		$bu = base_url();
		$dt = $this->SiswaModel->dt_Siswa($_POST);
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
          data-nama="' . $row->nama . '"
          data-id_kelas="' . $row->id_kelas . '"
          data-no_telpon="' . $row->no_telpon . '"
          data-tgl_lahir="' . $row->tgl_lahir . '"
          data-jenis_kelamin="' . $row->jenis_kelamin . '"
          data-alamat="' . $row->alamat . '"
          data-username="' . $row->username . '"
          data-password="' . $row->password . '"
          data-jenis_kelamin="' . $row->jenis_kelamin . '"
          data-tempat_lahir="' . $row->tempat_lahir . '"
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
		// var_dump($_POST);die;
		$noHP = $this->input->post('noHP', TRUE);
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

		// $cekFoto = empty($_FILES['foto']['name'][0]) || $_FILES['foto']['name'][0] == '';
		// if (!$cekFoto) {


			// $_FILES['f']['name']     = $_FILES['foto']['name'];
			// $_FILES['f']['type']     = $_FILES['foto']['type'];
			// $_FILES['f']['tmp_name'] = $_FILES['foto']['tmp_name'];
			// $_FILES['f']['error']     = $_FILES['foto']['error'];
			// $_FILES['f']['size']     = $_FILES['foto']['size'];

			// $config['upload_path']          = './upload/images/siswa';
			// $config['allowed_types']        = 'jpg|jpeg|png|gif';
			// $config['max_size']             = 3 * 1024; // kByte
			// $config['max_width']            = 10 * 1024;
			// $config['max_height']           = 10 * 1024;
			// $config['file_name'] = $nisn . "-" . date("Y-m-d-H-i-s") . ".jpg";
			// $this->load->library('image_lib');
			// $this->load->library('upload', $config);
			// $this->upload->initialize($config);


			// $this->image_lib->resize();

			// if (!$this->upload->do_upload('f')) {
			// 	$errorUpload = $this->upload->display_errors() . '<br>';
			// } else {
			// 	// Uploaded file data
			// 	$fileName = $this->upload->data()["file_name"];
			// 	$foto = array(
			// 		'foto' => $fileName,
			// 	);
				$in = array(
					// 'foto' => $fileName,
					'NIS' => $nisn,
					'no_telpon' => $noHP,
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
			// }
		// } else {
			// $message = "Gagal menambah Siswa #1";
		// }
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

	public function ubah_siswa_proses()
	{
		// var_dump($_POST);die;
		$id_siswa = $this->input->post('id_siswa', TRUE);
		$nisn = $this->input->post('nisn', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$kelas = $this->input->post('kelas', TRUE);
		$alamat = $this->input->post('alamat', TRUE);
		$jk = $this->input->post('jk', TRUE);
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
		$tanggal_lahir = $this->input->post('tanggal_lahir', TRUE);
		$tempat_lahir = $this->input->post('tempat_lahir', TRUE);
		$no_hp = $this->input->post('noHP', TRUE);

		$message = 'Gagal mengedit data siswa!<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(
			'nama' => $nama,
			'alamat' => $alamat,
			'id_kelas' => $kelas,
			'jenis_kelamin' => $jk,
			'tgl_lahir' => $tanggal_lahir,
			'tempat_lahir' => $tempat_lahir,
			'username' => $username,
			'password' =>
			$password,
			'no_telpon' => $no_hp,
			'NIS' => $nisn,
		);
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
		if ($status) {
			$this->SiswaModel->edit_siswa($in, $id_siswa);
			$message = "Berhasil Mengedit Data ";
			 $status = true;



		} else {
			$message = "Gagal Mengubah Siswa #1";
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}

	public function calon()
	{

		$obs['admin'] = true;
		$obs['login'] = true;
		$this->cekLoginAdmin();
		$obj['judul'] = "Data Calon";
		$id = $this->session->userdata('id_admin');
		$getUserByID = $this->AdminModel->getAdminById($id)[0];
		$obs['data'] = $getUserByID;
		$this->load->view('templating/header');
		$this->load->view('templating/sidebar', $obs);
		$this->load->view('admin/calon', $obj);
		$this->load->view('templating/footer');
	}
	public function login()
	{
		$obj['judul'] = "Data Calon";
		$obj['data'] = $this->CalonModel->ListUserCalon()->result();
		$obj['ci'] = $this;
		// var_dump($data);die;
		// $this->load->view('templating/header');
		// $this->load->view('templating/sidebar');
		$this->load->view('admin/Login', $obj);
		// $this->load->view('templating/footer');
	}
	public function login_proses()
	{
		$status = false;
		$message = 'Gagal Login! , <br> Mohon Masukan Username dan Password dengan benar';

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$isUser = $this->AdminModel->GetAdminLogin($username, $password);
		$r = $isUser->row();
		// var_dump($r);die;
		if ($isUser->num_rows() == 1) {
			$session = array(
				'admin_session' => true,
				'id_admin' => $r->id,
				'nama' => $r->nama,
				'username' => $r->username,
				'password' => $r->password,
			);

			$this->session->set_userdata($session); // Buat session sesuai $session
			$status = true;

			$message = 'Selamat datang Admin <span class="font-weight-bold">' . $r->nama . '</span>, sedang mengalihkan..';
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
	}
	public function Logout()
	{		
		$this->session->sess_destroy();
			$status=true;
			$message="berhasil keluar";
		
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
		// $this->login();
	
		# code...
	}
	public function getCalonByID()
	{
		$id = $this->input->post('data');
		$data = $this->CalonModel->getCalonByID($id)->row();
		$datas = array(
			'status' => true,
			'data'=> $data,
		 );
		echo json_encode($datas);
	}
	public function cart()
	{
		$obs['admin'] = true;
		$obs['login'] = true;
		$this->cekLoginAdmin();
		$obj['judul'] = "Data Calon";

		$obj['data'] = $this->CalonModel->ListUserCalon()->result_array();
		$obj['graph'] = $this->CalonModel->GetPie();
		$id = $this->session->userdata('id_admin');
		$getUserByID = $this->AdminModel->getAdminById($id)[0];
		$obs['data'] = $getUserByID;
		$this->load->view('templating/header');
		$this->load->view('templating/sidebar', $obs);
		$this->load->view('User/cart', $obj);
		$this->load->view('templating/footer');
	}
	public function profile()
	{
			$id = $this->session->userdata('id_admin');
			$nama = $this->session->userdata('nama');
			// var_dump($_SESSION);die;
			$this->cekLoginAdmin();
			$obs['admin'] = true;
			$obs['login'] = true;
			$obj['calon'] = "Belum Memilih";
			$obj['statcalon'] = 	false;

			$getUserByID = $this->AdminModel->getAdminById($id)[0];
			$obs['data'] = $getUserByID;

			$obj['judul'] = "Profile";
			$obj['graph'] = $this->CalonModel->GetPie();

			$getUser = $this->AdminModel->getAdminById($id)[0];
			// var_dump($getUser);die;
			$obj['data'] = $getUser;

			$this->load->view('templating/header');
			$this->load->view('templating/sidebar', $obs);
			$this->load->view('admin/profile', $obj);
			$this->load->view('templating/footer');
		
		// if($this->isLoginUser()){


		# code...
	}
	public function ubah_profile_admin()
	{
		// var_dump($_POST);die;
		$id = $this->input->post('id', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
		$no_hp = $this->input->post('noHP', TRUE);

		$message = 'Gagal mengedit data !<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(
			'nama' => $nama,
			'username' => $username,
			'password' =>
			$password,
			'no_telpon' => $no_hp,
		);
		if (empty($nama)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi Nama');
		}
		if ($status) {
			$this->AdminModel->edit_profile_admin($in, $id);
			$message = "Berhasil Mengedit Data ";
			$status = true;
		} else {
			$message = "Gagal Mengubah Data #1";
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function roleAdmin()
	{
		$id = $this->session->userdata('id_admin');
		$getUserByID = $this->AdminModel->getAdminById($id)[0];
		return $role =  $getUserByID->id_role;
		# code...
	}
		public function admin()
	{

		$obs['admin'] = true;
		$obs['login'] = true;
		$role = $this->roleAdmin();
		// var_dump($role);die;
		if($role){
			$this->cekLoginAdmin();
			$obj['judul'] = "Data Admin";
			$id = $this->session->userdata('id_admin');
			$getUserByID = $this->AdminModel->getAdminById($id)[0];
			$obs['data'] = $getUserByID;
			$this->load->view('templating/header');
			$this->load->view('templating/sidebar', $obs);
			$this->load->view('templating/data_admin',$obj);
			$this->load->view('templating/footer');
		}else{
			echo "<script>
			alert('Anda Tidak Di perbolehkan Di Halaman Ini!');			
			</script>";			
			redirect('admin','refresh');
			
		}

		

		# code...
	}
	  public function downloadTemplateSpekHP()
  {
    $this->load->helper('download');
    $sFileName = 'assets/template/template_siswa.xlsx';
    force_download($sFileName, NULL);
  }
  	public function getAllAdmin()
	{
		$bu = base_url();
		$dt = $this->AdminModel->dt_Admin($_POST);
		// var_dump($dt);die;
		$datatable['draw']   = isset($_POST['draw']) ? $_POST['draw'] : 1;
		$datatable['recordsTotal']    = $dt['totalData'];
		$datatable['recordsFiltered'] = $dt['totalData'];
		$datatable['data']            = array();
		$start  = isset($_POST['start']) ? $_POST['start'] : 0;
		// var_dump($dt['data']->result());die();
		$no = $start + 1;
		foreach ($dt['data']->result() as $row) {
			$role = "Master Admin";
			if($row->id_role!=1){
				$role = "Admin";
			}
			$fields = array($no++);
			$fields[] = $row->nama . '<br>';
			$fields[] = $row->username . '<br>';
			$fields[] = $row->no_telpon . '<br>';
			$fields[] = $role . '<br>';

			$fields[] = '
        <button class="btn btn-warning my-1  btn-block btnUbah text-white" 
          data-id="' . $row->id . '"
          data-nama="' . $row->nama . '"
          data-username="' . $row->username . '"
          data-password="' . $row->password . '"
          data-id_role="' . $row->id_role . '"
          data-no_telpon="' . $row->no_telpon . '"
        ><i class="far fa-edit"></i> Ubah</button>
        
        <button class="btn btn-danger my-1  btn-block btnHapus text-white" 
		  data-id="' . $row->id . '"          
		  data-nama="' . $row->nama . '"
				><i class="fas fa-trash"></i> Hapus</button>        ';
			$datatable['data'][] = $fields;
		}
		echo json_encode($datatable);
		exit();
	}
	public function ubah_admin_proses()
	{
		// var_dump($_POST);die;
		$id = $this->input->post('id', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$role = $this->input->post('role', TRUE);
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
		$no_hp = $this->input->post('noHP', TRUE);

		$message = 'Gagal mengedit data !<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		$in = array(
			'nama' => $nama,
			'id_role' => $role,
			'username' => $username,
			'password' =>$password,
			'no_telpon' => $no_hp,
		);
		if (empty($nama)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi Nama');
		}
		if ($status) {
			$this->AdminModel->edit_admin($in, $id);
			$message = "Berhasil Mengedit Data ";
			$status = true;
		} else {
			$message = "Gagal Mengubah Data #1";
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function tambah_admin_proses()
	{
		// var_dump($_POST);die;
		$noHP = $this->input->post('noHP', TRUE);
		$nama = $this->input->post('nama', TRUE);
		$role = $this->input->post('role', TRUE);
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);
		$message = 'Gagal menambah data !<br>Silahkan lengkapi data yang diperlukan.';
		$errorInputs = array();
		$status = true;

		if (empty($nama)) {
			$status = false;
			$errorInputs[] = array('#nama', 'Silahkan Isi Nama');
		}
		if (empty($username)) {
			$status = false;
			$errorInputs[] = array('#username', 'Silahkan isi Alamat');
		}
		if (empty($password)) {
			$status = false;
			$errorInputs[] = array('#$password', 'Silahkan isi Alamat');
		}
		$in = array(
			'nama' => $nama,
			'no_telpon' => $noHP,
			'id_role' => $role,
			'username' => $username,
			'password' => $password,
		);if($status){
			$this->AdminModel->tambah_admin($in);
			$message = "Berhasil Menambah Data #1";
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
			'errorInputs' => $errorInputs
		));
	}
	public function hapusAdmin()
	{
		$id = $this->input->post('id', TRUE);
		$data = $this->AdminModel->getAdminById($id);
		$status = false;
		$message = 'Gagal menghapus Admin!';
		if (count($data) == 0) {
			$message .= '<br>Tidak terdapat Admin yang dimaksud.';
		} else {
			$this->AdminModel->HapusAdmin($id);
			$status = true;
			$message = 'Berhasil menghapus Admin: <b>' . $data[0]->nama . '</b>';
		}
		echo json_encode(array(
			'status' => $status,
			'message' => $message,
		));
	}

		public function calon_bem()
	{
		$obs['admin'] = true;
		$obs['login'] = true;
		$this->cekLoginAdmin();
		$obj['judul'] = "Data Calon";
		$id = $this->session->userdata('id_admin');
		$getUserByID = $this->AdminModel->getAdminById($id)[0];
		$obs['data'] = $getUserByID;
		$this->load->view('templating/header');
		$this->load->view('templating/sidebar', $obs);
		$this->load->view('admin/calon_bem', $obj);
		$this->load->view('templating/footer');
	}
		public function calon_dpm()
	{
		$obs['admin'] = true;
		$obs['login'] = true;
		$this->cekLoginAdmin();
		$obj['judul'] = "Data Calon";
		$id = $this->session->userdata('id_admin');
		$getUserByID = $this->AdminModel->getAdminById($id)[0];
		$obs['data'] = $getUserByID;
		$dataProdi = $this->ConfigModel->getData('prodi');
		$obs['prodi'] = $dataProdi;
		$this->load->view('templating/header');
		$this->load->view('templating/sidebar', $obs);
		$this->load->view('admin/calon_dpm', $obj);
		$this->load->view('templating/footer');
	}

   
        
}
        
                            