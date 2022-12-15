<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ConfigModel extends CI_Model {

  public function __construct()
  {
    parent::__construct();
  }
	public function index()
  {
    // 
  }
  public function getData($tabel,$search='*')
  {
    $this->db->select($search);
    $sql =$this->db->from($tabel);
    $sql = $this->db->get();
		return $sql->result();
    return $sql->get->result();
    # code...
  }
  public function getDataByRowById($tabel,$search='*',$nama_id,$id)
  {
    $this->db->select($search);
    $sql =$this->db->from($tabel);
    $this->db->where($nama_id, $id);
    
    $sql = $this->db->get();
		return $sql->row();
    return $sql->get->result();
    # code...
  }
  public function updateData($tabel,$data,$name_id,$id)
  {
    $this->db->where($name_id, $id);
    return $this->db->update($tabel, $data);

  }
  public function deleteData($tabel,$name_id,$id)
	{
		$this->db->where($name_id, $id);
		$this->db->delete($tabel);
	}
	public function getDataWhereFromTable($table,$select,$where)
	{
			$this->db->select($select);
			$this->db->where($where);		 
			$sql =$this->db->from($table);
			$sql = $this->db->get();
			return $sql->result();
			return $sql->get->result();
	}
	public function insertData($data,$tabel)
	{
		$this->db->insert($tabel, $data);
		$insert_id = $this->db->insert_id();
		return $insert_id;

	}
	
}
