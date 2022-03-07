<?php
defined('BASEPATH') or exit('No direct script access allowed');

class laporan_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('auth_model');
        $this->load->model('laporan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Laporan';
        $data['user'] = $this->auth_model->userData();
        $this->load->view('administrator/templates_admin/header', $data);
        $this->load->view('administrator/templates_admin/topbar', $data);
        $this->load->view('administrator/templates_admin/sidebar', $data);
        $this->load->view('administrator/laporan/laporan');
        $this->load->view('administrator/templates_admin/footer');
    }

    public function laporanHarian()
    {
        $tanggal = $this->input->post('tanggal');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $data = [
            'tanggal' => $tanggal,
            'bulan' => $bulan,
            'tahun' => $tahun
        ];

        // var_dump($data);
        // die;
        $data['title'] = 'Laporan Harian';
        $data['user'] = $this->auth_model->userData();
        $data['laporan'] = $this->laporan_model->getLaporanHarian($tanggal, $bulan, $tahun);
        $this->load->view('administrator/templates_admin/header', $data);
        $this->load->view('administrator/templates_admin/topbar', $data);
        $this->load->view('administrator/templates_admin/sidebar', $data);
        $this->load->view('administrator/laporan/laporan-harian', $data);
        $this->load->view('administrator/templates_admin/footer');
    }

    public function printLaporanHarian()
    {
        $tanggal = $this->input->post('tanggal');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $data = [
            'tanggal' => $tanggal,
            'bulan' => $bulan,
            'tahun' => $tahun
        ];

        // var_dump($data);
        // die;
        $data['title'] = 'Laporan Harian';
        $data['user'] = $this->auth_model->userData();
        $data['laporan'] = $this->laporan_model->getLaporanHarian($tanggal, $bulan, $tahun);
        $this->load->view('administrator/laporan/laporan-harian-print', $data);
    }

    public function laporanBulanan()
    {

        $bulan = $this->input->post('bulan2');
        $tahun = $this->input->post('tahun2');

        $data = [
            'user' => $this->auth_model->userData(),
            'title' => 'Laporan Bulanan',
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $this->laporan_model->getLaporanBulanan($bulan, $tahun)
        ];

        // var_dump($data);
        // die;

        $this->load->view('administrator/templates_admin/header', $data);
        $this->load->view('administrator/templates_admin/topbar', $data);
        $this->load->view('administrator/templates_admin/sidebar', $data);
        $this->load->view('administrator/laporan/laporan-bulanan', $data);
        $this->load->view('administrator/templates_admin/footer');
    }

    public function printLaporanBulanan()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $data = [
            'bulan' => $bulan,
            'tahun' => $tahun
        ];

        $data['title'] = 'Laporan Bulanan';
        $data['user'] = $this->auth_model->userData();
        $data['laporan'] = $this->laporan_model->getLaporanBulanan($bulan, $tahun);
        $this->load->view('administrator/laporan/laporan-bulanan-print', $data);
    }

    public function laporanTahunan()
    {
        $tahun = $this->input->post('tahun3');

        $data = [
            'user' => $this->auth_model->userData(),
            'title' => 'Laporan Tahunan',
            'tahun' => $tahun,
            'laporan' => $this->laporan_model->getLaporanTahunan($tahun)
        ];

        $this->load->view('administrator/templates_admin/header', $data);
        $this->load->view('administrator/templates_admin/topbar', $data);
        $this->load->view('administrator/templates_admin/sidebar', $data);
        $this->load->view('administrator/laporan/laporan-tahunan', $data);
        $this->load->view('administrator/templates_admin/footer');
    }

    public function printLaporanTahunan()
    {
        $tahun = $this->input->post('tahun');

        $data = [
            'tahun' => $tahun
        ];

        $data['title'] = 'Laporan Tahunan';
        $data['user'] = $this->auth_model->userData();
        $data['laporan'] = $this->laporan_model->getLaporanTahunan($tahun);
        $this->load->view('administrator/laporan/laporan-tahunan-print', $data);
    }
}
