<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('CalonModel');
	}	

public function index()
{
		$obj['judul'] = "Data Calon";
		$obj['data']= $this->CalonModel->ListUserCalon()->result();
		// var_dump($data);die;
		$this->load->view('templating/header');
		$this->load->view('templating/sidebar');
		$this->load->view('user/pilih', $obj);
		$this->load->view('templating/footer');
}
        
}
        
    /* End of file  User.php */
        
                            