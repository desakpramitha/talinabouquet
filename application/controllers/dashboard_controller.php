<?php
defined('BASEPATH') or exit('No direct script access allowed');

class dashboard_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // is_logged_in();
        $this->load->model('auth_model');
        $this->load->model('category_model');
        $this->load->model('order_model');
        $this->load->model('product_model');
        $this->load->model('testimoni_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $lama = 1; // lama data adalah 1 hari

        // proses penghapusan data
        $this->db->query("DELETE FROM orders WHERE DATEDIFF(CURDATE(), date_order) > $lama AND status_bayar = '0'");

        // mencari orders_code yang sudah expired
        // $query = $this->db->query("SELECT orders_code FROM orders
        // WHERE DATEDIFF(CURDATE(), date_order) > $lama AND status_bayar = '0'")->result_array();

        $data['title'] = 'Talina Bouquet';
        $data['user'] = $this->auth_model->userData();
        $data['category'] = $this->category_model->getCategory();
        $data['image'] = $this->product_model->getAllImage();
        $data['product'] = $this->product_model->allProduct();
        $data['productBest'] = $this->product_model->productBestSeller();

        $this->load->view('user/templates_user/header', $data);
        $this->load->view('topbar', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('user/templates_user/footer');
    }

    public function shop()
    {
        $data['title'] = 'Shop';
        $data['user'] = $this->auth_model->userData();
        $data['category'] = $this->category_model->getCategory();
        $data['product'] = $this->product_model->getProduct();

        $this->load->view('user/templates_user/header', $data);
        $this->load->view('user/templates_user/topbar', $data);
        $this->load->view('user/shop', $data);
        $this->load->view('user/templates_user/footer');
    }

    public function shopByCategory($id)
    {
        $data['title'] = 'Shop';
        $data['user'] = $this->auth_model->userData();
        $data['category'] = $this->category_model->getCategory();
        $data['categoryName'] = $this->category_model->getCategoryById($id);
        $data['product'] = $this->product_model->getProductByCategory($id); //shop by category

        $this->load->view('user/templates_user/header', $data);
        $this->load->view('user/templates_user/topbar', $data);
        $this->load->view('user/shop-by-category', $data);
        $this->load->view('user/templates_user/footer');
    }

    public function productDetail($id)
    {
        $data['title'] = 'Product Detail';
        $data['user'] = $this->auth_model->userData();
        $data['category'] = $this->category_model->getCategory();
        $data['image'] = $this->product_model->getImage($id);
        $data['product'] = $this->product_model->getDetailProduct($id);

        $this->load->view('user/templates_user/header', $data);
        $this->load->view('user/templates_user/topbar', $data);
        $this->load->view('user/product_detail', $data);
        $this->load->view('user/templates_user/footer');
    }

    public function testimonials()
    {
        $data['title'] = 'Testimonials';
        $data['user'] = $this->auth_model->userData();
        $data['testimoni'] = $this->testimoni_model->getTestimoni();

        $this->load->view('user/templates_user/header', $data);
        $this->load->view('user/templates_user/topbar', $data);
        $this->load->view('user/testimoni/testimonials', $data);
        $this->load->view('user/templates_user/footer');
    }

    public function search()
    {
        $keyword = $this->input->post('keyword');
        $data['keyword'] = $this->input->post('keyword');
        $data['title'] = 'Result product';
        $data['user'] = $this->auth_model->userData();
        $data['category'] = $this->category_model->getCategory();
        $data['product'] = $this->product_model->search($keyword);
        $this->load->view('user/templates_user/header', $data);
        $this->load->view('user/templates_user/topbar', $data);
        $this->load->view('user/shop-search', $data);
        $this->load->view('user/templates_user/footer');
    }

    // kirim email ke admin
    public function orders()
    {
        // ambil data email dan token
        // $email = $this->input->get('email');
        $email = 'dskpolin@gmail.com';
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_order_code = $this->db->get_where('orders', ['orders_code' => $token])->row_array();
            if ($user_order_code) {
                # memberi session ketika ingin lihat order
                $this->session->set_userdata('lihat_order', $email);

                $data['title']  = "Detail Pesanan";
                $data['user'] = $this->auth_model->userData();
                $data['orders'] = $this->order_model->getOrderDetails($token);
                $data['order_product'] = $this->order_model->getOrderDetailProduct($token);

                // $this->load->view('administrator/templates_admin/header', $data);
                // $this->load->view('administrator/templates_admin/topbar', $data);
                // $this->load->view('administrator/templates_admin/sidebar', $data);
                $this->load->view('administrator/pesanan/detail-pesanan-print', $data);
                // $this->load->view('administrator/templates_admin/footer');
            } else {
                # token di url typo
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Lihat Order gagal order code tidak ditemukan!</div>');
                redirect('auth_controller/index');
            }
        } else {
            // email di url typo
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Lihat order gagal ! Wrong Email</div>');
            redirect('auth_controller/index');
        }
    }

    // kirim email ke pelanggan
    public function ordersCust()
    {
        // ambil data email dan token
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_order_code = $this->db->get_where('orders', ['orders_code' => $token])->row_array();
            if ($user_order_code) {
                # memberi session ketika ingin lihat order
                $this->session->set_userdata('lihat_order', $email);

                $data['title']  = "Detail Pesanan";
                $data['user'] = $this->auth_model->userData();
                $data['orders'] = $this->order_model->getOrderDetails($token);
                $data['order_product'] = $this->order_model->getOrderDetailProduct($token);

                // $this->load->view('user/templates_user/header', $data);
                // $this->load->view('user/templates_user/topbar', $data);
                $this->load->view('user/order/detail-pesanan-print', $data);
                // $this->load->view('user/templates_user/footer');
            } else {
                # token di url typo
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Lihat Order gagal order code tidak ditemukan!</div>');
                redirect('auth_controller/index');
            }
        } else {
            // email di url typo
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Lihat order gagal ! Wrong Email</div>');
            redirect('auth_controller/index');
        }
    }

    public function faq()
    {
        $data['title']  = "FAQ";
        $data['user'] = $this->auth_model->userData();

        $this->load->view('user/templates_user/header', $data);
        $this->load->view('user/templates_user/topbar', $data);
        $this->load->view('user/about/faq', $data);
        $this->load->view('user/templates_user/footer');
    }

    public function how()
    {
        $data['title']  = "How To Buy";
        $data['user'] = $this->auth_model->userData();

        $this->load->view('user/templates_user/header', $data);
        $this->load->view('user/templates_user/topbar', $data);
        $this->load->view('user/about/how', $data);
        $this->load->view('user/templates_user/footer');
    }

    public function ourService()
    {
        $data['title']  = "Our Service";
        $data['user'] = $this->auth_model->userData();
        $data['ship'] = $this->order_model->getShip();

        $this->load->view('user/templates_user/header', $data);
        $this->load->view('user/templates_user/topbar', $data);
        $this->load->view('user/about/how1', $data);
        $this->load->view('user/templates_user/footer');
    }

    public function shipping()
    {
        $data['title']  = "Delivery Information";
        $data['user'] = $this->auth_model->userData();
        $data['ship'] = $this->order_model->getShip();

        $this->load->view('user/templates_user/header', $data);
        $this->load->view('user/templates_user/topbar', $data);
        $this->load->view('user/about/shipping', $data);
        $this->load->view('user/templates_user/footer');
    }
}
