<?php  

/**
 * 
 */
class Pasien_model extends CI_Model
{

	public function getPasien($id = null)
	{
		if ($id === null)
		{
			return $this->db->get('pasien')->result_array();
		} else {
			return $this->db->get_where('pasien', ['no_rm' => $id])->result_array();
		}
	}

	public function deletePasien($id)
	{
		$this->db->delete('pasien', ['no_rm' => $id]);
		return $this->db->affected_rows();
	} 

	

	function createPasien() {
        $data = array(
            'nama' 		    => $this->input->post('nama'),
            'tipe_pasien' 	=> $this->input->post('tipe_pasien'),
            'alamat' 	    => $this->input->post('alamat'),
            
        );
        $this->db->insert('pasien',$data);
    }
    
    function updatePasien(){
        $data = array(
             'nama' 		    => $this->input->post('nama'),
            'tipe_pasien' 		=> $this->input->post('tipe_pasien'),
            'alamat' 		    => $this->input->post('alamat'),
        );
        $no_rm= $this->input->post('no_rm');
        $this->db->where('no_rm',$no_rm);
        $this->db->update('pasien',$data);
    }


}