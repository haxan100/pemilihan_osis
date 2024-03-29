<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class SiswaModel extends CI_Model {
                        
public function login(){
                        
                                
}
public function getAllSiswa()
	{	
		$this->db->select('*');
		$this->db->from('siswa');
		$data =  $this->db->get();
		return $data;
		# code...
	}
	public function getAllSiswaHasChose($type)
	{
		$this->db->select('*');
		$this->db->from('siswa');
		$this->db->where("sudah_milih_$type",1);		
		$data =  $this->db->get();
		return $data;
		# code...
	}
	public function dt_Siswa($post)
	{
		// untuk sort
		$columns = array(
			'NIS',
			'nama',
			'id_kelas'
			// 'p.judul',
			// 'p.created_at',
			// 'p.stok',
			// 'p.view_count',
			// 'p.harga_awal',
		);
		// untuk search
		$columnsSearch = array(
			'nama',
			// 'NIS',
			// 'id_kelas'

			// 'p.judul',
		);
		// gunakan join disini
		$from = 'siswa s';
		// custom SQL
		$sql = "SELECT *  FROM {$from}  ";
		$where = "";
		if (isset($post['id_tipe_produk']) && $post['id_tipe_produk'] != 'default') {
			if ($where != ""
			) $where .= "AND";
			$where .= " (p.id_tipe_produk='" . $post['id_tipe_produk'] . "')";
		}
		if (isset($post['id_tipe_bid']) && $post['id_tipe_bid'] != 'default') {
			if ($where != ""
			) $where .= "AND";
			$where .= " (p.id_tipe_bid='" . $post['id_tipe_bid'] . "')";
		}
		if (isset($post['status']) && $post['status'] != 'default') {
			if ($where != ""
			) $where .= "AND";
			$where .= " (p.status='" . $post['status'] . "')";
		}
		if (isset($post['dt_filter_kelengkapan']) && $post['dt_filter_kelengkapan'] != 'default') {
			if ($where != ""
			) $where .= "AND";
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
			if ($where != ''
			) $where .= " AND (" . $whereTemp . ")";
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
	public function tambah_siswa($in)
	{
		return $this->db->insert('siswa', $in);
	}
	public function getSiswaById($id_siswa)
	{
		$this->db->select('*');
		$this->db->where('id_siswa', $id_siswa);
		$query = $this->db->get('siswa s');
		return $query->result();
		# code...
	}
	public function HapusSiswa($id_siswa)
	{
		$this->db->where('id_siswa', $id_siswa);
		$this->db->delete('siswa');
		$query = $this->db->get('siswa s');

		return $query->result();


		# code...
	}
	public function edit_siswa($in, $id_siswa)
	{

		$this->db->where('id_siswa', $id_siswa);
		return $this->db->update('siswa', $in);
	}

	public function ListUserSiswa()
	{
		$this->db->from('siswa');
		$query = $this->db->get();
		return $query;
	}
	public function	GetSiswaNIS($username, $password)
	{
		$this->db->from('siswa');
		$this->db->where('nim', $username);
		$this->db->where('password', $password);
		$query = $this->db->get();
		// var_dump($this->db->last_query());
		// die();
		return $query;		
		# code...
	}
	public function	GetSiswaUName($username)
	{
		$this->db->from('siswa');
		$this->db->where('nim', $username);
		$query = $this->db->get();
		// var_dump($this->db->last_query());
		// die();
		return $query;		
		# code...
	}
	public function getSiswaByIdSiswa($id_siswa)
	{
		$this->db->select('*');
		$this->db->where('id_siswa', $id_siswa);
		$query = $this->db->get('siswa s');
		return $query;
		# code...
	}
	public function getIsUserHasChose($id_siswa,$type)
	{
		$this->db->select("sudah_milih_$type");
		$this->db->where('id_siswa', $id_siswa);
		$query = $this->db->get('siswa s');
		return $query->result();
		# code...
	}
	public function getIsUserHasChoseAndCalon($id_siswa)
	{
		$this->db->select('sudah_milih_bem,pilih_bem,waktu_pilih_bem,nama_calon');
		$this->db->where('id_siswa', $id_siswa);
		$this->db->join('calon_bem c', 'c.id_calon = s.pilih_bem');

		$query = $this->db->get('siswa s');
		return $query->result();
		# code...
	}
	public function getSiswaAndCalon($id)
	{
		$this->db->from('siswa s');
		$this->db->join('calon c', 'c.id_calon = s.pilih');
		$this->db->where('id_siswa', $id);
		return $sql = $this->db->get();
		
		
		
	}
                        
                            
                        
}
                        
/* End of file SiswaModel.php */
    
                        