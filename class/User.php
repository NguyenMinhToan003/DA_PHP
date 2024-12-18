<?php

class User extends Db
{
  function login($email, $password)
  {
    $sql = 'SELECT * FROM users
            JOIN role ON users.role_id = role.role_id
            WHERE email=?';
    $data = $this->selectSQL($sql, [$email]);

    if (!$data || empty($data)) {
      return false; // Không tìm thấy người dùng
    }

    // Kiểm tra mật khẩu
    $hashedPassword = hash('sha256', $password); // Mã hóa mật khẩu người dùng nhập vào


    // Kiểm tra mật khẩu đã mã hóa với mật khẩu trong cơ sở dữ liệu
    if ($hashedPassword === $data[0]['password']) {
      return $data; // Đăng nhập thành công
    }

    return false; // Mật khẩu không chính xác
  }

  function register($username, $password, $email, $address, $tel)
  {
    // Mã hóa mật khẩu với SHA-256 khi người dùng đăng ký
    $hashedPassword = hash('sha256', $password);

    // Thực thi câu lệnh SQL để chèn dữ liệu vào cơ sở dữ liệu
    $sql = 'INSERT INTO users(username, password, email, address, role_id, tel) VALUES(?,?,?,?,2,?)';
    $data = $this->updateSQL($sql, [$username, $hashedPassword, $email, $address, $tel]);

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

  function getAllUsers()
  {
    $sql = 'SELECT users.user_id, users.username, users.email, users.address, role.role_name
            FROM users
            JOIN role ON users.role_id = role.role_id';
    $data = $this->selectSQL($sql); // Gọi phương thức selectSQL để truy xuất dữ liệu
    return $data;
  }
  public function deleteUser($user_id)
  {
    // Sử dụng phương thức deleteSQL từ lớp Db để xóa người dùng
    $sql = "DELETE FROM users WHERE user_id = ?";
    return $this->deleteSQL($sql, [$user_id]); // Gọi phương thức deleteSQL của lớp Db
  }
}
