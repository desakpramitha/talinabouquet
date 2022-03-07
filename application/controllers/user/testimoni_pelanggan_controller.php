<?php
defined('BASEPATH') or exit('No direct script access allowed');

class testimoni_pelanggan_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('testimoni_model');
        $this->load->model('auth_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Kelola Testimoni';
        $data['user'] = $this->auth_model->userData();
        $data['testimoni'] = $this->testimoni_model->getTestimonibyUser();

        $this->load->view('user/templates_user/header', $data);
        $this->load->view('user/templates_user/topbar', $data);
        $this->load->view('user/testimoni/kelola-testimoni', $data);
        $this->load->view('user/templates_user/footer');
    }

    // Add Data sisi user
    public function addTestimoni()
    {
        $data['title'] = 'Add Testimoni';
        $data['user'] = $this->auth_model->userData();

        $this->form_validation->set_rules('description', 'description', 'required|trim');
        if (empty($_FILES['image_testimoni']['name'])) {
            $this->form_validation->set_rules('image_testimoni', 'image testimoni', 'required');
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('user/templates_user/header', $data);
            $this->load->view('user/templates_user/topbar', $data);
            $this->load->view('user/testimoni/add-testimoni', $data);
            $this->load->view('user/templates_user/footer');
        } else {
            $user_id  = $this->input->post('user_id');
            $description  = $this->input->post('description');
            $image = $_FILES['image_testimoni']['name'];

            if ($image) {
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['upload_path'] = './assets/img/testimonials';
                $config['max_size'] = '2048';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image_testimoni')) {
                    $image = $this->upload->data('file_name');
                    $data = array(
                        'user_id' => $user_id,
                        'description' => $description,
                        'image_testimoni' => $image,
                        'date' => time()
                    );

                    $this->testimoni_model->addTestimoni($data, 'testimoni');
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success add testimoni</div>');
                    redirect('user/testimoni_pelanggan_controller');
                } else {
                    // echo "image gagal di upload";
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> lalal </div>');
                    // redirect('user/testimoni_pelanggan_controller/addTestimoni');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed upload</div>');
                // redirect('user/testimoni_pelanggan_controller/addTestimoni');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    // Update Data Testimoni (user)
    public function editTestimoni($id)
    {
        $this->form_validation->set_rules('description', 'description', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Edit Testimoni';
            $data['user'] = $this->auth_model->userData();
            $data['testimoni'] = $this->testimoni_model->getTestimoniById($id);

            $this->load->view('user/templates_user/header', $data);
            $this->load->view('user/templates_user/topbar', $data);
            $this->load->view('user/testimoni/edit-testimoni', $data);
            $this->load->view('user/templates_user/footer');
        } else {

            $data['title'] = 'Edit Testimoni';
            $data['user'] = $this->auth_model->userData();
            $data['testimonials'] = $this->testimoni_model->getTestimoniById($id);

            $this->load->view('user/templates_user/header', $data);
            $this->load->view('user/templates_user/topbar', $data);
            $this->load->view('user/testimoni/edit-testimoni', $data);
            $this->load->view('user/templates_user/footer');
        }
    }

    // Update Data Testimoni (user)
    public function updateTestimoni()
    {
        $user_id  = $this->input->post('user_id');
        $testimoni_id  = $this->input->post('testimoni_id');
        $description  = $this->input->post('description');
        $image = $_FILES['image_testimoni']['name'];
        // var_dump($image);
        // die;
        if ($image) {
            if ($description) {
                # deskripsi dan image isi

                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['upload_path'] = './assets/img/testimonials';
                $config['max_size'] = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image_testimoni')) {
                    $image = $this->upload->data('file_name');
                    $testimoni_id  = $this->input->post('testimoni_id');
                    $description  = $this->input->post('description');

                    $data = array(
                        'description' => $description,
                        'image_testimoni' => $image,
                        'date' => time()
                    );

                    // replace image
                    $oldImage = $this->testimoni_model->getTestimoniById($testimoni_id);
                    $target = 'assets/img/testimoials/' . $oldImage['image'];
                    unlink($target);

                    $this->testimoni_model->updateTestimoni($testimoni_id, $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Success edit data testimoni</div>');
                    redirect('user/testimoni_pelanggan_controller');
                } else {
                    // echo "image gagal di upload";
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('user/testimoni_pelanggan_controller');
                }
            } else {
                # deskripsi kosong dan image isi

                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['upload_path'] = './assets/img/testimonials';
                $config['max_size'] = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image_testimoni')) {
                    $image = $this->upload->data('file_name');
                    $testimoni_id  = $this->input->post('testimoni_id');
                    $data = array(
                        'image_testimoni' => $image,
                        'date' => time()
                    );

                    // replace image
                    $oldImage = $this->testimoni_model->getTestimoniById($testimoni_id);
                    $target = 'assets/img/testimoials/' . $oldImage['image'];
                    unlink($target);

                    $this->testimoni_model->updateTestimoni($testimoni_id, $data);
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success edit data testimoni</div>');
                    redirect('user/testimoni_pelanggan_controller');
                } else {
                    // echo "image gagal di upload";
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('user/testimoni_pelanggan_controller');
                }
            }
        } else {
            if ($description) {
                # deskripsi isi dan image kosong
                $testimoni_id  = $this->input->post('testimoni_id');
                $description  = $this->input->post('description');
                $data = array(
                    'description' => $description,
                    'date' => time()
                );

                $this->testimoni_model->updateTestimoni($testimoni_id, $data);
                $this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Success edit data testimoni</div>');
                redirect('user/testimoni_pelanggan_controller');
            } else {
                # deskripsi kosong dan image kosong
                $testimoni_id  = $this->input->post('testimoni_id');
                $description  = $this->input->post('description');
                $data = array(
                    'date' => time()
                );

                $this->testimoni_model->updateTestimoni($testimoni_id, $data);
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Success edit data testimoni</div>');
                redirect('user/testimoni_pelanggan_controller');
            }
        }
    }

    // Delete Data User (admin)
    public function deleteTestimoni($id)
    {
        $oldImageProduct = $this->testimoni_model->getTestimoniById($id);
        $target = FCPATH . 'assets/img/testimonials/' . $oldImageProduct[0]['image_testimoni'];
        unlink($target);

        $data['testimoni'] = $this->testimoni_model->deleteTestimoni($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success delete data testimoni</div>');
        redirect('user/testimoni_pelanggan_controller/index');
    }
}
