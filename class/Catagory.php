<?php


class Catagory extends Db
{
    // Lấy tất cả danh mục
    public function all()
    {
        return $this->selectSQL('SELECT * FROM categories');
    }

    // Tìm danh mục theo ID
    public function find($id)
    {
        return $this->selectSQL('SELECT * FROM categories WHERE catagory_id = ?', [$id]);
    }

    // Thực thi câu lệnh SQL (thêm, sửa, xóa)
    public function executeSQL($sql, $params = [])
    {
        if (self::$conn) { // Truy cập `$conn` tĩnh
            $stmt = self::$conn->prepare($sql);
            return $stmt->execute($params);
        }
        return false;
    }
}
?>