<?php
use Restserver\Libraries\REST_Controller;
require(APPPATH . 'libraries/REST_Controller.php');
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends REST_Controller
{
    //directedAnggaDeka
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dokter_model', 'dokter');
        $this->load->library('form_validation');
        $this->BASE_API="http://localhost/toko_buah/";
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index_get()
    {
        $id = $this->get('id_dokter');
        if ($id === NULL)
        {
            $dokter = $this->dokter->getDokter();
        } else {
            $dokter = $this->dokter->getDokter($id);
        }
        if ($dokter) {
             $this->response([
                    'status' => TRUE,
                    'data' => $dokter
                ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                    'status' => FALSE,
                    'message' => 'dokter Not Found !!!'
                ], REST_Controller::HTTP_NOT_FOUND);
        }
        $this->template->load('template', 'pendaftaran/list');
        
    }
    

    public function index_delete()
    {
        $id = $this->delete('id_dokter');

        if ($id === NULL) {
            $this->response([
                    'status'    => FALSE,
                    'message'   => 'Tidak Ada Yang Dihapus'
                ], REST_Controller::HTTP_BAD_REQUEST);   
        } else {
            if ($this->dokter->deleteDokter($id) > 0) 
            {
                 $this->response([
                    'status'    => TRUE,
                    'id'        => $id_dokter,
                    'message'   => 'dokter deleted successfully'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else {
                $this->response([
                    'status'  => FALSE,
                    'message' => 'Dokter Not Found !!!'
                ], REST_Controller::HTTP_BAD_REQUEST);      
            } 
        }
    } 

     public function index_post()
     {
        $input = $this->input->post();
        $this->db->insert('dokter', $input);

      
        $this->response(['Dokter created successfully'],REST_Controller::HTTP_OK); 

     }


     public function index_put() {
        $id_dokter = $this->put('id_dokter');
        $data = array(
                    'id_dokter'                  => $this->put('id_dokter'),
                    'nama'                   => $this->put('nama'),
                    'spesialis'            => $this->put('spesialis'),
                    'alamat'                 => $this->put('alamat'),
                  
                    );

        $this->db->where('id_dokter', $id_dokter);
        $update = $this->db->update('dokter', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}