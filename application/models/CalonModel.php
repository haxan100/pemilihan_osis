<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class CalonModel extends CI_Model {
  
	public function dt_Calon($post,$type='bem')
	{
		$columns = array(
			'nim',
			'nama_calon',
		);
		// untuk search
		$columnsSearch = array(
			'nama_calon',
			'moto',
			'visi',
		);
		// gunakan join disini
		$from = "calon_$type s";
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
	public function dt_Calon_dpm($post)
	{
		$columns = array(
			'nim',
			'nama_calon',
		);
		// untuk search
		$columnsSearch = array(
			'nama_calon',
			'moto',
			'visi',
		);
		// gunakan join disini
		$from = "calon_dpm s
		join prodi p 
		on s.prodi = p.id_prodi
		";
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

	public function tambah_Calon($in,$type="bem")
	{
		return $this->db->insert("calon_$type", $in);
	}

	public function edit_calon($in, $id_siswa,$type)
	{
		$this->db->where('id_calon', $id_siswa);
		return $this->db->update("calon_$type", $in);
	}
	public function ListUserCalon($type)
	{
		$this->db->from("calon_$type");
		$query = $this->db->get();
		return $query;
	}
	public function ListUserCalonDPM($prodi)
	{		
		if($prodi!=0){
			$this->db->where('prodi', $prodi);		
		}
		$this->db->from("calon_dpm");
		$query = $this->db->get();
		return $query;
	}
	public function GetPieDPM($type)
	{
		$data = $this->db->query("SELECT * from calon_dpm where prodi = $type");

		return $data->result();
	}
	public function GetPie($type)
	{
		$data = $this->db->query("SELECT * from calon_$type");

		return $data->result();
	}
	public function getCalonByID($id_calon,$type)
	{
		$this->db->from("calon_$type");
		$this->db->where('id_calon', $id_calon);
		
		$query = $this->db->get();
		return $query;
	}
	public function HapusCalon($id_siswa,$type)
	{
		
		$this->db->where('id_calon', $id_siswa);
		$this->db->delete("calon_$type");
		$query = $this->db->get("calon_$type");
		return $query->result();


		# code...
	}
                            
                        
}
                        
/* End of file CalonModel.php */
    
                        