<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class AdminModel extends CI_Model {
                        
public function login(){
                        
                                
}
	public function	GetAdminLogin($username, $password)
	{
		$this->db->from('admin');
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$query = $this->db->get();
		return $query;
		# code...
	}
	public function getAdminById($id)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get('admin s');
		return $query->result();
		# code...
	}
                        
                            
                        
}
                        
/* End of file AdminModel.php */
    
                        