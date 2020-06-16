<?php


class M_product extends CI_Model {
    public function tampil_data()
    {
        return $this->db->get('products');
    }

    public function index_post($data,$table){
		$this->db->insert($table,$data);
	}

	public function index_delete($where, $table)
	{
		$this->db->where($where);
		$this->db->delete($table);
	}

	public	function index_put(){
		return $this->db->get('products');
	}
}
