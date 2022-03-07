<?php
class order_model extends CI_Model
{
    public function getOrder()
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('status', 0);
        $this->db->order_by('date_order', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getOrderDiproses()
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('status', 1);
        $this->db->order_by('date_order', 'DSC');
        return $this->db->get()->result_array();
    }

    public function getOrderSelesai()
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('status', 2);
        $this->db->order_by('date_order', 'DSC');
        return $this->db->get()->result_array();
    }

    public function getOrderDiterima()
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('status', 3);
        $this->db->order_by('date_order', 'DSC');
        return $this->db->get()->result_array();
    }

    // Menampilkan semua data order
    public function getKabupaten()
    {
        $this->db->select('*');
        $this->db->from('kabupaten');
        return $this->db->get()->result_array();
    }

    // Menampilkan semua data order
    public function getKecamatan($id)
    {
        $this->db->select('*');
        $this->db->from('kecamatan');
        $this->db->where('id_kab', $id);
        return $this->db->get()->result_array();
    }

    // Menampilkan semua data shipping
    public function getShip()
    {
        $this->db->select('*');
        $this->db->from('shipping');
        return $this->db->get()->result_array();
    }

    // Menampilkan data shipping berdasarkan id
    public function getShippingById($id)
    {
        $this->db->select('*');
        $this->db->from('shipping');
        $this->db->where('ship_id', $id);
        return $this->db->get()->result_array();
    }

    // Tambah data order ke table orders
    public function addOrders($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    // Tambah data order ke table order detail
    public function addOrderDetail($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    public function getOrderByUser()
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('status', 0);
        return $this->db->get()->result_array();
    }

    public function getOrderPayments()
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('status', 1);
        return $this->db->get()->result_array();
        // $this->db->join('order_confirm', 'orders.user_id = order_confirm.user_id');
        // // $this->db->where('status_bayar', $this->session->userdata('user_id'));
    }

    public function getOrdersSelesai()
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('status', 2);
        return $this->db->get()->result_array();
    }

    public function getOrdersDiterima()
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $this->db->where('status', 3);
        return $this->db->get()->result_array();
    }

    //Menampilkan semua data order berdasarkan order_code
    public function getOrderDetail($orders_code)
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->where('orders_code', $orders_code);
        return $this->db->get()->result_array();
    }

    public function getOrderDetails($orders_code)
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->join('user', 'orders.user_id = user.user_id');
        $this->db->join('kabupaten', 'orders.id_kab = kabupaten.id_kab');
        $this->db->join('kecamatan', 'orders.id_kec = kecamatan.id_kec');
        $this->db->join('shipping', 'orders.ship_id = shipping.ship_id');
        $this->db->where('orders_code', $orders_code);
        $this->db->group_by('orders_code');
        return $this->db->get()->result_array();
    }

    // product yang di beli
    public function getOrderDetailProduct($orders_code)
    {
        $this->db->select('*');
        $this->db->from('orders');
        $this->db->join('order_detail', 'orders.orders_code = order_detail.orders_code');
        $this->db->join('product', 'order_detail.product_id = product.product_id');
        $this->db->join('shipping', 'orders.ship_id = shipping.ship_id');
        $this->db->where('order_detail.orders_code', $orders_code);
        // $this->db->group_by('orders_code');
        return $this->db->get()->result_array();
    }


    // Tambah data order ke table order confirm
    public function uploadBuktiBayar($orders_code, $data)
    {
        $this->db->where('orders_code', $orders_code);
        $this->db->update('orders', $data);
    }

    // Update status Order
    public function updateStatusOrder($orders_code, $data)
    {
        $this->db->where('orders_code', $orders_code);
        $this->db->update('orders', $data);
    }

    // Delete data order
    public function deleteTestimoni($id)
    {
        return $this->db->delete('testimoni', ['testimoni_id' => $id]);
    }

    public function countAllOrder()
    {
        return $this->db->count_all('orders');
    }

    // hitung status orderr
    public function countAllStatusOrder()
    {
        $query = "SELECT 
		COUNT(status) as total,
		COUNT(IF(`status` = 0, `status`, NULL)) as unpaid,
		COUNT(IF(`status` = 1, `status`, NULL)) as proses,
		COUNT(IF(`status` = 2, `status`, NULL)) as siap_antar,
		COUNT(IF(`status` = 3, `status`, NULL)) as complete FROM orders";
        $result = $this->db->query($query);
        return $result->row_array();
    }
}
