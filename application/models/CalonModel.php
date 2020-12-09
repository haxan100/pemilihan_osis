<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class CalonModel extends CI_Model {
  
	public function dt_Calon($post)
	{
		$columns = array(
			'NIS',
			'nama_calon',
			'id_kelas'
		);
		// untuk search
		$columnsSearch = array(
			'nama_calon',
			'moto',
			'visi',
		);
		// gunakan join disini
		$from = 'calon s';
		// custom SQL
		$sql = "SELECT *  FROM {$from}  ";
		$where = "";
		$whereTemp = "";
		if ($whereTemp != '' && $where != '') $where .= " AND (" . $whereTemp . ")";
		else if ($whereTemp != '') $where .= $whereTemp;
		// search
		if (isset($post['search']['value']) && $post['search']['value'] != '') {
			$search = $post['search']['value'];
			// di $columns
			$whereTemp = "";
			for ($i = 0; $i < count($columnsSearch); $i++) {
				$whereTemp .= $columnsSearch[$i] . ' LIKE "%' . $search . '%"';
				// agar tidak menambahkan 'OR' diakhir Looping
				if ($i < count($columnsSearch) - 1) {
					$whereTemp .= ' OR ';
				}
			}
			if ($where != '') $where .= " AND (" . $whereTemp . ")";
			else $where .= $whereTemp;
		}
		if ($where != '') $sql .= ' where (' . $where . ')';
		//SORT Kolom
		$sortColumn = isset($post['order'][0]['column']) ? $post['order'][0]['column'] : 1;
		$sortDir    = isset($post['order'][0]['dir']) ? $post['order'][0]['dir'] : 'asc';
		$sortColumn = $columns[$sortColumn - 1];
		$count = $this->db->query($sql);
		// hitung semua data
		$totaldata = $count->num_rows();
		// memberi Limit
		$start  = isset($post['start']) ? $post['start'] : 0;
		$length = isset($post['length']) ? $post['length'] : 10;
		$sql .= " LIMIT {$start}, {$length}";
		// var_dump($sql);die();
		$data  = $this->db->query($sql);
		return array(
			'totalData' => $totaldata,
			'data' => $data,
		);
	}

	public function tambah_Calon($in)
	{
		return $this->db->insert('calon', $in);
	}

	public function edit_calon($in, $id_siswa)
	{
		$this->db->where('id_calon', $id_siswa);
		return $this->db->update('calon', $in);
	}
	public function ListUserCalon()
	{
		$this->db->from('calon');
		$query = $this->db->get();
		return $query;
	}
	public function GetPie()
	{
		$data = $this->db->query("SELECT * from calon");
		return $data->result();
	}
	public function getCalonByID($id_calon)
	{
		$this->db->from('calon');
		$this->db->where('id_calon', $id_calon);
		
		$query = $this->db->get();
		return $query;
	}
                            
                        
}
                        
/* End of file CalonModel.php */
    
                        