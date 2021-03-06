<?php
	
class matakuliah_model extends CI_Model{
	public function __construct(){
		$this->load->database();
	}


	//menambahkan matakuliah
	//properti:
	//	$kode_mk, $nama_mk, $sks, $penjelasan, $sap, $silabus
	public function add($kode_mk, $nama_mk, $sks, $penjelasan, $sap, $silabus){
		$data = array("kode_mk"=>$kode_mk,
								 "nama_mk"=>$nama_mk,
								 "sks"=>$sks,
								 "penjelasan"=>$penjelasan,
								 "sap"=>$sap,
								 "silabus"=>$silabus);
		$this->db->insert("matakuliah", $data);
	}


	//mendapatkan semua matakuliah
	public function get(){
		$data = $this->db->get("matakuliah");
		return $data;
	}

	//mendapatkan data matakuliah berdasarkan kodenya
	//properti:
	//	kode_mk
	public function get_by_kodemk($kode_mk){
		$this->db->select('id_mk, kode_mk, nama_mk, sks, penjelasan, sap, silabus');
		$data = $this->db->get_where("matakuliah", array("kode_mk"=>$kode_mk));
		return $data;
	}

	public function get_by_idmk($id_mk){
		
		$data = $this->db->get_where("matakuliah", array("id_mk"=>$id_mk));
		return $data;
	}

	//update
	public function update_by_idmk($id_mk,$kode_mk, $nama_mk, $sks, $penjelasan, $sap, $silabus){
		$data = array("kode_mk"=>$kode_mk,
								 "nama_mk"=>$nama_mk,
								 "sks"=>$sks,
								 "penjelasan"=>$penjelasan,
								 "sap"=>$sap,
								 "silabus"=>$silabus);

		$this->db->where("id_mk",$id_mk);
		$data = $this->db->update("matakuliah",$data);
	}

	public function delete_by_idmk($id_mk){
		
		//cek tidak ada "mk_prodi" yang menggunakan "id_mk"
		$num_mk_prodi = $this->db->get_where("mk_prodi", array("id_mk"=>$id_mk))->num_rows;

		if ($num_mk_prodi == 0) {
			$this->db->where("id_mk", $id_mk);
			$this->db->delete("matakuliah");
		}

	}
}
