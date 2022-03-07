<?php
defined('BASEPATH') or exit('No direct script access allowed');

class category_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('auth_model');
        $this->load->model('category_model');
    }

    public function index()
    {
        $data['title']  = "Category";
        $data['user'] = $this->auth_model->userData();
        $data['category'] = $this->category_model->getCategory();
        $data['count'] = $this->category_model->countAllCategory();
        $this->load->view('administrator/templates_admin/header', $data);
        $this->load->view('administrator/templates_admin/topbar', $data);
        $this->load->view('administrator/templates_admin/sidebar', $data);
        $this->load->view('administrator/product/category/data-category');
        $this->load->view('administrator/templates_admin/footer');
    }

    // Add Data 
    public function addCategory()
    {
        $image = $_FILES['image']['name'];
        $category_name  = $this->input->post('category_name');
        // var_dump($image);
        // die;

        if ($image) {
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['upload_path'] = './assets/img/category';
            $config['max_size'] = '2048';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data('file_name');
                $data = array(
                    'category_name' => $category_name,
                    'category_image' => $image,
                );

                $this->category_model->addCategory($data, 'category');
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> add category. <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></div>');
                redirect('admin/category_controller');
            } else {
                // echo "image gagal di upload";
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $this->upload->display_errors() . '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></div>');
                redirect('admin/category_controller');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Failed upload<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/category_controller');
        }
    }

    // Update Data 
    public function updateCategory()
    {
        $image = $_FILES['image']['name'];
        $category_id  = $this->input->post('category_id');
        $category_name  = $this->input->post('category_name');

        // var_dump($product_id);
        // die;
        if ($image) {
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['upload_path'] = './assets/img/category';
            $config['max_size'] = '2048';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data('file_name');
                $category_id  = $this->input->post('category_id');
                $category_name  = $this->input->post('category_name');

                $data = array(
                    'category_name' => $category_name,
                    'category_image' => $image
                );
                // var_dump($data);
                // die;

                // replace image
                // $data['product'] = $this->product_model->getDetailProduct($id);

                $oldImage = $this->category_model->getDetailCategory($category_id);
                $target = 'assets/img/category/' . $oldImage[0]['category_image'];
                unlink($target);

                $this->category_model->updateCategory($category_id, $data);
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> update category.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button></div>'
                );
                redirect('admin/category_controller');
            } else {
                // echo "image gagal di upload";
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('admin/category_controller');
            }
        } else if (!$image) {
            $data = array(
                'category_name' => $category_name,
            );

            $this->category_model->updateCategory($category_id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> update category.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('admin/category_controller');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed upload</div>');
            redirect('admin/category_controller');
        }
    }

    // Delete Data Category
    public function deleteCategory($id)
    {
        $oldImage = $this->category_model->getDetailCategory($id);
        $target = 'assets/img/category/' . $oldImage[0]['category_image'];
        unlink($target);

        $this->category_model->deleteCategory($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> delete category.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('admin/category_controller');
    }
}
