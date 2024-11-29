<?php
class Product extends Db
{
  function all()
  {
    return $this->selectSQL('select * from products');
  }
  function searchByName($name)
  {
    return $this->selectSQL('select * from products where name like ?', ["%$name%"]);
  }
  function random4()
  {
    return $this->selectSQL('select * from products order by rand() limit 0, 4');
  }

  function detail($id)
  {
    $data = $this->selectSQL('select * from products where id=?', [$id]);
    if (count($data) > 0) return $data[0];
    else return []; //khong tim thay
  }
}
