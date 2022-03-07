<?php
defined('BASEPATH') or exit('No direct script access allowed');

class testimoni_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('auth_model');
        $this->load->model('testimoni_model');
    }

    public function index()
    {
        $data['title']  = "Testimonials";
        $data['user'] = $this->auth_model->userData();
        $data['testimoni'] = $this->testimoni_model->getTestimoni();
        $data['count'] = $this->testimoni_model->countAllTestimoni();
        // var_dump($data['testimoni']);
        // die;
        $this->load->view('administrator/templates_admin/header', $data);
        $this->load->view('administrator/templates_admin/topbar', $data);
        $this->load->view('administrator/templates_admin/sidebar', $data);
        $this->load->view('administrator/testimoni/data-testimoni', $data);
        $this->load->view('administrator/templates_admin/footer');
    }

    // Delete Data User (admin)
    public function deleteTestimoni($id)
    {
        $data['testimoni'] = $this->testimoni_model->deleteTestimoni($id);
        // isi juga unlink gambar di file uploads testimoni
        $oldImageProduct = $this->testimoni_model->getTestimoniById($id);
        $target = FCPATH . 'assets/img/testimonials/' . $oldImageProduct[0]['image_testimoni'];
        unlink($target);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> delete testimoni. <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></div>');
        redirect('admin/testimoni_controller/index');
    }
}
