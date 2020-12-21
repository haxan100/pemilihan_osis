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
	public function edit_waktu($in, $id_siswa)
	{
		$this->db->where('id_setting', $id_siswa);
		return $this->db->update('setting', $in);
	}
	public function getWaktuSetting()
	{
		$this->db->select('*');
		$this->db->where('id_setting', 1);
		$query = $this->db->get('setting s');
		return $query;
		# code...
	}
	public function dt_Setting($post)
	{
		// untuk sort
		$columns = array(
			'akhir',
		);
		// untuk search
		$columnsSearch = array(
			'akhir',
		);
		// gunakan join disini
		$from = 'setting s';
		// custom SQL
		$sql = "SELECT *  FROM {$from}  ";
		$where = "";
		if (isset($post['id_tipe_produk']) && $post['id_tipe_produk'] != 'default') {
			if ($where != "") $where .= "AND";
			$where .= " (p.id_tipe_produk='" . $post['id_tipe_produk'] . "')";
		}
		if (isset($post['id_tipe_bid']) && $post['id_tipe_bid'] != 'default') {
			if ($where != "") $where .= "AND";
			$where .= " (p.id_tipe_bid='" . $post['id_tipe_bid'] . "')";
		}
		if (isset($post['status']) && $post['status'] != 'default') {
			if ($where != "") $where .= "AND";
			$where .= " (p.status='" . $post['status'] . "')";
		}
		if (isset($post['dt_filter_kelengkapan']) && $post['dt_filter_kelengkapan'] != 'default') {
			if ($where != "") $where .= "AND";
			$where .= " (p.fullset='" . $post['dt_filter_kelengkapan'] . "')";
		}
		$whereTemp = "";
		if ($whereTemp != '' && $where != ''
		) $where .= " AND (" . $whereTemp . ")";
		else if ($whereTemp != '') $where .= $whereTemp;
		// search
		if (isset($post['search']['value']) && $post['search']['value'] != '') {
			$search = $post['search']['value'];
			// create parameter pencarian kesemua kolom yang tertulis

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
		// $sql .= " group by id_siswa ";
		// $sql .= " ORDER BY {$sortColumn} {$sortDir}";
		// var_dump($sql);die();
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

	public function edit_profile_admin($in, $id_siswa)
	{

		$this->db->where('id', $id_siswa);
		return $this->db->update('admin', $in);
	}
	public function dt_Admin($post)
	{
		// untuk sort
		$columns = array(
			'nama',
			'username',
			'no_telpon'
		);
		// untuk search
		$columnsSearch = array(
			'nama',
			'username',
			'no_telpon'
		);
		// gunakan join disini
		$from = 'admin s';
		// custom SQL
		$sql = "SELECT *  FROM {$from}  ";
		$where = "";
		
		$whereTemp = "";
		if ($whereTemp != '' && $where != ''
		) $where .= " AND (" . $whereTemp . ")";
		else if ($whereTemp != '') $where .= $whereTemp;
		// search
		if (isset($post['search']['value']) && $post['search']['value'] != '') {
			$search = $post['search']['value'];
			// create parameter pencarian kesemua kolom yang tertulis

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
		// $sql .= " group by id_siswa ";
		// $sql .= " ORDER BY {$sortColumn} {$sortDir}";
		// var_dump($sql);die();
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
	public function edit_admin($in, $id_siswa)
	{
		$this->db->where('id', $id_siswa);
		return $this->db->update('admin', $in);
	}
	public function tambah_admin($in)
	{
		return $this->db->insert('admin', $in);
	}
	public function ListUserAdmin()
	{
		$this->db->from('admin');
		$query = $this->db->get();
		return $query;
	}
                        
                            
                        
}
                        
/* End of file AdminModel.php */
    
                        