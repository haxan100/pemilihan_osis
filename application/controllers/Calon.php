<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Calon extends CI_Controller
{

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
        $datatable['draw'] = isset($_POST['draw']) ? $_POST['draw'] : 1;
        $datatable['recordsTotal'] = $dt['totalData'];
        $datatable['recordsFiltered'] = $dt['totalData'];
        $datatable['data'] = array();
        $start = isset($_POST['start']) ? $_POST['start'] : 0;
        // var_dump($dt['data']->result());die();
        $no = $start + 1;
        foreach ($dt['data']->result() as $row) {

            $fields = array($no++);
            $fields[] = $row->nama_calon . '<br>';
            $fields[] = $row->nis . '<br>';
            $fields[] = $row->kelas_calon . '<br>';
            $fields[] = $row->visi . '<br>';
            $fields[] = $row->moto . '<br>';
            $fields[] = '<img class="img-fluid" id="foto_wrapper" id="foto_wrapper"  data-target="#modalBaru" data-toggle="modal"  src="' . $bu . '/upload/images/Calon/' . $row->foto . ' "/> ';

            $fields[] = '
        <button class="btn btn-warning my-1  btn-block btnUbah text-white"
          data-id_calon="' . $row->id_calon . '"
          data-nama_calon="' . $row->nama_calon . '"
          data-kelas_calon="' . $row->kelas_calon . '"
          data-visi="' . $row->visi . '"
          data-misi="' . $row->moto . '"
          data-nis="' . $row->nis . '"
        ><i class="far fa-edit"></i> Ubah</button>

        <button class="btn btn-danger my-1  btn-block btnHapus text-white"
		  data-id_calon="' . $row->id_calon . '"
		  data-id_kelas="' . $row->kelas_calon . '"
		  data-nama_calon="' . $row->nama_calon . '"




				><i class="fas fa-trash"></i> Hapus</button>        ';
            $datatable['data'][] = $fields;
        }
        echo json_encode($datatable);
        exit();
    }
    public function tambah_calon_proses()
    {
        $nisn = $this->input->post('nisn', true);
        $nama = $this->input->post('nama', true);
        $kelas = $this->input->post('kelas', true);
        $visi = $this->input->post('visi', true);
        $misi = $this->input->post('misi', true);

        $message = 'Gagal menambah data Calon!<br>Silahkan lengkapi data yang diperlukan.';
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

        $cekFoto = empty($_FILES['foto']['name'][0]) || $_FILES['foto']['name'][0] == '';

        if (!$cekFoto) {

            $_FILES['f']['name'] = $_FILES['foto']['name'];
            $_FILES['f']['type'] = $_FILES['foto']['type'];
            $_FILES['f']['tmp_name'] = $_FILES['foto']['tmp_name'];
            $_FILES['f']['error'] = $_FILES['foto']['error'];
            $_FILES['f']['size'] = $_FILES['foto']['size'];
            $config['upload_path'] = './upload/images/calon';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 3 * 1024; // kByte
            $config['max_width'] = 10 * 1024;
            $config['max_height'] = 10 * 1024;
            $config['file_name'] = $nisn . "-" . date("Y-m-d-H-i-s") . ".jpg";
            $this->load->library('image_lib');
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

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
                    'nama_calon' => $nama,
                    'kelas_calon' => $kelas,
                    'visi' => $visi,
                    'moto' => $misi,
                );
                $this->CalonModel->tambah_Calon($in);

                $message = "Berhasil Menambah Calon #1";
                echo json_encode(array(
                    'status' => $status,
                    'message' => $message,
                    'errorInputs' => $errorInputs,
                ));
            }
        }
    }
    public function ubah_siswa_proses_bem()
    {
        $id_calon = $this->input->post('id_siswa', true);
        $nisn = $this->input->post('nisn', true);
        $nama = $this->input->post('nama', true);
        $visi = $this->input->post('visi', true);
        $misi = $this->input->post('misi', true);

        $message = 'Gagal mengedit data siswa!<br>Silahkan lengkapi data yang diperlukan.';
        $errorInputs = array();
        $status = true;

        $in = array(
            'nama_calon' => $nama,
            'moto' => $misi,
            'visi' => $visi,
            'nim' => $nisn,
        );
        $cekFoto = empty($_FILES['foto']['name'][0]) || $_FILES['foto']['name'][0] == '';
        if (!$cekFoto) {
            // var_dump($cekFoto);die;
            $filesCount = 0;
            $successUpload = 0;
            $errorUpload = '';
            $config['image_library'] = 'gd2';
            $_FILES['f']['name'] = $_FILES['foto']['name'];
            $_FILES['f']['type'] = $_FILES['foto']['type'];
            $_FILES['f']['tmp_name'] = $_FILES['foto']['tmp_name'];
            $_FILES['f']['error'] = $_FILES['foto']['error'];
            $_FILES['f']['size'] = $_FILES['foto']['size'];
            $config['upload_path'] = './upload/images/Calon_bem/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 3 * 1024; // kByte
            $config['max_width'] = 10 * 1024;
            $config['max_height'] = 10 * 1024;
            $config['file_name'] = $id_calon . "-" . date("Y-m-d-H-i-s") . ".jpg";
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $data_kode = array('id_calon' => $id_calon);
            $foto = $this->db->get_where('calon_bem', $data_kode);
            if ($foto->num_rows() > 0) {
                $pros = $foto->row();
                // var_dump($pros);die;
                $name = $pros->foto;
                if (file_exists($lok = FCPATH . '/upload/images/Calon_bem' . $name)) {
                    unlink($lok);
                }
                if (file_exists($lok = FCPATH . './upload/images/Calon_bem/' . $name)) {
                    unlink($lok);
                }
            }
            if (!$this->upload->do_upload('f')) {
                $errorUpload = $this->upload->display_errors() . '<br>';
                var_dump($errorUpload);
            }

            $inFoto = array(
                'foto' => $nameFoto = str_replace(' ', '_', $config['file_name']),
            );
            $this->CalonModel->edit_calon($inFoto, $id_calon, 'bem');
        }

        if (empty($nama)) {
            $status = false;
            $errorInputs[] = array('#nama', 'Silahkan Isi Nama');
        }
        if (empty($misi)) {
            $status = false;
            $errorInputs[] = array('#misi', 'Silahkan isi Misi');
        }
        if ($status) {
            $this->CalonModel->edit_calon($in, $id_calon, 'bem');
            $message = "Berhasil Mengedit Data ";
            $status = true;
        } else {
            $message = "Gagal Mengubah Siswa #1";
        }
        echo json_encode(array(
            'status' => $status,
            'message' => $message,
            'errorInputs' => $errorInputs,
        ));
    }
	  public function ubah_siswa_proses_dpm()
    {
        $id_calon = $this->input->post('id_siswa', true);
        $nisn = $this->input->post('nisn', true);
        $nama = $this->input->post('nama', true);
        $visi = $this->input->post('visi', true);
        $misi = $this->input->post('misi', true);
        $prodi = $this->input->post('prodi', true);

        $message = 'Gagal mengedit data siswa!<br>Silahkan lengkapi data yang diperlukan.';
        $errorInputs = array();
        $status = true;

        $in = array(
            'nama_calon' => $nama,
            'moto' => $misi,
            'visi' => $visi,
            'nim' => $nisn,
            'prodi' => $prodi,
        );
        $cekFoto = empty($_FILES['foto']['name'][0]) || $_FILES['foto']['name'][0] == '';
        if (!$cekFoto) {
            // var_dump($cekFoto);die;
            $filesCount = 0;
            $successUpload = 0;
            $errorUpload = '';
            $config['image_library'] = 'gd2';
            $_FILES['f']['name'] = $_FILES['foto']['name'];
            $_FILES['f']['type'] = $_FILES['foto']['type'];
            $_FILES['f']['tmp_name'] = $_FILES['foto']['tmp_name'];
            $_FILES['f']['error'] = $_FILES['foto']['error'];
            $_FILES['f']['size'] = $_FILES['foto']['size'];
            $config['upload_path'] = './upload/images/Calon_dpm/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 3 * 1024; // kByte
            $config['max_width'] = 10 * 1024;
            $config['max_height'] = 10 * 1024;
            $config['file_name'] = $id_calon . "-" . date("Y-m-d-H-i-s") . ".jpg";
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            $data_kode = array('id_calon' => $id_calon);
            $foto = $this->db->get_where('calon_dpm', $data_kode);
            if ($foto->num_rows() > 0) {
                $pros = $foto->row();
                // var_dump($pros);die;
                $name = $pros->foto;
                if (file_exists($lok = FCPATH . '/upload/images/Calon_dpm' . $name)) {
                    unlink($lok);
                }
                if (file_exists($lok = FCPATH . './upload/images/Calon_dpm/' . $name)) {
                    unlink($lok);
                }
            }
            if (!$this->upload->do_upload('f')) {
                $errorUpload = $this->upload->display_errors() . '<br>';
                var_dump($errorUpload);
            }

            $inFoto = array(
                'foto' => $nameFoto = str_replace(' ', '_', $config['file_name']),
            );
            $this->CalonModel->edit_calon($inFoto, $id_calon, 'dpm');
        }

        if (empty($nama)) {
            $status = false;
            $errorInputs[] = array('#nama', 'Silahkan Isi Nama');
        }
        if (empty($misi)) {
            $status = false;
            $errorInputs[] = array('#misi', 'Silahkan isi Misi');
        }
        if ($status) {
            $this->CalonModel->edit_calon($in, $id_calon, 'dpm');
            $message = "Berhasil Mengedit Data ";
            $status = true;
        } else {
            $message = "Gagal Mengubah Siswa #1";
        }
        echo json_encode(array(
            'status' => $status,
            'message' => $message,
            'errorInputs' => $errorInputs,
        ));
    }
    public function hapusCalon_bem()
    {
        $id_siswa = $this->input->post('id_siswa', true);
        $data = $this->CalonModel->getCalonByID($id_siswa, 'bem')->result();
        // var_dump($data);die;
        $status = false;
        $message = 'Gagal menghapus Data!';
        if (count($data) == 0) {
            $message .= '<br>Tidak terdapat Data yang dimaksud.';
        } else {
            $this->CalonModel->HapusCalon($id_siswa, 'bem');
            $status = true;
            $message = 'Berhasil menghapus Calon: <b>' . $data[0]->nama_calon . '</b>';
        }
        echo json_encode(array(
            'status' => $status,
            'message' => $message,
        ));
    }
    public function hapusCalon_dpm()
    {
        $id_siswa = $this->input->post('id_siswa', true);
        $data = $this->CalonModel->getCalonByID($id_siswa,'dpm')->result();
        $status = false;
        $message = 'Gagal menghapus Data!';
        if (count($data) == 0) {
            $message .= '<br>Tidak terdapat Data yang dimaksud.';
        } else {
            $this->CalonModel->HapusCalon($id_siswa, 'dpm');
            $status = true;
            $message = 'Berhasil menghapus Calon </b>';
        }
        echo json_encode(array(
            'status' => $status,
            'message' => $message,
        ));
    }
    public function getAllCalon_bem()
    {

        $bu = base_url();
        $dt = $this->CalonModel->dt_Calon($_POST, 'bem');
        // var_dump($dt);die;
        $datatable['draw'] = isset($_POST['draw']) ? $_POST['draw'] : 1;
        $datatable['recordsTotal'] = $dt['totalData'];
        $datatable['recordsFiltered'] = $dt['totalData'];
        $datatable['data'] = array();
        $start = isset($_POST['start']) ? $_POST['start'] : 0;
        // var_dump($dt['data']->result());die();
        $no = $start + 1;
        foreach ($dt['data']->result() as $row) {

            $fields = array($no++);
            $fields[] = $row->nama_calon . '<br>';
            $fields[] = $row->nim . '<br>';
            $fields[] = $row->visi . '<br>';
            $fields[] = $row->moto . '<br>';
            $fields[] = '<img class="img-fluid" id="foto_wrapper" id="foto_wrapper"  data-target="#modalBaru" data-toggle="modal"  src="' . $bu . '/upload/images/calon_bem/' . $row->foto . ' "/> ';

            $fields[] = '
        <button class="btn btn-warning my-1  btn-block btnUbah text-white"
          data-id_calon="' . $row->id_calon . '"
          data-nama_calon="' . $row->nama_calon . '"
          data-visi="' . $row->visi . '"
          data-misi="' . $row->moto . '"
          data-nim="' . $row->nim . '"
        ><i class="far fa-edit"></i> Ubah</button>

        <button class="btn btn-danger my-1  btn-block btnHapus text-white"
		  data-id_calon="' . $row->id_calon . '"
		  data-nama_calon="' . $row->nama_calon . '"




				><i class="fas fa-trash"></i> Hapus</button>        ';
            $datatable['data'][] = $fields;
        }
        echo json_encode($datatable);
        exit();
    }
    public function getAllCalon_dpm()
    {

        $bu = base_url();
        $dt = $this->CalonModel->dt_Calon_dpm($_POST);
        // var_dump($dt);die;
        $datatable['draw'] = isset($_POST['draw']) ? $_POST['draw'] : 1;
        $datatable['recordsTotal'] = $dt['totalData'];
        $datatable['recordsFiltered'] = $dt['totalData'];
        $datatable['data'] = array();
        $start = isset($_POST['start']) ? $_POST['start'] : 0;
        $no = $start + 1;
        foreach ($dt['data']->result() as $row) {
            $fields = array($no++);
            $fields[] = $row->nama_calon . '<br>';
            $fields[] = $row->nim . '<br>';
            $fields[] = $row->visi . '<br>';
            $fields[] = $row->moto . '<br>';
            $fields[] = $row->nama_prodi . '<br>';
            $fields[] = '<img class="img-fluid" id="foto_wrapper" id="foto_wrapper"  data-target="#modalBaru" data-toggle="modal"  src="' . $bu . '/upload/images/calon_dpm/' . $row->foto . ' "/> ';

            $fields[] = '
        <button class="btn btn-warning my-1  btn-block btnUbah text-white"
          data-id_calon="' . $row->id_calon . '"
          data-nama_calon="' . $row->nama_calon . '"
          data-visi="' . $row->visi . '"
          data-misi="' . $row->moto . '"
          data-nim="' . $row->nim . '"
        ><i class="far fa-edit"></i> Ubah</button>

        <button class="btn btn-danger my-1  btn-block btnHapus text-white"
		  data-id_calon="' . $row->id_calon . '"
		  data-nama_calon="' . $row->nama_calon . '"




				><i class="fas fa-trash"></i> Hapus</button>        ';
            $datatable['data'][] = $fields;
        }
        echo json_encode($datatable);
        exit();
    }
    public function tambah_calon_proses_bem()
    {
        $nisn = $this->input->post('nisn', true);
        $nama = $this->input->post('nama', true);
        $visi = $this->input->post('visi', true);
        $misi = $this->input->post('misi', true);

        $message = 'Gagal menambah data Calon BEM!<br>Silahkan lengkapi data yang diperlukan.';
        $errorInputs = array();
        $status = true;

        if (empty($nama)) {
            $status = false;
            $errorInputs[] = array('#nama', 'Silahkan Isi Nama');
        }
        $cekFoto = empty($_FILES['foto']['name'][0]) || $_FILES['foto']['name'][0] == '';

        if (!$cekFoto) {

            $_FILES['f']['name'] = $_FILES['foto']['name'];
            $_FILES['f']['type'] = $_FILES['foto']['type'];
            $_FILES['f']['tmp_name'] = $_FILES['foto']['tmp_name'];
            $_FILES['f']['error'] = $_FILES['foto']['error'];
            $_FILES['f']['size'] = $_FILES['foto']['size'];
            $config['upload_path'] = './upload/images/calon_bem';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 3 * 1024; // kByte
            $config['max_width'] = 10 * 1024;
            $config['max_height'] = 10 * 1024;
            $config['file_name'] = $nisn . "-" . date("Y-m-d-H-i-s") . ".jpg";
            $this->load->library('image_lib');
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('f')) {
                $errorUpload = $this->upload->display_errors() . '<br>';
                var_dump($errorUpload);die;
            } else {
                $fileName = $this->upload->data()["file_name"];
                $foto = array(
                    'foto' => $fileName,
                );
                $in = array(
                    'nim' => $nisn,
                    'nama_calon' => $nama,
                    'visi' => $visi,
                    'moto' => $misi,
                    'foto' => $fileName,
                );
                $this->CalonModel->tambah_Calon($in, "bem");

                $message = "Berhasil Menambah Calon #1";
                echo json_encode(array(
                    'status' => $status,
                    'message' => $message,
                    'errorInputs' => $errorInputs,
                ));
            }
        }
    }
    public function tambah_calon_proses_dpm()
    {
        $nisn = $this->input->post('nisn', true);
        $nama = $this->input->post('nama', true);
        $visi = $this->input->post('visi', true);
        $misi = $this->input->post('misi', true);
        $prodi = $this->input->post('prodi', true);

        $message = 'Gagal menambah data Calon BEM!<br>Silahkan lengkapi data yang diperlukan.';
        $errorInputs = array();
        $status = true;

        if (empty($nama)) {
            $status = false;
            $errorInputs[] = array('#nama', 'Silahkan Isi Nama');
        }
        $cekFoto = empty($_FILES['foto']['name'][0]) || $_FILES['foto']['name'][0] == '';

        if (!$cekFoto) {

            $_FILES['f']['name'] = $_FILES['foto']['name'];
            $_FILES['f']['type'] = $_FILES['foto']['type'];
            $_FILES['f']['tmp_name'] = $_FILES['foto']['tmp_name'];
            $_FILES['f']['error'] = $_FILES['foto']['error'];
            $_FILES['f']['size'] = $_FILES['foto']['size'];
            $config['upload_path'] = './upload/images/calon_dpm';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 3 * 1024; // kByte
            $config['max_width'] = 10 * 1024;
            $config['max_height'] = 10 * 1024;
            $config['file_name'] = $nisn . "-" . date("Y-m-d-H-i-s") . ".jpg";
            $this->load->library('image_lib');
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('f')) {
                $errorUpload = $this->upload->display_errors() . '<br>';
                var_dump($errorUpload);die;
            } else {
                $fileName = $this->upload->data()["file_name"];
                $foto = array(
                    'foto' => $fileName,
                );
                $in = array(
                    'nim' => $nisn,
                    'nama_calon' => $nama,
                    'visi' => $visi,
                    'moto' => $misi,
                    'foto' => $fileName,
                    'prodi' => $prodi,
                );
                $this->CalonModel->tambah_Calon($in, "dpm");

                $message = "Berhasil Menambah Calon #1";
                echo json_encode(array(
                    'status' => $status,
                    'message' => $message,
                    'errorInputs' => $errorInputs,
                ));
            }
        }
    }

}

/* End of file  Calon.php */
