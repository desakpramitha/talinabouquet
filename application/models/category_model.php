<?php
class category_model extends CI_Model
{
    // Menampilkan semua data kategori
    public function getCategory()
    {
        return $this->db->get('category')->result_array();
    }

    // Tambah data kategori
    public function AddCategory($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    // Update data kategori
    public function updateCategory($categoryId, $data)
    {
        $this->db->where('category_id', $categoryId);
        $this->db->update('category', $data);
    }

    // Delete data kategori
    public function deleteCategory($id)
    {
        return $this->db->delete('category', ['category_id' => $id]);
    }

    // hitung seluruh data kategori
    function countAllCategory()
    {
        return $this->db->count_all('category');
    }

    // find product category by id shop load namanya
    public function getCategoryById($id)
    {
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('category_id', $id);
        return $this->db->get()->row_array();
    }

    public function getDetailCategory($id)
    {
        return $this->db->select('*')
            ->from('category')
            ->where('category.category_id', $id)
            ->get()->result_array();
    }
}
