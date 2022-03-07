<?php
defined('BASEPATH') or exit('No direct script access allowed');

class pesanan_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('auth_model');
        $this->load->model('order_model');
    }

    public function index()
    {
        $data['title']  = "Pesanan";
        $data['user'] = $this->auth_model->userData();
        $data['orders'] = $this->order_model->getOrder(); //0
        $data['diproses'] = $this->order_model->getOrderDiproses(); //1
        $data['selesai'] = $this->order_model->getOrderSelesai(); //2
        $data['terima'] = $this->order_model->getOrderDiterima(); //3
        $data['countStatus'] = $this->order_model->countAllStatusOrder();
        $data['count'] = $this->order_model->countAllOrder();

        $this->load->view('administrator/templates_admin/header', $data);
        $this->load->view('administrator/templates_admin/topbar', $data);
        $this->load->view('administrator/templates_admin/sidebar', $data);
        $this->load->view('administrator/pesanan/pesanan', $data);
        $this->load->view('administrator/templates_admin/footer');
    }

    public function detailPesanan($orders_code)
    {
        $data['title']  = "Detail Pesanan";
        $data['user'] = $this->auth_model->userData();
        $data['orders'] = $this->order_model->getOrderDetails($orders_code);
        $data['order_product'] = $this->order_model->getOrderDetailProduct($orders_code);
        // var_dump($data['order_product']);
        // die;
        $data['count'] = $this->order_model->countAllOrder();
        $this->load->view('administrator/templates_admin/header', $data);
        $this->load->view('administrator/templates_admin/topbar', $data);
        $this->load->view('administrator/templates_admin/sidebar', $data);
        $this->load->view('administrator/pesanan/detail-pesanan');
        $this->load->view('administrator/templates_admin/footer');
    }

    public function verifikasi($orders_code)
    {
        $data['title']  = "Verifikasi Pembayaran";
        $data['user'] = $this->auth_model->userData();
        $data['orders'] = $this->order_model->getOrderDetails($orders_code);
        $data['order_product'] = $this->order_model->getOrderDetailProduct($orders_code);
        // var_dump($data['order_product']);
        // die;
        // $data['count'] = $this->order_model->countAllOrder();
        $this->load->view('administrator/templates_admin/header', $data);
        $this->load->view('administrator/templates_admin/topbar', $data);
        $this->load->view('administrator/templates_admin/sidebar', $data);
        $this->load->view('administrator/pesanan/verifikasi');
        $this->load->view('administrator/templates_admin/footer');
    }

    public function prosesVerifikasi($orders_code)
    {
        $data = array(
            'orders_code' => $orders_code,
            'status' => 1 //di proses
        );

        $this->order_model->updateStatusOrder($orders_code, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> verifikasi data pembayaran.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>');
        redirect('admin/pesanan_controller');
    }

    public function verifikasiCancel($orders_code)
    {
        $data = array(
            'orders_code' => $orders_code,
            'status' => 0, //batal diproses belum bayar
            'status_bayar' => 0
        );

        $this->order_model->updateStatusOrder($orders_code, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> verifikasi data pembayaran.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>');
        redirect('admin/pesanan_controller');
    }

    public function pesananSelesai($orders_code)
    {
        $data = array(
            'orders_code' => $orders_code,
            'status' => 2 //pesanan selesai
        );

        $this->order_model->updateStatusOrder($orders_code, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> update status order.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>');
        redirect('admin/pesanan_controller');
    }

    public function pesananTerkirim($orders_code)
    {
        $data = array(
            'orders_code' => $orders_code,
            'status' => 3 //complete
        );

        $this->order_model->updateStatusOrder($orders_code, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> update status order.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>');
        redirect('admin/pesanan_controller');
    }

    public function pesananCancel($orders_code)
    {
        $this->db->delete('orders', ['orders_code' => $orders_code]);
        $this->db->delete('order_detail', ['orders_code' => $orders_code]);
        // $this->order_model->updateStatusOrder($orders_code, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> customer order has been canceled.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button></div>');
        redirect('admin/pesanan_controller');
    }

    public function printDetailPesanan()
    {
        $orders_code = $this->input->post('orders_code');
        $data['title']  = "Detail Pesanan";
        $data['user'] = $this->auth_model->userData();
        $data['orders'] = $this->order_model->getOrderDetails($orders_code);
        $data['order_product'] = $this->order_model->getOrderDetailProduct($orders_code);
        $data['count'] = $this->order_model->countAllOrder();

        $this->load->view('administrator/pesanan/detail-pesanan-print', $data);
    }

    // public function exportPdf($orders_code)
    // {
    //     $this->load->library('dompdf_gen');

    //     $data['orders'] = $this->order_model->getOrderDetails($orders_code);
    //     $data['order_product'] = $this->order_model->getOrderDetailProduct($orders_code);

    //     $this->load->view('administrator/laporan/detailOrderPdf');

    //     $paper_size = 'A4';
    //     $orientation = 'potrait';
    //     $html = $this->output->get_output();
    //     $this->dompdf->set_paper($paper_size, $orientation);

    //     $this->dompdf->load_html($html);
    //     $this->dompdf->render();
    //     $this->dompdf->stream("detail_order.pdf", array('Attachment => 0'));
    // }

    // public function pesananShipping($orders_code)
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
    //     redirect('admin/pesanan_controller');
    // }
}
