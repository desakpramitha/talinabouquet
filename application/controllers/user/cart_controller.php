<?php
defined('BASEPATH') or exit('No direct script access allowed');

class cart_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        $this->load->model('auth_model');
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Cart';
        $data['user'] = $this->auth_model->userData();

        $this->load->view('user/templates_user/header', $data);
        $this->load->view('user/templates_user/topbar', $data);
        $this->load->view('user/cart', $data);
        $this->load->view('user/templates_user/footer');
    }

    public function addCart()
    {
        $id = $this->input->post('id');
        $qty = $this->input->post('qty');
        $price = $this->input->post('price');
        $name = $this->input->post('name');
        $image = $this->input->post('image');

        $data = array(
            'id' => $id,
            'qty' => $qty,
            'price' => $price,
            'name' => $name,
            'image' => $image,
        );

        $this->cart->insert($data);
        redirect('user/cart_controller');
        // redirect($_SERVER['HTTP_REFERER'], $data);
    }

    public function updateCart()
    {
        $i = 1;
        foreach ($this->cart->contents() as $items) {
            $data = array(
                'rowid' => $items['rowid'],
                'qty'   => $this->input->post($i . '[qty]')
            );
            $this->cart->update($data);
            $i++;
        }

        redirect('user/cart_controller');
    }

    public function deleteCart($rowid)
    {
        $this->cart->remove($rowid);
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function clearCart()
    {
        $this->cart->destroy();
        redirect($_SERVER['HTTP_REFERER']);
    }
}
