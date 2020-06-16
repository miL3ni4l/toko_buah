<?php
use Restserver\Libraries\REST_Controller;
require(APPPATH . 'libraries/REST_Controller.php');
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends REST_Controller
{
    //directedAnggaDeka
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pasien_model', 'pasien');
        $this->load->library('form_validation');
        $this->BASE_API="http://localhost/toko_buah/";
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');
    }


    public function index_get()
    {
        $id = $this->get('no_rm');
        if ($id === NULL)
        {
            $pasien = $this->pasien->getPasien();
        } else {
            $pasien = $this->pasien->getPasien($id);
        }
        if ($pasien) {
             $this->response([
                    'status' => TRUE,
                    'data' => $pasien
                ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                    'status' => FALSE,
                    'message' => 'Pasien Not Found !!!'
                ], REST_Controller::HTTP_NOT_FOUND);
        }
        $this->template->load('template', 'pendaftaran/list');

    }
    

    public function index_delete()
    {
        $id = $this->delete('no_rm');

        if ($id === NULL) {
            $this->response([
                    'status'    => FALSE,
                    'message'   => 'Tidak Ada Yang Dihapus'
                ], REST_Controller::HTTP_BAD_REQUEST);   
        } else {
            if ($this->pasien->deletePasien($id) > 0) 
            {
                 $this->response([
                    'status'    => TRUE,
                    'id'        => $no_rm,
                    'message'   => 'Pasien deleted successfully'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else {
                $this->response([
                    'status'  => FALSE,
                    'message' => 'Pasien Not Found !!!'
                ], REST_Controller::HTTP_BAD_REQUEST);      
            } 
        }
    } 

     public function index_post()
     {
        $input = $this->input->post();
        $this->db->insert('pasien', $input);

      
        $this->response(['Pasien created successfully'],REST_Controller::HTTP_OK); 

     }


     public function index_put() {
        $no_rm = $this->put('no_rm');
        $data = array(
                    'no_rm'                  => $this->put('no_rm'),
                    'nama'                   => $this->put('nama'),
                    'tipe_pasien'            => $this->put('tipe_pasien'),
                    'alamat'                 => $this->put('alamat'),
                  
                    );

        $this->db->where('no_rm', $no_rm);
        $update = $this->db->update('pasien', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}