<?php
defined('BASEPATH') or exit('No direct script access allowed');

class product_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->helper('url');
        $this->load->model('auth_model');
        $this->load->model('product_model');
        $this->load->model('category_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title']  = "Product";
        $data['user'] = $this->auth_model->userData();
        $data['product'] = $this->product_model->getProduct();
        $data['category'] = $this->category_model->getCategory();
        $data['count'] = $this->product_model->countAllProduct();

        $this->load->view('administrator/templates_admin/header', $data);
        $this->load->view('administrator/templates_admin/topbar', $data);
        $this->load->view('administrator/templates_admin/sidebar', $data);
        $this->load->view('administrator/product/data-product', $data);
        $this->load->view('administrator/templates_admin/footer');
    }

    // Lihat detail data produk_id
    public function viewProduct($id)
    {
        $data['title']  = "Product Detail";
        $data['user'] = $this->auth_model->userData();
        $data['product'] = $this->product_model->getDetailProduct($id);
        $data['image'] = $this->product_model->getImage($id);

        $this->load->view('administrator/templates_admin/header', $data);
        $this->load->view('administrator/templates_admin/sidebar', $data);
        $this->load->view('administrator/templates_admin/topbar', $data);
        $this->load->view('administrator/product/view-product', $data);
        $this->load->view('administrator/templates_admin/footer');
    }

    // Add Data Produk
    public function addProduct()
    {
        $this->form_validation->set_rules('product_name', 'product name', 'required|trim', ['required' => 'Please fill out this product name field !']);
        $this->form_validation->set_rules('category_id', 'category', 'required', ['required' => 'Please choose this category field !']);
        $this->form_validation->set_rules('price', 'price', 'required|trim', ['required' => 'Please fill out this price field !']);
        $this->form_validation->set_rules('description', 'description', 'required|trim', ['required' => 'Please fill out this description field !']);

        if (empty($_FILES['image_product']['name'])) {
            $this->form_validation->set_rules('image_product', 'image product', 'required', ['required' => 'Please insert product image !']);
        }

        if ($this->form_validation->run() == false) {
            $data['title']  = "Add Product";
            $data['user'] = $this->auth_model->userData();
            $data['product'] = $this->product_model->getProduct();
            $data['category'] = $this->category_model->getCategory();

            $this->load->view('administrator/templates_admin/header', $data);
            $this->load->view('administrator/templates_admin/topbar', $data);
            $this->load->view('administrator/templates_admin/sidebar', $data);
            $this->load->view('administrator/product/add-product', $data);
            $this->load->view('administrator/templates_admin/footer');
        } else {
            $product_name  = $this->input->post('product_name');
            $category_id  = $this->input->post('category_id');
            $price  = $this->input->post('price');
            $description  = $this->input->post('description');
            $image_product = $_FILES['image_product']['name'];

            if ($image_product) {
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['upload_path'] = './assets/img/uploads';
                $config['max_size'] = '2048';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image_product')) {
                    $image_product = $this->upload->data('file_name');

                    $data = array(
                        'product_name' => $product_name,
                        'category_id' => $category_id,
                        'price' => $price,
                        'description' => $description,
                        'image_product' => $image_product
                    );

                    $this->product_model->addProduct($data, 'product');
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> add product.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button></div>'
                    );
                    redirect('admin/product_controller');
                } else {
                    // echo "image gagal di upload";
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('admin/product_controller/addProduct');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-dsnger" role="alert">Failed upload</div>');
                redirect('admin/product_controller');
            }
        }
    }

    // Edit data produk by id
    public function editProduct($id)
    {
        $this->form_validation->set_rules('product_name', 'product name', 'required|trim', ['required' => 'Please fill out this product name field !']);
        $this->form_validation->set_rules('category_id', 'category', 'required', ['required' => 'Please choose this category field !']);
        $this->form_validation->set_rules('price', 'price', 'required|trim', ['required' => 'Please fill out this price field !']);
        $this->form_validation->set_rules('description', 'description', 'required|trim', ['required' => 'Please fill out this description field !']);

        if ($this->form_validation->run() == false) {

            $data['title']  = "Edit Product";
            $data['user'] = $this->auth_model->userData();
            $data['product'] = $this->product_model->getDetailProduct($id);
            $data['category'] = $this->category_model->getCategory();

            $this->load->view('administrator/templates_admin/header', $data);
            $this->load->view('administrator/templates_admin/topbar', $data);
            $this->load->view('administrator/templates_admin/sidebar', $data);
            $this->load->view('administrator/product/edit-product', $data);
            $this->load->view('administrator/templates_admin/footer');
        } else {
            $this->updateProduct();
        }
    }

    // Update data produk
    public function updateProduct()
    {
        $image_product = $_FILES['image_product']['name'];
        $product_name  = $this->input->post('product_name');
        $category_id  = $this->input->post('category_id');
        $price  = $this->input->post('price');
        $description  = $this->input->post('description');
        $product_id  = $this->input->post('product_id');
        // var_dump($product_id);
        // die;
        if ($image_product) {
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['upload_path'] = './assets/img/uploads';
            $config['max_size'] = '2048';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image_product')) {
                $image_product = $this->upload->data('file_name');
                $product_id  = $this->input->post('product_id');

                $data = array(
                    'product_id' => $product_id,
                    'product_name' => $product_name,
                    'category_id' => $category_id,
                    'price' => $price,
                    'description' => $description,
                    'image_product' => $image_product
                );

                // replace image
                // $data['product'] = $this->product_model->getDetailProduct($id);

                $oldImage = $this->product_model->getDetailProduct($product_id);
                $target = 'assets/img/uploads/' . $oldImage[0]['image_product'];
                unlink($target);

                $this->product_model->updateProduct($product_id, $data);
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> add product.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button></div>'
                );
                redirect('admin/product_controller');
            } else {
                // echo "image gagal di upload";
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect('admin/product_controller/updateProduct');
            }
        } else if (!$image_product) {
            $data = array(
                'product_name' => $product_name,
                'category_id' => $category_id,
                'price' => $price,
                'description' => $description,
            );

            $this->product_model->updateProduct($product_id, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> update product.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button></div>');
            redirect('admin/product_controller');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-dsnger" role="alert">Failed upload</div>');
            redirect('admin/product_controller/updateProduct');
        }
    }

    // Delete Data Product
    public function deleteProduct($id)
    {

        $oldImage = $this->product_model->getDetailProduct($id);
        $target = FCPATH . 'assets/img/uploads/' . $oldImage[0]['image_product'];
        unlink($target);
        $data['product'] = $this->product_model->deleteProduct($id);

        // delete data foto di tabel image_product
        $oldImageProduct = $this->product_model->getImage($id);
        $target = FCPATH . 'assets/img/uploads/' . $oldImageProduct[0]['image_name'];
        unlink($target);
        $this->db->delete('image_product', ['product_id' => $id]);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> delete product.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('admin/product_controller');
    }

    // Menampilkan List Data Image
    public function dataImage()
    {
        $data['title']  = "List Image Product";
        $data['user'] = $this->auth_model->userData();
        $data['product'] = $this->product_model->getProductImages();
        $data['category'] = $this->category_model->getCategory();
        $data['count'] = $this->product_model->countAllProduct();

        $this->load->view('administrator/templates_admin/header', $data);
        $this->load->view('administrator/templates_admin/topbar', $data);
        $this->load->view('administrator/templates_admin/sidebar', $data);
        $this->load->view('administrator/product/image-product/data-image-product', $data);
        $this->load->view('administrator/templates_admin/footer');
    }

    // Add data image per product id 
    public function addImage($id)
    {

        if (empty($_FILES['image_product']['name'])) {
            $this->form_validation->set_rules('image_product', 'image product', 'required', ['required' => 'Please insert image product !']);
        }

        if ($this->form_validation->run() == false) {
            $data['title']  = "Add Image";
            $data['user'] = $this->auth_model->userData();
            $data['product'] = $this->product_model->getDetailProduct($id);
            $data['image'] = $this->product_model->getImage($id);

            $this->load->view('administrator/templates_admin/header', $data);
            $this->load->view('administrator/templates_admin/topbar', $data);
            $this->load->view('administrator/templates_admin/sidebar', $data);
            $this->load->view('administrator/product/image-product/add-image-product', $data);
            $this->load->view('administrator/templates_admin/footer');
        } else {
            $this->addImageProduct();
        }
    }

    // Add data image per produk 
    public function addImageProduct()
    {
        $product_id  = $this->input->post('product_id');
        $image = $_FILES['image_product']['name'];

        if ($image) {
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['upload_path'] = './assets/img/uploads';
            $config['max_size'] = '2048';

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image_product')) {
                $image = $this->upload->data('file_name');
                $product_id  = $this->input->post('product_id');
                $data = array(
                    'product_id' => $product_id,
                    'image_name' => $image,
                );

                $this->product_model->addProduct($data, 'image_product');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success add product</div>');
                // redirect('admin/product_controller/dataImage');
                redirect($_SERVER['HTTP_REFERER'], $data);
            } else {
                // echo "image gagal di upload";
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed upload</div>');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    // Delete Data Image per produk
    public function deleteImageProduct($id)
    {
        // replace image
        $oldImage = $this->product_model->getImg($id);
        $target = 'assets/img/uploads/' . $oldImage['image_name'];
        unlink($target);

        $this->product_model->deleteImageProduct($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> delete image product.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect($_SERVER['HTTP_REFERER']);
    }

    // // menampilkan halaman kelola data image per produk
    // public function imageProduct($id)
    // {
    //     $data['title']  = "Product Detail";
    //     $data['user'] = $this->auth_model->userData();
    //     $data['product'] = $this->product_model->getDetailProduct($id);
    //     $data['image'] = $this->product_model->getImage($id)->result_array();

    //     $this->load->view('administrator/templates_admin/header', $data);
    //     $this->load->view('administrator/templates_admin/topbar', $data);
    //     $this->load->view('administrator/templates_admin/sidebar', $data);
    //     $this->load->view('administrator/product/image-product', $data);
    //     $this->load->view('administrator/templates_admin/footer');
    // }



    // public function updateImageProduct()
    // {
    //     $imageId  = $this->input->post('image_id');
    //     $image = $_FILES['image']['name'];

    //     if ($image) {
    //         $config['allowed_types'] = 'jpg|jpeg|png|gif';
    //         $config['upload_path'] = './assets/img/uploads';
    //         $config['max_size'] = '2048';

    //         $this->load->library('upload', $config);
    //         if ($this->upload->do_upload('image')) {
    //             $image = $this->upload->data('file_name');
    //             $data = array(
    //                 'image_id' => $imageId,
    //                 'image_name' => $image,
    //             );

    //             // replace image
    //             $oldImage = $this->product_model->getImg($imageId);
    //             $target = 'assets/img/uploads/' . $oldImage['image_name'];
    //             unlink($target);

    //             $this->product_model->updateImageProduct($imageId, $data);
    //             $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success add product</div>');
    //             // redirect('admin/product_controller');
    //             redirect($_SERVER['HTTP_REFERER'], $data);
    //         } else {
    //             // echo "image gagal di upload";
    //             $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
    //             redirect('admin/product_controller');
    //         }
    //     } else {
    //         $this->session->set_flashdata('message', '<div class="alert alert-dsnger" role="alert">Failed upload</div>');
    //         redirect('admin/product_controller');
    //     }
    // }



    // public function galleryProduct()
    // {
    //     $data['title'] = 'Gallery';
    //     $data['user'] = $this->auth_model->userData();
    //     $data['product'] = $this->product_model->getProducts();
    //     // $data['image'] = $this->db->get_where('image_product', ['product_id' => $data['product']['image']])->result_array();
    //     // var_dump($data['product']);
    //     // die;
    //     $data['category'] = $this->category_model->getCategory();
    //     $this->load->view('administrator/templates_admin/header', $data);
    //     $this->load->view('administrator/templates_admin/topbar', $data);
    //     $this->load->view('administrator/templates_admin/sidebar', $data);
    //     $this->load->view('administrator/product/gallery', $data);
    //     $this->load->view('administrator/templates_admin/footer');
    // }
}
