<?php
class Product extends Db
{
  function all()
  {
    $sql = 'SELECT * from products JOIN images
            on products.product_id=images.product_id';
    return $this->selectSQL($sql);
  }
  function searchById($id)
  {
    $sql = 'select * from products join images on products.product_id=images.product_id where id=?';
    return $this->selectSQL($sql, [$id]);
  }
  function getProductDetails($id)
  {
    $sql = 'SELECT * from product_detail where product_id=?';
    return $this->selectSQL($sql, [$id]);
  }
  function getProductDetail($product_id, $color_id, $size_id)
  {
    $sql = 'SELECT * from product_detail where product_id=? and color_id=? and size_id=?';
    echo $sql;
    return $this->selectSQL($sql, [$product_id, $color_id, $size_id]) || [];
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
    $sql = 'SELECT * from colors JOIN product_detail
            on colors.color_id = product_detail.color_id
            where product_detail.product_id=?';
    $data = $this->selectSQL($sql, [$id]) ?? [];
    return $data;
  }

  function getSizes($id)
  {
    $sql = 'SELECT * from sizes JOIN product_detail
            on sizes.size_id=product_detail.size_id
            where product_detail.product_id=?';
    $data = $this->selectSQL($sql, [$id]) ?? [];
    return $data;
  }
  // function getColorWithSize($product_id, $size_id)
  // {
  //   $sql = 'SELECT * from product_detail
  //           JOIN colors
  //           on product_detail.color_id = colors.color_id
  //           where product_id=? and size_id=?';
  //   return $this->selectSQL($sql, [$product_id, $size_id]);
  // }
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
