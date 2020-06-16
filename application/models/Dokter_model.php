<?php  

/**
 * 
 */
class Dokter_model extends CI_Model
{

	public function getDokter($id = null)
	{
		if ($id === null)
		{
			return $this->db->get('dokter')->result_array();
		} else {
			return $this->db->get_where('dokter', ['id_dokter' => $id])->result_array();
		}
	}

	public function deleteDokter($id)
	{
		$this->db->delete('dokter', ['id_dokter' => $id]);
		return $this->db->affected_rows();
	} 

	

	function createDokter() {
        $data = array(
            'nama' 		    => $this->input->post('nama'),
            'spesialis' 	=> $this->input->post('spesialis'),
            'alamat' 	    => $this->input->post('alamat'),
            
        );
        $this->db->insert('dokter',$data);
    }
    
    function updateDokter(){
        $data = array(
            'nama' 		        => $this->input->post('nama'),
            'spesialis' 		=> $this->input->post('spesialis'),
            'alamat' 		    => $this->input->post('alamat'),
        );
        $id_dokter= $this->input->post('id_dokter');
        $this->db->where('id_dokter',$id_dokter);
        $this->db->update('dokter',$data);
    }


}