<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

	public function tambah($tabel,$data)
	{
		var_dump($tabel,$data);die;
		$this->db->insert($tabel, $data);
		return $this->db->insert_id();
	}
	public function getDataFromTabelByResult($tabel,$cari = [],$select='*')
	{
	  // var_dump($cari);die;
	  
	  $this->db->select($select);
	  
	  $this->db->from($tabel);
	  $this->db->where($cari);
	  $sql = $this->db->get();
	  return $sql->result_array();
	}
 
}
