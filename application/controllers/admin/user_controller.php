<?php
defined('BASEPATH') or exit('No direct script access allowed');

class user_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('auth_model');
        $this->load->model('user_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title']  = "User";
        $data['user'] = $this->auth_model->userData();
        $data['users'] = $this->user_model->getUser()->result_array();
        $data['role'] = $this->user_model->getRole();
        $data['count'] = $this->user_model->countAllUser();
        $data['statusUser'] = $this->user_model->countAllStatusUser();
        $data['roleUser'] = $this->user_model->countRoleUser();

        $this->load->view('administrator/templates_admin/header', $data);
        $this->load->view('administrator/templates_admin/topbar', $data);
        $this->load->view('administrator/templates_admin/sidebar', $data);
        $this->load->view('administrator/user/data-user', $data);
        $this->load->view('administrator/templates_admin/footer');
    }

    public function role()
    {
        $data['title']  = "Role";
        $data['user'] = $this->auth_model->userData();
        $data['role'] = $this->user_model->getRole();
        $data['count'] = $this->user_model->countAllRole();

        $this->load->view('administrator/templates_admin/header', $data);
        $this->load->view('administrator/templates_admin/topbar', $data);
        $this->load->view('administrator/templates_admin/sidebar', $data);
        $this->load->view('administrator/user/data-role', $data);
        $this->load->view('administrator/templates_admin/footer');
    }

    // Add Data sisi admin
    public function addUser()
    {
        $this->form_validation->set_rules('name', 'name', 'required|trim', ['required' => 'Please fill out this name field !']);
        $this->form_validation->set_rules('address', 'address', 'required', ['required' => 'Please fill out this address field !']);
        $this->form_validation->set_rules('phone', 'phone', 'required', ['required' => 'Please fill out this phone field !']);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', ['is_unique' => 'This email has already registered!']);
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]|matches[repeatPassword]', ['required' => 'Please fill password!', 'matches' => 'Password dont match!', 'min_length' => 'Password too short!']);
        $this->form_validation->set_rules('repeatPassword', 'Repeat Password', 'required|trim|matches[password]', ['required' => 'Please fill repeat password!', 'matches' => 'Password dont match!']);
        $this->form_validation->set_rules('role_id', 'role', 'required', ['required' => 'Please choose this role field !']);
        $this->form_validation->set_rules('is_active', 'status', 'required', ['required' => 'Please choose this status field !']);


        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $name  = $this->input->post('name');
            $address  = $this->input->post('address');
            $phone  = $this->input->post('phone');
            $email  = $this->input->post('email');
            $password  =  password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            $role_id = $this->input->post('role_id');
            $is_active = $this->input->post('is_active');

            $data = array(
                'name' => $name,
                'address' => $address,
                'phone' => $phone,
                'email' => $email,
                'password' => $password,
                'image' => 'default.svg',
                'role_id' => $role_id,
                'is_active' => $is_active,
                'date_created' => time()
            );
            // var_dump($data);
            // die;
            $this->user_model->insertUser($data, 'user');
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> add user.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button></div>');
            redirect('admin/user_controller/index');
        }
    }

    // redirect ke halaman edit
    public function editUser($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', ['is_unique' => 'This email has already registered!']);
        $this->form_validation->set_rules('password', 'Password', 'min_length[3]|matches[repeatPassword]', ['matches' => 'Password dont match!', 'min_length' => 'Pasword too short!']);
        $this->form_validation->set_rules('repeatPassword', 'Repeat Password', 'matches[password]', ['matches' => 'Password dont match!']);

        if ($this->form_validation->run() == false) {
            $data['title']  = "Edit User";
            $data['user'] = $this->auth_model->userData();
            $data['users'] = $this->user_model->getUserByUserId($id);
            $data['role'] = $this->user_model->getRole($id);

            $this->load->view('administrator/templates_admin/header', $data);
            $this->load->view('administrator/templates_admin/topbar', $data);
            $this->load->view('administrator/templates_admin/sidebar', $data);
            $this->load->view('administrator/user/edit-user', $data);
            $this->load->view('administrator/templates_admin/footer');
        } else {
            $this->UpdateUser();
        }
    }

    // Update Data User (admin)
    public function updateUser()
    {

        $userId = $this->input->post('user_id');
        $password = $this->input->post('password');

        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['upload_path'] = './assets/img/profile';
        $config['max_size'] = '5096';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            if ($password) {
                # upload dan pass isi
                $image = $this->upload->data();
                $image = $image['file_name'];
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $address = $this->input->post('address');
                $phone = $this->input->post('phone');
                $role_id = $this->input->post('role_id');
                $is_active = $this->input->post('is_active');
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);


                $data = array(
                    'user_id' => $userId,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                    'role_id' => $role_id,
                    'is_active' => $is_active,
                    'password' => $password,
                    'image' => $image
                );
                // var_dump($data);
                // die;

                // replace image
                $oldImage = $this->user_model->getUser($userId)->row_array();
                $target = 'assets/img/profile/' . $oldImage['image'];
                unlink($target);

                $this->user_model->updateUser($userId, $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> update user.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button></div>');
                redirect('admin/user_controller/index');
            } else {
                # upload isi dan pass kosong
                $image = $this->upload->data();
                $image = $image['file_name'];
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $address = $this->input->post('address');
                $phone = $this->input->post('phone');
                $role_id = $this->input->post('role_id');
                $is_active = $this->input->post('is_active');

                if ($image) {
                    $data = array(
                        'user_id' => $userId,
                        'name' => $name,
                        'email' => $email,
                        'address' => $address,
                        'phone' => $phone,
                        'role_id' => $role_id,
                        'is_active' => $is_active,
                        'image' => $image
                    );

                    // replace image
                    $oldImage = $this->user_model->getUser($userId)->row_array();
                    $target = 'assets/img/profile/' . $oldImage['image'];
                    unlink($target);

                    $this->user_model->updateUser($userId, $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> update user.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button></div>');
                    redirect('admin/user_controller/index');
                }
            }
        } elseif (!$this->upload->do_upload('image')) {
            if ($password) {
                # upload kosong dan pass isi
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $address = $this->input->post('address');
                $phone = $this->input->post('phone');
                $role_id = $this->input->post('role_id');
                $is_active = $this->input->post('is_active');
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

                $data = array(
                    'user_id' => $userId,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'password' => $password,
                    'phone' => $phone,
                    'role_id' => $role_id,
                    'is_active' => $is_active
                );

                $this->user_model->updateUser($userId, $data);
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> update user.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>');
                redirect('admin/user_controller/index');
            } else {
                #upload kosong dan passwod kosong
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $address = $this->input->post('address');
                $phone = $this->input->post('phone');
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $role_id = $this->input->post('role_id');
                $is_active = $this->input->post('is_active');

                $data = array(
                    'user_id' => $userId,
                    'name' => $name,
                    'email' => $email,
                    'address' => $address,
                    'phone' => $phone,
                    'role_id' => $role_id,
                    'is_active' => $is_active
                );

                $this->user_model->updateUser($userId, $data);
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Success!</strong> update user.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button></div>');
                redirect('admin/user_controller/index');
            }
        } else {
            echo $this->upload->display_errors();
        }


        // if (!$this->upload->do_upload('image') and $password == "") {
        //     #upload kosong dan passwod kosong
        //     $name = $this->input->post('name');
        //     $email = $this->input->post('email');
        //     $address = $this->input->post('address');
        //     $phone = $this->input->post('phone');
        //     $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        //     $role_id = $this->input->post('role_id');
        //     $is_active = $this->input->post('is_active');

        //     $data = array(
        //         'user_id' => $userId,
        //         'name' => $name,
        //         'email' => $email,
        //         'address' => $address,
        //         'phone' => $phone,
        //         'role_id' => $role_id,
        //         'is_active' => $is_active
        //     );

        //     $this->user_model->updateUser($userId, $data);
        //     $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        //     <strong>Success!</strong> update user.
        //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //     <span aria-hidden="true">&times;</span>
        //     </button></div>');
        //     redirect('user_controller/index');
        // } else if ($this->upload->do_upload('image') and $password == "") {
        //     # upload isi dan pass kosong
        //     $image = $this->upload->data();
        //     $image = $image['file_name'];
        //     $name = $this->input->post('name');
        //     $email = $this->input->post('email');
        //     $address = $this->input->post('address');
        //     $phone = $this->input->post('phone');
        //     $role_id = $this->input->post('role_id');
        //     $is_active = $this->input->post('is_active');

        //     if ($image) {
        //         $data = array(
        //             'user_id' => $userId,
        //             'name' => $name,
        //             'email' => $email,
        //             'address' => $address,
        //             'phone' => $phone,
        //             'role_id' => $role_id,
        //             'is_active' => $is_active,
        //             'image' => $image
        //         );

        //         // replace image
        //         $oldImage = $this->user_model->getUser($userId)->row_array();
        //         $target = 'assets/img/profile/' . $oldImage['image'];
        //         unlink($target);

        //         $this->user_model->updateUser($userId, $data);
        //         $this->session->set_flashdata('message', '<div class="alert alert-info alert-dismissible fade show" role="alert">
        //             <strong>Success!</strong> update user.
        //             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //             <span aria-hidden="true">&times;</span>
        //             </button></div>');
        //         redirect('user_controller/index');
        //     } else {
        //         echo $this->upload->display_errors();
        //     }
        // } else if (!$this->upload->do_upload('image') and $password) {
        //     # upload kosong dan pass isi
        //     $name = $this->input->post('name');
        //     $email = $this->input->post('email');
        //     $address = $this->input->post('address');
        //     $phone = $this->input->post('phone');
        //     $role_id = $this->input->post('role_id');
        //     $is_active = $this->input->post('is_active');
        //     $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

        //     $data = array(
        //         'user_id' => $userId,
        //         'name' => $name,
        //         'email' => $email,
        //         'address' => $address,
        //         'password' => $password,
        //         'phone' => $phone,
        //         'role_id' => $role_id,
        //         'is_active' => $is_active
        //     );

        //     $this->user_model->updateUser($userId, $data);
        //     $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        //         <strong>Success!</strong> update user.
        //         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //         <span aria-hidden="true">&times;</span>
        //         </button></div>');
        //     redirect('user_controller/index');
        // } else {
        //     # upload dan pass isi
        //     $image = $this->upload->data();
        //     $image = $image['file_name'];
        //     $name = $this->input->post('name');
        //     $email = $this->input->post('email');
        //     $address = $this->input->post('address');
        //     $phone = $this->input->post('phone');
        //     $role_id = $this->input->post('role_id');
        //     $is_active = $this->input->post('is_active');
        //     $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);


        //     $data = array(
        //         'user_id' => $userId,
        //         'name' => $name,
        //         'email' => $email,
        //         'address' => $address,
        //         'phone' => $phone,
        //         'role_id' => $role_id,
        //         'is_active' => $is_active,
        //         'password' => $password,
        //         'image' => $image
        //     );
        //     // var_dump($data);
        //     // die;

        //     // replace image
        //     $oldImage = $this->user_model->getUser($userId)->row_array();
        //     $target = 'assets/img/profile/' . $oldImage['image'];
        //     unlink($target);

        //     $this->user_model->updateUser($userId, $data);
        //     $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        //     <strong>Success!</strong> update user.
        //     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        //     <span aria-hidden="true">&times;</span>
        //     </button></div>');
        //     redirect('user_controller/index');
        // }
        // }
    }

    // Delete Data User (admin)
    public function deleteUser($user_id)
    {
        $data['user'] = $this->user_model->deleteUser($user_id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> delete user.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('admin/user_controller/index');
    }

    // Add Data Role
    public function addRole()
    {
        $role_name  = $this->input->post('role_name');

        $data = array(
            'role_name' => $role_name
        );
        $this->user_model->insertRole($data, 'role');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> add role.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('admin/user_controller/role');
    }

    // Update Data Role
    public function updateRole()
    {
        $role_id  = $this->input->post('role_id');
        $role_name  = $this->input->post('role_name');

        $data = array(
            'role_id' => $role_id,
            'role_name' => $role_name
        );

        $this->user_model->updateRole($role_id, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong>  update role.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('admin/user_controller/role');
    }

    // Delete Data Role
    public function deleteRole($id)
    {
        $data['role'] = $this->user_model->deleteRole($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> delete role.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('admin/user_controller/role');
    }
}
