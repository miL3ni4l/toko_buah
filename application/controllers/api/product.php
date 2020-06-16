<?php

require APPPATH.'libraries/REST_Controller.php';
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 
 */
class Product extends REST_Controller
{
    
    public function __construct()
    {
        parent ::__construct();
        $this->load->database();
    }

    public function index_get($id = 0)
    {
        if (!empty($id)) {
            $data = $this->db->get_where("products", ['product_id' => $id])->result();
        }else {
            $data = $this->db->get("products")->result();
        }
            $this->response($data, REST_Controller::HTTP_OK);
        // $data['products']= $this->m_product->tampil_data()->result();

        $data['contents'] ='products/index';
  //       $this->load->view('templates/index', $data);
  //       $this->load->view('templates/header',$data);
		// $this->load->view('templates/sidebar',$data);
		// $this->load->view('templates/footer',$data);

    }

    //Mengirim atau menambah data kontak baru
    // function index_post() {
    //     $data = array(
    //                 'product_id'            => $this->post('product_id'),
    //                 'name'                  => $this->post('name'),
    //                 'price'                 => $this->post('price'),
    //                 'image'                 => $this->post('image'),
    //                 'description'           => $this->post('description'),
    //                 );
    //     $insert = $this->db->insert('products', $data);
    //     if ($insert) {
    //         $this->response($data, 200);
    //     } else {
    //         $this->response(array('status' => 'fail', 502));
    //     }
    // }
    public function index_post(){
        $input = $this->input->post();
        $this->db->insert('products', $input);

        $this->response(['Product Berhasil Dibuat.'],REST_Controller::HTTP_OK);
    }

    //Memperbarui data kontak yang telah ada
       function index_put() {
        $product_id = $this->put('product_id');
        $data = array(
                    'product_id'           => $this->put('product_id'),
                    'name'                  => $this->put('name'),
                    'price'                 => $this->put('price'),
                    'image'                 => $this->put('image'),
                    'description'           => $this->put('description'),
                    );

        $this->db->where('product_id', $product_id);
        $update = $this->db->update('products', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //Menghapus salah satu data kontak
    public function index_delete() {
        $product_id = $this->delete('product_id');
        $this->db->where('product_id', $product_id);
        $delete = $this->db->delete('products');
        if ($delete) {
            $this->response(array('status' => 'Data Berhasil Dihapus'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}

?>