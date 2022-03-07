<?php
class product_model extends CI_Model
{
    // Menampilkan semua data produk
    public function getProduct()
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('category', 'product.category_id = category.category_id');
        // $this->db->join('image_product', 'product.product_id = image_product.product_id');
        return $this->db->get()->result_array();
    }

    // Menampilkan data produk berdasarkan id
    public function getDetailProduct($id)
    {
        return $this->db->select('*')
            ->from('product')
            ->join('category', 'product.category_id = category.category_id')
            ->where('product.product_id', $id)
            ->get()->result_array();
    }

    // Tambah data produk
    public function AddProduct($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    // Update data produk
    public function updateProduct($id, $data)
    {
        $this->db->where('product_id', $id);
        $this->db->update('product', $data);
    }

    // Delete data produk
    public function deleteProduct($id)
    {
        return $this->db->delete('product', ['product_id' => $id]);
    }

    // Menampilkan semua data tabel image produk
    public function getProductImages()
    {
        $this->db->select('product.*, COUNT(image_product.product_id) as total_image ');
        $this->db->from('product');
        $this->db->join('category', 'product.category_id = category.category_id');
        $this->db->join('image_product', 'product.product_id = image_product.product_id', 'left');
        $this->db->group_by('product.product_id');
        $this->db->order_by('product.product_id', 'asc');
        return $this->db->get()->result_array();
    }

    // Update data image produk
    public function updateImageProduct($imageId, $data)
    {
        $this->db->where('image_id', $imageId);
        $this->db->update('image_product', $data);
    }

    // Delete data image produk
    public function deleteImageProduct($id)
    {
        return $this->db->delete('image_product', ['image_id' => $id]);
    }

    // hitung seluruh data produk
    function countAllProduct()
    {
        return $this->db->count_all('product');
    }

    // ambil data gambar sesuai dengan product_id
    public function getImage($id)
    {
        return $this->db->get_where('image_product', ['product_id' => $id])->result_array();
    }

    // ambil data gambar sesuai dengan img_id
    public function getImg($id)
    {
        return $this->db->get_where('image_product', ['image_id' => $id])->result_array();
    }

    // Menampilkan semua data produk berdasarkan main 
    public function getProductByCategory($id)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('category', 'product.category_id = category.category_id');
        $this->db->join('image_product', 'product.product_id = image_product.product_id');
        $this->db->where('category.category_id',  $id);
        $this->db->group_by('product.product_id');
        $this->db->order_by('product.product_id', 'asc');
        return $this->db->get()->result_array();
    }

    //  menampilkan data gambar di carousel
    public function getAllImage()
    {
        $this->db->select('*');
        $this->db->from('image_product');
        return $this->db->get()->result_array();
    }

    // menampilkan 3 product teratas
    public function allProduct()
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->order_by('product_id', 'desc');
        $this->db->limit(3);
        return $this->db->get()->result_array();
    }

    public function search($keyword)
    {
        $this->db->select('*');
        $this->db->from('product');
        $this->db->join('category', 'product.category_id = category.category_id');
        $this->db->join('image_product', 'product.product_id = image_product.product_id');
        $this->db->like('product_name', $keyword);
        $this->db->or_like('category_name', $keyword);
        $this->db->group_by('product.product_id');
        return $this->db->get()->result_array();
    }


    public function productBestSeller()
    {
        $query = "SELECT *, count(order_detail.product_id) as jumlah FROM order_detail 
        INNER JOIN product on order_detail.product_id = product.product_id 
        INNER JOIN image_product on image_product.product_id = product.product_id
        INNER join category on product.category_id = category.category_id
        GROUP BY order_detail.product_id ORDER BY jumlah DESC LIMIT 3";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function bestSeller()
    {
        $query = "SELECT *, count(order_detail.product_id) as jumlah FROM order_detail 
        INNER JOIN product on order_detail.product_id = product.product_id 
        INNER JOIN image_product on image_product.product_id = product.product_id
        INNER join category on product.category_id = category.category_id
        GROUP BY order_detail.product_id 
        ORDER BY jumlah DESC 
        LIMIT 5";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function pbestSeller()
    {
        $query = "SELECT *, count(order_detail.product_id) as jumlah FROM order_detail 
        INNER JOIN product on order_detail.product_id = product.product_id 
        GROUP BY order_detail.product_id ORDER BY jumlah DESC LIMIT 5";
        $result = $this->db->query($query);
        return $result->result_array();
    }

    // Menampilkan semua data produk
    // public function getProductCart($id)
    // {
    //     // $this->db->select('product.product_id, image_product.image_id, image_product.image_name');
    //     $this->db->select('*');
    //     $this->db->from('product');
    //     $this->db->join('category', 'product.category_id = category.category_id');
    //     $this->db->join('image_product', 'product.product_id = image_product.product_id');
    //     $this->db->where(['main_image' => 1, 'product.product_id' => $id]);
    //     return $this->db->get()->result_array();
    // }

    // ambil data gambar sesuai dengan product_id
    // public function getImages($id)
    // {
    //     return $this->db->get_where('image_product', ['product_id' => $id])->row_array();
    // }

    // public function cekData()
    // {
    //     $this->db->limit(1);
    //     $this->db->order_by('product_id', 'DESC');
    //     return $this->db->get('image_product')->row_array();
    // }

    // public function upload($insert, $data)
    // {
    //     $this->db->insert_batch('image_product', $insert);
    //     $this->db->set('main_image', 1);
    //     $this->db->where('image_name', $data);
    //     $this->db->update('image_product');
    //     return $this->db->affected_rows();
    // }
}
