<?php
defined('BASEPATH') or exit('No direct script access allowed');

class admin_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        $this->load->model('auth_model');
        $this->load->model('user_model');
        $this->load->model('order_model');
        $this->load->model('product_model');
        $this->load->model('testimoni_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        # dashboard admin
        $data['title'] = 'Dashboard';
        $data['user'] = $this->auth_model->userData();
        $data['countStatus'] = $this->order_model->countAllStatusOrder();
        $data['count'] = $this->order_model->countAllOrder();
        $data['product'] = $this->product_model->countAllProduct();
        $data['productBest'] = $this->product_model->pbestSeller();
        $data['testimoni'] = $this->testimoni_model->countAllTestimoni();
        $this->load->view('administrator/templates_admin/header', $data);
        $this->load->view('administrator/templates_admin/topbar', $data);
        $this->load->view('administrator/templates_admin/sidebar', $data);
        $this->load->view('administrator/dashboard', $data);
        $this->load->view('administrator/templates_admin/footer');
    }

    public function profileAdmin()
    {
        $data['title'] = 'Profile Admin';
        $data['user'] = $this->auth_model->userData();

        $this->form_validation->set_rules('name', 'name', 'required|trim');
        $this->form_validation->set_rules('phone', 'phone', 'required|trim');
        $this->form_validation->set_rules('address', 'address', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('administrator/templates_admin/header', $data);
            $this->load->view('administrator/templates_admin/topbar', $data);
            $this->load->view('administrator/templates_admin/sidebar', $data);
            $this->load->view('administrator/profile-user', $data);
            $this->load->view('administrator/templates_admin/footer');
        } else {
            $userId = $this->input->post('user_id');
            $name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $address = $this->input->post('address');
            $image = $this->input->post('image');

            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $config['max_size'] = '5096';
                $config['upload_path'] = './assets/img/profile';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $oldImage = $data['user']['image'];
                    if ($oldImage != 'default.svg') {
                        unlink(FCPATH . 'assets/img/profile/' . $oldImage);
                    }
                    $newImage = $this->upload->data('file_name');

                    $this->db->set('image', $newImage);

                    $data = array(
                        'user_id' => $userId,
                        'name' => $name,
                        'address' => $address,
                        'phone' => $phone,
                    );

                    $this->user_model->updateUser($userId, $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> update user.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>');
                    redirect('admin/admin_controller/profileAdmin');
                } else {
                    $message = $this->upload->display_errors();
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>' . $message . '</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button></div>');
                    redirect('admin/admin_controller/profileAdmin');
                }
            } else {
                $data = array(
                    'user_id' => $userId,
                    'name' => $name,
                    'address' => $address,
                    'phone' => $phone,
                );

                $this->user_model->updateUser($userId, $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> update user.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></div>');
                redirect('admin/admin_controller/profileAdmin');
            }
        }
    }

    public function changePassword()
    {
        #profile sisi admin
        $data['title'] = 'Change Password';
        $data['user'] = $this->auth_model->userData();

        $this->form_validation->set_rules('current_password', 'current_password', 'required|trim');
        $this->form_validation->set_rules('new_password', 'new password', 'required|trim|min_length[3]|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password', 'confirm password', 'required|trim|min_length[3]|matches[new_password]');

        if ($this->form_validation->run() == false) {
            $this->load->view('administrator/templates_admin/header', $data);
            $this->load->view('administrator/templates_admin/topbar', $data);
            $this->load->view('administrator/templates_admin/sidebar', $data);
            $this->load->view('administrator/change-password', $data);
            $this->load->view('administrator/templates_admin/footer');
        } else {
            $currentPassword = $this->input->post('current_password');
            $newPassword = $this->input->post('new_password');
            $userId = $this->input->post('user_id');
            if (!password_verify($currentPassword, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Wrong</strong> current password!.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>');
                redirect('admin/admin_controller/changePassword');
            } else {
                if ($currentPassword == $newPassword) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>New password cannot be the same as current password !</strong>. <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button></div>');
                    redirect('admin/admin_controller/changePassword');
                } else {
                    // password ok
                    $password_hash = password_hash($newPassword, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('user_id', $userId);
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success</strong> password change !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></div>');
                    redirect('admin/admin_controller/changePassword');
                }
            }
            $userId = $this->input->post('user_id');
            $password = $this->input->post('password');


            $data = array(
                'user_id' => $userId,
                'password' => $password,
            );

            $this->user_model->updateUser($userId, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> update user.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button></div>');
        }
    }
}
