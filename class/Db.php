<?php
// Database configuration
$host = 'localhost';       // Hostname
$dbname = 'e1'; // Database name
$username = 'root';   // Username
$password = ''; // Password
$charset = 'utf8mb4';      // Character set


class Db
{
  public static $conn = null;
  function __construct()
  {
    Db::$conn = new PDO("mysql:host=localhost; dbname=e1", 'root', '');
  }
  function selectSQL($sql, $arrParam = [])
  {
    $stm = Db::$conn->prepare($sql);
    $stm->execute($arrParam);
    return $stm->fetchAll(PDO::FETCH_ASSOC);
  }
  function updateSQL($sql, $arrParam = [])
  {
    $stm = Db::$conn->prepare($sql);
    $stm->execute($arrParam);
    return $stm->rowCount();
  }
}
