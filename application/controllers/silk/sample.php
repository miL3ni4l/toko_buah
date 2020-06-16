<?php
require APPPATH.'libraries/REST_Controller.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class Sample extends CI_Controller 
{

	public function __construct()
	{
		  parent::__construct();
        $this->BASE_API="http://localhost/toko_buah/";
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->database();
	}
	
    
    // menampilkan data kontak
    public function index()
    {
        $data["products"] = json_decode($this->curl->simple_get($this->BASE_API.'/api/product'));
        $this->load->view("products/index", $data);
    }

}