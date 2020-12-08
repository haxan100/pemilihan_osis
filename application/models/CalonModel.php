<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class CalonModel extends CI_Model {
  
	public function dt_Calon($post)
	{
		$columns = array(
			'NIS',
			'nama',
			'id_kelas'
		);
		// untuk search
		$columnsSearch = array(
			'nama',
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
                        
                            
                        
}
                        
/* End of file CalonModel.php */
    
                        