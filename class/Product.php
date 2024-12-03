<?php
class Product extends Db
{
  function all()
  {
    return $this->selectSQL('select * from products join images on products.product_id=images.product_id');
  }
  function searchById($id)
  {
    return $this->selectSQL('select * from products join images on products.product_id=images.product_id
     where id=?', [$id]);
  }

  function getProducts($key = '', $catagoriesId = 0)
  {
    $sql = 'SELECT * FROM products WHERE name LIKE ?';
    $data = [];
    if ($catagoriesId != 0) {
      $sql .= ' AND category_id = ?';
      $data = $this->selectSQL($sql, ["%$key%", $catagoriesId]);
    } else {
      $data = $this->selectSQL($sql, ["%$key%"]);
    }
    foreach ($data as $key => $value) {
      $images = $this->getImages($value['product_id']);
      $data[$key]['images'] = $images;
    }
    return $data;
  }
  function random4()
  {
    $sql = 'SELECT * FROM products ORDER BY RAND() LIMIT 0, 4';
    $data = $this->selectSQL($sql);
    foreach ($data as $key => $value) {
      $images = $this->getImages($value['product_id']);
      $data[$key]['images'] = $images;
    }
    return $data;
  }
  function getImages($id)
  {
    return $this->selectSQL('select * from images where product_id=?', [$id]);
  }
  function getColors($id)
  {
    $sql = ' SELECT * from colors JOIN product_color
            on colors.color_code=product_color.color_id
            where product_color.product_id=?';
    $data = $this->selectSQL($sql, [$id]) ?? [];
    return $data;
  }
  function getSizes($id)
  {
    $sql = ' SELECT * from sizes JOIN product_size
            on sizes.size_code=product_size.size_id
            where product_size.product_id=?';
    $data = $this->selectSQL($sql, [$id]) ?? [];
    return $data;
  }
  function detail($id)
  {
    $sql = 'SELECT * FROM products
            WHERE products.product_id = ?';
    $data = $this->selectSQL($sql, [$id]);
    $images = $this->getImages($id);
    $colors = $this->getColors($id);
    $sizes = $this->getSizes($id);
    if (count($data) > 0) {
      $data[0]['images'] = $images;
      $data[0]['colors'] = $colors;
      $data[0]['sizes'] = $sizes;
      return $data[0];
    } else {
      return [];
    }
  }

}