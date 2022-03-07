<?php
defined('BASEPATH') or exit('No direct script access allowed');

class order_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        $this->load->model('auth_model');
        $this->load->model('order_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('shipping_method', 'shipping method', 'required|trim', ['required' => 'Please choose this shipping method field!']);
        $this->form_validation->set_rules('pelanggan_name', 'Name', 'required', ['required' => 'Please fill out this name field !']);
        // $this->form_validation->set_rules('pelanggan_phone', 'Phone', 'required|trim', ['required' => 'Please fill out this phone field !']);
        $this->form_validation->set_rules('pelanggan_phone', 'Phone', 'required|trim|regex_match[/^[0-9]/]', ['required' => 'Please fill out this phone field !']); //{10} for 10 digits number
        $this->form_validation->set_rules('pelanggan_address', 'Address', 'required|trim', ['required' => 'Please fill out this address field !']);
        $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required|trim', ['required' => 'Please choose this kabupaten field !']);
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim', ['required' => 'Please choose this kecamatan field !']);
        $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|trim', ['required' => 'Please fill out this kode pos field !']);
        $this->form_validation->set_rules('date_pengiriman', 'Tanggal pengiriman', 'required', 'regex_match[(0[1-9]|1[0-9]|2[0-9]|3(0|1))-(0[1-9]|1[0-2])-\d{4}]');
        // $this->form_validation->set_rules('note', 'Note', 'required|trim', ['required' => 'Please fill out this note field !']);


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Checkout';
            $data['user'] = $this->auth_model->userData();
            $data['kab'] = $this->order_model->getKabupaten();
            $data['ship'] = $this->order_model->getShip();

            $this->load->helper('string');
            $this->load->view('user/templates_user/header', $data);
            $this->load->view('user/templates_user/topbar', $data);
            $this->load->view('user/order/checkout', $data);
            $this->load->view('user/templates_user/footer');
        } else {
            $user_id = $this->input->post('user_id');
            $no_order = $this->input->post('no_order');
            $ship_id = $this->input->post('shipping_method');
            $name = $this->input->post('pelanggan_name');
            $phone = $this->input->post('pelanggan_phone');
            $address = $this->input->post('pelanggan_address');
            $id_kab = $this->input->post('kabupaten');
            $id_kec = $this->input->post('kecamatan');
            $kode_pos = $this->input->post('kode_pos');
            $date_pengiriman = $this->input->post('date_pengiriman');
            $date_kirim = strtotime($date_pengiriman);
            $date = date("Y-m-d H:i:s", $date_kirim);
            $note = $this->input->post('note');
            $total = $this->input->post('total');
            $grandtotal = $this->input->post('grandTotal');

            // simpan ke tabel orders
            $data = array(
                'user_id' => $user_id,
                'orders_code' => $no_order,
                'date_order' => date("Y-m-d H:i:s"),
                'date_pengiriman' => $date,
                'pelanggan_name' => $name,
                'pelanggan_phone' => $phone,
                'pelanggan_address' => $address,
                'id_kab' => $id_kab,
                'id_kec' => $id_kec,
                'kode_pos' => $kode_pos,
                'note' => $note,
                'ship_id' => $ship_id,
                'grand_total' => $total,
                'total_bayar' => $grandtotal,
                'status' => '0'
            );

            $this->order_model->addOrders($data, 'orders');

            //simpan ke table order detail
            $i = 1;
            foreach ($this->cart->contents() as $items) {
                $data_order_detail = array(
                    'orders_code' => $no_order,
                    'product_id' => $items['id'],
                    'qty' => $this->input->post('qty' . $i++),
                );
                $this->order_model->addOrderDetail($data_order_detail, 'order_detail');
            }
            $this->cart->destroy();

            // TOKEN
            $token = $no_order;
            $user_token = [
                'email' => $this->session->userdata('email'),
                'token' => $token,
                'date_created' => time()
            ];

            // $this->auth_model->insertUser($data, 'user');
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'orders'); // kirim email ke admin
            $this->_sendEmailCust($token, 'orders_customer', $this->session->userdata('email')); // kirim email ke pelanggan

            // $this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Congratulation! your account has been created. Check your email to Activated your account!</div>');
            redirect('user/order_controller/order/' . $no_order);
        }
    }

    // kirim ke admin
    private function _sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'talinabouquet@gmail.com',
            'smtp_pass' => 'bouquettalina123',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        // kirim email dari.. ke ..
        $this->email->from('talinabouquet@gmail.com', 'Talina Bouquet');
        $this->email->to('dskpolin@gmail.com');

        // cek type parameter send email
        if ($type == 'orders') {
            $this->email->subject('New Order');
            $this->email->message(
                'Ordered has been record: <a class="btn btn-primary" href="' . base_url() . 'dashboard_controller/orders?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Check New Order</a>'
            );
        }
        // elseif ($type == 'orders_customer') {
        //     $this->email->subject('Your Order');
        //     $this->email->message(
        //         'Ordered has been record: <a class="btn btn-primary" href="' . base_url() . 'user/order_controller/orders?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Check New Order</a>'
        //     );
        // }
        // elseif ($type == 'order_canceled') {
        //     $this->email->subject('Order has been canceled');
        //     $this->email->message('Your Order has been canceled: <a class="btn btn-primary" href="' . base_url() . 'auth_controller/resetPassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        // }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    // kirim ke pelanggan
    private function _sendEmailCust($token, $type, $email)
    {
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'talinabouquet@gmail.com',
            'smtp_pass' => 'bouquettalina123',
            'smtp_port' => 465,
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        // kirim email dari.. ke ..
        $this->email->from('talinabouquet@gmail.com', 'Talina Bouquet');
        $this->email->to($email);

        // cek type parameter send email
        if ($type == 'orders_customer') {
            $this->email->subject('Thank you for your order');
            $this->email->message(
                'Your new order: <a class="btn btn-primary" href="' . base_url() . 'dashboard_controller/ordersCust?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Check Your Order</a>'

            );
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }

        // if ($type == 'orders') {
        //     $this->email->subject('New Order');
        //     $this->email->message(
        //         'Ordered has been record: <a class="btn btn-primary" href="' . base_url() . 'user/order_controller/orders?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Check New Order</a>'
        //     );
        // }
        // elseif ($type == 'order_canceled') {
        //     $this->email->subject('Order has been canceled');
        //     $this->email->message('Your Order has been canceled: <a class="btn btn-primary" href="' . base_url() . 'auth_controller/resetPassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        // }
    }


    // public function index()
    // {
    //     $this->form_validation->set_rules('shipping_method', 'shipping method', 'required|trim', ['required' => 'Please choose this shipping method field!']);
    //     $this->form_validation->set_rules('pelanggan_name', 'Name', 'required', ['required' => 'Please fill out this name field !']);
    //     // $this->form_validation->set_rules('pelanggan_phone', 'Phone', 'required|trim', ['required' => 'Please fill out this phone field !']);
    //     $this->form_validation->set_rules('pelanggan_phone', 'Phone', 'required|trim|regex_match[/^[0-9]/]', ['required' => 'Please fill out this phone field !']); //{10} for 10 digits number
    //     $this->form_validation->set_rules('pelanggan_address', 'Address', 'required|trim', ['required' => 'Please fill out this address field !']);
    //     $this->form_validation->set_rules('kabupaten', 'Kabupaten', 'required|trim', ['required' => 'Please choose this kabupaten field !']);
    //     $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required|trim', ['required' => 'Please choose this kecamatan field !']);
    //     $this->form_validation->set_rules('kode_pos', 'Kode Pos', 'required|trim', ['required' => 'Please fill out this kode pos field !']);
    //     $this->form_validation->set_rules('date_pengiriman', 'Tanggal pengiriman', 'required', 'regex_match[(0[1-9]|1[0-9]|2[0-9]|3(0|1))-(0[1-9]|1[0-2])-\d{4}]');
    //     $this->form_validation->set_rules('note', 'Note', 'required|trim', ['required' => 'Please fill out this note field !']);


    //     if ($this->form_validation->run() == false) {
    //         $data['title'] = 'Checkout';
    //         $data['user'] = $this->auth_model->userData();
    //         $data['kab'] = $this->order_model->getKabupaten();
    //         $data['ship'] = $this->order_model->getShip();

    //         $this->load->helper('string');
    //         $this->load->view('user/templates_user/header', $data);
    //         $this->load->view('user/templates_user/topbar', $data);
    //         $this->load->view('user/order/checkout', $data);
    //         // $this->load->view('user/checkout', $data);
    //         $this->load->view('user/templates_user/footer');
    //     } else {
    //         $user_id = $this->input->post('user_id');
    //         $no_order = $this->input->post('no_order');
    //         $ship_id = $this->input->post('shipping_method');
    //         $name = $this->input->post('pelanggan_name');
    //         $phone = $this->input->post('pelanggan_phone');
    //         $address = $this->input->post('pelanggan_address');
    //         $id_kab = $this->input->post('kabupaten');
    //         $id_kec = $this->input->post('kecamatan');
    //         $kode_pos = $this->input->post('kode_pos');
    //         $date_pengiriman = $this->input->post('date_pengiriman');
    //         $date_kirim = strtotime($date_pengiriman);
    //         $date = date("Y-m-d H:i:s", $date_kirim);
    //         $note = $this->input->post('note');
    //         $total = $this->input->post('total');
    //         $grandtotal = $this->input->post('grandTotal');

    //         // simpan ke tabel orders
    //         $data = array(
    //             'user_id' => $user_id,
    //             'orders_code' => $no_order,
    //             'date_order' => date("Y-m-d H:i:s"),
    //             'date_pengiriman' => $date,
    //             'pelanggan_name' => $name,
    //             'pelanggan_phone' => $phone,
    //             'pelanggan_address' => $address,
    //             'id_kab' => $id_kab,
    //             'id_kec' => $id_kec,
    //             'kode_pos' => $kode_pos,
    //             'note' => $note,
    //             'ship_id' => $ship_id,
    //             'grand_total' => $total,
    //             'total_bayar' => $grandtotal,
    //             'status' => '0'
    //         );
    //         // var_dump($data);
    //         // die;

    //         $this->order_model->addOrders($data, 'orders');

    //         //simpan ke table order detail
    //         $i = 1;
    //         foreach ($this->cart->contents() as $items) {
    //             $data_order_detail = array(
    //                 'orders_code' => $no_order,
    //                 'product_id' => $items['id'],
    //                 'qty' => $this->input->post('qty' . $i++),
    //             );
    //             $this->order_model->addOrderDetail($data_order_detail, 'order_detail');
    //         }
    //         $this->cart->destroy();
    //         redirect('user/order_controller/order/' . $no_order);
    //     }
    // }


    public function getKecamatan()
    {
        $id = $this->input->post('id');
        $data = $this->order_model->getKecamatan($id);
        echo json_encode($data);
    }

    public function getShipping()
    {
        $id = $this->input->post('id');
        $data = $this->order_model->getShippingById($id);
        echo json_encode($data);
    }

    public function order($no_order)
    {
        $data['title'] = 'Order Summary';
        $data['user'] = $this->auth_model->userData();
        $data['order'] = $this->order_model->getOrderDetail($no_order);
        $data['orders'] = $this->order_model->getOrderDetailProduct($no_order);

        $this->load->view('user/templates_user/header', $data);
        $this->load->view('user/templates_user/topbar', $data);
        $this->load->view('user/order/order-detail', $data);
        $this->load->view('user/templates_user/footer');
    }

    public function konfirmasiBayar($orders_code)
    {
        $this->form_validation->set_rules('account_name', 'Account Name', 'required|trim', ['required' => 'Please fill out this field!']);
        $this->form_validation->set_rules('account_number', 'Account Number', 'regex_match[/^[0-9,]+$/]', ['regex_match' => 'The account number field is not in the numberic format!']);
        // $this->form_validation->set_rules('nominal', 'Nominal', 'required|trim', ['required' => 'Please fill out this nominal field !']);

        if (empty($_FILES['bukti_bayar_image']['name'])) {
            $this->form_validation->set_rules('bukti_bayar_image', 'bukti bayar', 'required', ['required' => 'Please insert image !']);
        }
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Konfirmasi Pembayaran';
            $data['user'] = $this->auth_model->userData();
            $data['order'] = $this->order_model->getOrderDetail($orders_code);

            $this->load->view('user/templates_user/header', $data);
            $this->load->view('user/templates_user/topbar', $data);
            $this->load->view('user/order/konfirmasi-pembayaran', $data);
            $this->load->view('user/templates_user/footer');
        } else {
            $orders_code = $this->input->post('orders_code');
            $account_name  = $this->input->post('account_name');
            $account_number  = $this->input->post('account_number');
            $note  = $this->input->post('note');
            $bukti_bayar_image = $_FILES['bukti_bayar_image']['name'];

            if ($bukti_bayar_image) {
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['upload_path'] = './assets/img//confirm_payments';
                $config['max_size'] = '2048';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('bukti_bayar_image')) {
                    $bukti_bayar_image = $this->upload->data('file_name');

                    $data = array(
                        'account_name' => $account_name,
                        'account_number' => $account_number,
                        'note_payment' => $note,
                        'status_bayar' => 1,
                        'bukti_bayar_image' => $bukti_bayar_image
                    );

                    $this->order_model->uploadBuktiBayar($orders_code, $data);
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> upload bukti transaksi product.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button></div>'
                    );
                    redirect('user/order_controller/myOrders');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed upload</div>');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }


    public function myOrders()
    {
        $data['title'] = 'My Orders';
        $data['user'] = $this->auth_model->userData();
        $data['order'] = $this->order_model->getOrderByUser();
        $data['payment'] = $this->order_model->getOrderPayments();
        $data['ship'] = $this->order_model->getOrdersSelesai();
        $data['selesai'] = $this->order_model->getOrdersDiterima();

        $this->load->helper('string');
        $this->load->view('user/templates_user/header', $data);
        $this->load->view('user/templates_user/topbar', $data);
        $this->load->view('user/order/my-orders', $data);
        $this->load->view('user/templates_user/footer');
    }

    public function orderCancel($orders_code)
    {
        $this->db->delete('orders', ['orders_code' => $orders_code]);
        $this->db->delete('order_detail', ['orders_code' => $orders_code]);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> your order has been canceled.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button></div>');
        redirect('user/order_controller/myOrders');
    }

    public function detailOrder($orders_code)
    {
        $data['title']  = "Detail Order";
        $data['user'] = $this->auth_model->userData();
        $data['orders'] = $this->order_model->getOrderDetails($orders_code);
        $data['order_product'] = $this->order_model->getOrderDetailProduct($orders_code);
        $data['count'] = $this->order_model->countAllOrder();
        $this->load->helper('string');
        $this->load->view('user/templates_user/header', $data);
        $this->load->view('user/templates_user/topbar', $data);
        $this->load->view('user/order/detail-pesanan', $data);
        $this->load->view('user/templates_user/footer');
    }

    public function printDetailOrder()
    {
        $orders_code = $this->input->post('orders_code');
        $data['title']  = "Detail Order";
        $data['user'] = $this->auth_model->userData();
        $data['orders'] = $this->order_model->getOrderDetails($orders_code);
        $data['order_product'] = $this->order_model->getOrderDetailProduct($orders_code);
        $data['count'] = $this->order_model->countAllOrder();

        $this->load->view('user/order/detail-pesanan-print', $data);
    }

    // public function terima($orders_code)
    // {
    //     $data = array(
    //         'orders_code' => $orders_code,
    //         'status' => 3 //shipping
    //     );

    //     $this->order_model->updateStatusOrder($orders_code, $data);
    //     $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
    //                     <strong>Success!</strong> update status order.
    //                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    //                     <span aria-hidden="true">&times;</span>
    //                     </button></div>');
    //     redirect('user/order_controller/myOrders');
    // }
}
