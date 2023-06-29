<?php

echo "Hello there, this is a PHP Apache container <br />";

$servername = "db";
$username = "root";
$password = rtrim(file_get_contents("/run/secrets/db_root_password"));
$db = "docker-test";

try {
  $conn = new PDO("mysql:host=$servername", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "CREATE DATABASE if not exists test";
  $conn->exec($sql);
  $sql = "CREATE TABLE if not exists test.users (id int not null auto_increment, username text not null, password text not null, primary key (id))";
  $conn->exec($sql);
  $sql = 'insert into test.users (username, password) values
  ("admin","password"),
  ("Alice","this is my password"),
  ("Job","12345678")';
  $conn->exec($sql);
  $sql = 'SELECT * FROM test.users';
  echo "Database created successfully<br>";
  $getUsers = $conn->prepare($sql);
  $getUsers->execute();
  $users = $getUsers->fetchAll();
  foreach ($users as $user) {
    echo $user['username'] . '<br />';
  }

} catch(PDOException $e) {
  echo $e->getMessage();
}

$conn = null;

?>
