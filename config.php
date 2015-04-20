<?php
session_start();

define('DB_NAME', 'app');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'password');

function db($query = null) {
  static $dbconn=false;
  if (empty($dbconn)) {
    $dbconn = new PDO(
      'mysql:dbname='.DB_NAME.';host='.DB_HOST,
      DB_USER,
      DB_PASSWORD
    );
    $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbconn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
  }
  if ($dbconn===false || is_null($query)) return $dbconn;
  return $dbconn->prepare($query);
}
