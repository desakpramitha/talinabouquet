<?php
class laporan_model extends CI_Model
{
    // Menampilkan data laporan harian
    public function getLaporanHarian($tanggal, $bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->join('order_detail', 'orders.orders_code = order_detail.orders_code');
        $this->db->join('product', 'order_detail.product_id = product.product_id');
        $this->db->where('DAY(orders.date_order)', $tanggal);
        $this->db->where('MONTH(orders.date_order)', $bulan);
        $this->db->where('YEAR(orders.date_order)', $tahun);
        return $this->db->get()->result_array();
    }

    // Menampilkan data laporan bulanan
    public function getLaporanBulanan($bulan, $tahun)
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->join('order_detail', 'orders.orders_code = order_detail.orders_code');
        $this->db->join('product', 'order_detail.product_id = product.product_id');
        $this->db->where('status_bayar', 1);
        $this->db->where('MONTH(orders.date_order)', $bulan);
        $this->db->where('YEAR(orders.date_order)', $tahun);
        return $this->db->get()->result_array();
    }

    // Menampilkan data laporan bulanan
    public function getLaporanTahunan($tahun)
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->join('order_detail', 'orders.orders_code = order_detail.orders_code');
        $this->db->join('product', 'order_detail.product_id = product.product_id');
        $this->db->where('status_bayar', 1);
        $this->db->where('YEAR(orders.date_order)', $tahun);
        return $this->db->get()->result_array();
    }
}
