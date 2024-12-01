<?php
class Catagory extends Db
{
  function all()
  {
    return $this->selectSQL('select * from categories');
  }
  function find($id)
  {
    return $this->selectSQL('select * from categories where catagory_id=?', [$id]);
  }
}
