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
    $sql = 'SELECT url_image FROM images WHERE product_id = ?';
    return $this->selectSQL($sql, [$id]);
  }

  function getSizes($id)
  {
    $sql = 'SELECT 
                s.size_id,
                s.size_code,
                s.size_name
            FROM 
                sizes s
            JOIN 
                product_detail pd ON pd.size_id = s.size_id
            WHERE 
                pd.product_id = ?';
    return $this->selectSQL($sql, [$id]);
  }


  function getColors($id)
  {
    $sql = 'SELECT 
                c.color_id,
                c.color_code,
                c.color_name
            FROM 
                colors c
            JOIN
                product_detail pd ON pd.color_id = c.color_id
            WHERE
                pd.product_id = ?';
    return $this->selectSQL($sql, [$id]);
  }

  function getColorsBySize($id, $size_id)
  {
    $sql = 'SELECT 
                c.color_id,
                c.color_code,
                c.color_name
            FROM 
                colors c
            JOIN 
                product_detail pd ON pd.color_id = c.color_id
            WHERE 
                pd.product_id = ? AND pd.size_id = ?';

    return $this->selectSQL($sql, [$id, $size_id]);
  }

  function getProduct($id)
  {
    $sql = 'SELECT 
                p.product_id,
                p.name AS product_name,
                p.description AS product_description,
                p.price
            FROM 
                products p
            WHERE 
                p.product_id = ?';
    return $this->selectSQL($sql, [$id]);
  }

  function getProductDetails($id, $size_id)
  {

    $product = $this->getProduct($id);

    $sizes = $this->getSizes($id);
    $colors = $this->getColorsBySize($id, $size_id);
    $images = $this->getImages($id);

    return [
      'product_id' => $product[0]['product_id'],
      'product_name' => $product[0]['product_name'],
      'product_description' => $product[0]['product_description'],
      'images' => $images,
      'price' => $product[0]['price'],
      'colors' => $colors,
      'sizes' => $sizes
    ];
  }
  function getProductDetailByIdColorIdSizeId($id, $color_id, $size_id)
  {
    $sql = 'SELECT 
                  p.name,p.price,product_detail.product_detail_id,c.color_name,s.size_name,
                  p.product_id,c.color_id,s.size_id
            FROM 
                  product_detail 
            JOIN 
                  products p ON product_detail.product_id  = p.product_id  
            JOIN 
                  colors c ON product_detail.color_id = c.color_id
            JOIN 
                  sizes s ON product_detail.size_id = s.size_id
            WHERE 
                  product_detail.product_id = ? AND c.color_id = ? AND s.size_id = ?
    ';
    $data = $this->selectSQL($sql, [$id, $color_id, $size_id]);
    $images = $this->getImages($id);
    $data[0]['images'] = $images;
    return $data[0];
  }
}
