<?php
class Product extends Db
{
  // lay tat ca san pham bao gom tat ca thong tin
  function getProductsByKeyAndCata($key = '', $catagoriesId = 0)
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
      $data[$key] = $this->getProductById($value['product_id']);
    }
    return $data  ?? [];
  }

  // lay tat ngau nhien 4 san pham
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

  // lay tat ca hinh anh cua san pham khi biet id
  function getImages($id)
  {
    $sql = 'SELECT * FROM images WHERE product_id = ?';
    return $this->selectSQL($sql, [$id]) ?? [];
  }

  // lay thong tin kich thuoc cua san pham khi biet id
  function getSizes($id)
  {
    $sql = 'SELECT DISTINCT
                s.size_id,
                s.size_code,
                s.size_name
            FROM 
                sizes s
            JOIN 
                product_detail pd ON pd.size_id = s.size_id
            WHERE 
                pd.product_id = ?';
    return $this->selectSQL($sql, [$id]) ?? [];
  }

  // lay thong tin kich thuoc cua san pham khi biet id
  function getColors($id)
  {
    $sql = 'SELECT DISTINCT
                c.color_id,
                c.color_code,
                c.color_name
            FROM 
                colors c
            JOIN
                product_detail pd ON pd.color_id = c.color_id
            WHERE
                pd.product_id = ?';
    return $this->selectSQL($sql, [$id]) ?? [];
  }

  // lay thong tin mau sac cua san pham khi biet id san pham va id kich thuoc
  function getColorsBySize($id, $size_id)
  {
    $sql = 'SELECT DISTINCT
                c.color_id,
                c.color_code,
                c.color_name
            FROM 
                colors c
            JOIN 
                product_detail pd ON pd.color_id = c.color_id
            WHERE 
                pd.product_id = ? AND pd.size_id = ?';
    return $this->selectSQL($sql, [$id, $size_id]) ?? [];
  }

  // chi lay thong tin cua san pham
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

  // lay tat ca gia cua san pham 
  function getAllPrice($id)
  {
    $sql = 'SELECT DISTINCT price FROM product_detail WHERE product_id = ?';
    return $this->selectSQL($sql, [$id]) ?? [];
  }
  // lay gia cua san pham khi biet id san pham , id kich thuoc , id mau sac
  function getPriceByColorIdSizeId($id, $color_id, $size_id)
  {
    $sql = 'SELECT price FROM product_detail WHERE product_id = ? AND color_id = ? AND size_id = ?';
    $data = $this->selectSQL($sql, [$id, $color_id, $size_id]);
    return $data[0]['price'] ?? 0;
  }

  // lay thong tin tat ca mau sac, kich thuoc cua san pham
  function getProductById($id)
  {
    $sql = 'SELECT 
               *
            FROM 
                products p
            WHERE 
                p.product_id = ?';
    $cataObj = new Catagory();
    $product_detail = $this->selectSQL($sql, [$id]);
    $catagory = $cataObj->find($product_detail[0]['category_id']);
    $product = $this->getProduct($product_detail[0]['product_id'])  ?? [];
    $sizes = $this->getSizes($product_detail[0]['product_id']) ?? [];
    $colors = $this->getColors($product_detail[0]['product_id']) ?? [];
    $images = $this->getImages($product_detail[0]['product_id']) ?? [];
    $prices = $this->getAllPrice($product_detail[0]['product_id']) ?? [];
    $price =  number_format($prices[0]['price'] ?? 0) . 'đ -' . number_format(end($prices)['price'] ?? 0) . 'đ';
    return [
      'product_id' => $product[0]['product_id'],
      'product_name' => $product[0]['product_name'],
      'product_description' => $product[0]['product_description'],
      'catagory' => $catagory[0],
      'images' => $images,
      'price' => $price,
      'colors' => $colors,
      'sizes' => $sizes
    ];
  }

  // lay thong tin chi tiet cua san pham khi biet id san pham va id kich thuoc
  function getProductUser($id, $size_id, $color_id)
  {
    $product = $this->getProduct($id);
    $sizes = $this->getSizes($id);
    $colors = $this->getColorsBySize($id, $size_id);
    $images = $this->getImages($id);
    $price = $this->getPrice($id, $size_id, $color_id);
    return [
      'product_id' => $product[0]['product_id'],
      'product_name' => $product[0]['product_name'],
      'product_description' => $product[0]['product_description'],
      'images' => $images ?? [],
      'price' => $price,
      'colors' => $colors,
      'sizes' => $sizes
    ];
  }

  // lay gia cua san pham khi biet id san pham va id kich thuoc
  function getPrice($id, $size_id, $color_id)
  {
    $sql = 'SELECT price FROM product_detail WHERE product_id = ? AND size_id = ? AND color_id = ?';
    $data = $this->selectSQL($sql, [$id, $size_id, $color_id]);
    return $data[0]['price'] ?? 0;
  }

  // lay color id khi biet id 
  function getColorId($id)
  {
    $sql = 'SELECT * from colors WHERE color_id = ?';
    return $this->selectSQL($sql, [$id]);
  }

  // lay size id khi biet id
  function getSizeId($id)
  {
    $sql = 'SELECT * from sizes WHERE size_id = ?';
    return $this->selectSQL($sql, [$id]);
  }

  // lay danh sach chi tiet san pham tu id san pham 
  function getListProductDetailByProductId($id)
  {
    $sql = 'SELECT * FROM product_detail WHERE product_id = ?';

    $data = $this->selectSQL($sql, [$id]) ?? [];
    foreach ($data as $key => $value) {
      $color = $this->getColorId($value['color_id']);
      $size = $this->getSizeId($value['size_id']);
      $data[$key]['color_name'] = $color[0]['color_name'];
      $data[$key]['size_name'] = $size[0]['size_name'];
    }
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
    // exit;
    return $data;
  }
  // lay thong tin chi tiet cua san pham khi biet id san pham , id kich thuoc , id mau sac
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
    $price = $this->getPriceByColorIdSizeId($id, $color_id, $size_id);
    // echo '<pre>';
    // print_r($price);
    // echo '</pre>';
    // exit;
    $images = $this->getImages($id);
    $data[0]['price'] = $price;
    $data[0]['images'] = $images;
    return $data[0];
  }

  // lay tat ca mau sac 
  function getAllColors()
  {
    $sql = 'SELECT * FROM colors';
    return $this->selectSQL($sql) ?? [];
  }
  // lay tat ca kich thuoc
  function getAllSizes()
  {
    $sql = 'SELECT * FROM sizes';
    return $this->selectSQL($sql) ?? [];
  }


  // them san pham moi
  function addProduct($name, $description,  $category_id)
  {
    $sql = 'INSERT INTO products (name, description, category_id,brand_id) VALUES (?, ?, ?,1)';
    return $this->insertSQL($sql, [$name, $description, $category_id]);
  }
  // them chi tiet san pham 
  function addProductDetail($product_id, $color_id, $size_id, $quantity, $price)
  {
    $sql = 'INSERT INTO product_detail (product_id, color_id, size_id, quantity, price) VALUES (?, ?, ?, ?, ?)';
    return $this->insertSQL($sql, [$product_id, $color_id, $size_id, $quantity, $price]);
  }
  function getAllProductDetailByProductId($id)
  {
    $sql = 'SELECT * FROM product_detail WHERE product_id = ?';
    return $this->selectSQL($sql, [$id]) ?? [];
  }

  // xoa san pham chi tiet by id
  function deleteProductDetail($id)
  {
    $sql = 'DELETE FROM product_detail WHERE product_detail_id = ?';
    return $this->deleteSQL($sql, [$id]);
  }

  function deleteProductImage($id)
  {
    $sql = 'DELETE FROM images WHERE product_id = ?';
    return $this->deleteSQL($sql, [$id]);
  }
  // xoa san pham by id
  function deleteProduct($id)
  {
    $allProductDetail = $this->getAllProductDetailByProductId($id);
    $this->deleteProductImage($id);
    foreach ($allProductDetail as $productDetail) {
      $this->deleteProductDetail($productDetail['product_detail_id']);
    }
    $sql = 'DELETE FROM products WHERE 	product_id  = ?';

    return $this->deleteSQL($sql, [$id]);
  }
  // them hinh anh san pham
  function addProductImage($product_id, $url_image)
  {
    $sql = 'INSERT INTO images (product_id,url_image) VALUES (?, ?)';
    return $this->insertSQL($sql, [$product_id,  "./uploads/$url_image"]);
  }

  // cap nhat chi tiet san pham 
  function updateProductDetail($product_detail_id, $color_id, $size_id, $quantity, $price)
  {
    $sql = 'UPDATE product_detail SET color_id = ?, size_id = ?, quantity = ?, price = ? WHERE product_detail_id = ?';
    return $this->updateSQL($sql, [$color_id, $size_id, $quantity, $price, $product_detail_id]);
  }
  // cap nhat hinh anh 
  function updateImage($product_id, $url_image)
  {
    $sql = 'UPDATE images SET url_image = ? WHERE product_id = ?';
    return $this->updateSQL($sql, [$url_image, $product_id]);
  }
  // cap nhat san pham
  function updateProduct($product_id, $name, $description, $category_id)
  {
    $sql = 'UPDATE products SET name = ?, description = ?, category_id = ? WHERE product_id = ?';
    return $this->updateSQL($sql, [$name, $description, $category_id, $product_id]);
  }
}
