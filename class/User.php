<?php

class User extends Db
{
  function login($email, $password)
  {
    $sql = 'SELECT * FROM users WHERE email=? AND password=?';
    $data = $this->selectSQL($sql, [$email, $password]);
    return $data;
  }
  function register($username, $password, $email, $address)
  {
    $sql = 'INSERT INTO users(username, password, email, address,role_id) VALUES(?,?,?,?,2)';
    $data = $this->updateSQL($sql, [$username, $password, $email, $address]);
    return $data;
  }
  function checkUser($username)
  {
    $sql = 'SELECT * FROM users WHERE username=?';
    $data = $this->selectSQL($sql, [$username]);
    return $data;
  }
  function checkEmail($email)
  {
    $sql = 'SELECT * FROM users WHERE email=?';
    $data = $this->selectSQL($sql, [$email]);
    return $data;
  }
  function checkAddress($address)
  {
    $sql = 'SELECT * FROM users WHERE address=?';
    $data = $this->selectSQL($sql, [$address]);
    return $data;
  }
  function checkLogin()
  {
    if (!isset($_SESSION['user'])) {
      header('location:/index.php?page=login');
    }
  }
  function checkAdmin()
  {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
      header('location:/index.php');
    }
  }
  function checkLogout()
  {
    if (isset($_SESSION['user'])) {
      header('location:/index.php');
    }
  }
  function checkRole()
  {
    if (isset($_SESSION['user']) && $_SESSION['user']['role'] == 1) {
      return true;
    }
    return false;
  }
  function checkUserLogin()
  {
    if (isset($_SESSION['user'])) {
      return true;
    }
    return false;
  }
  function getUser($id)
  {
    $sql = 'SELECT * FROM users WHERE id=?';
    $data = $this->selectSQL($sql, [$id]);
  }
}
