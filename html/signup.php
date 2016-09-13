<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13.09.16
 * Time: 10:35
 */

//include_once 'index.html';

$firstName = trim($_POST['firstName']);
$lastName = trim($_POST['lastName']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$pass = sha1($email.$password);


// Include database class
include_once 'Class/Database.php';

// Define configuration
define('DB_HOST', 'Rashevskaya.com');
define('DB_USER', 'rashevskaya');
define('DB_PASS', 'Adyax-2016');
define('DB_NAME', 'testdb');

$db = Database::connect();
$db->query('SELECT `user_id` FROM `user` WHERE `email` = :email');
$db->bind(':email', $email);
$db->resultset();
if (!empty($db->rowCount())) {
  $message = ('Sorry, this e-mail is already registered.');
  $msgclass = 'error';
}
else{
  $db->query(
    'INSERT INTO `user`(`user_id`, `firstname`, `lastname`, `email`, `password`)
     VALUES (null, :firstname, :lastname, :email, :password)'
  );
  $db->bind(':firstname', $firstName);
  $db->bind(':lastname', $lastName);
  $db->bind(':email', $email);
  $db->bind(':password', $pass);
  $result = $db->execute();
  if ($result == 'true') {
    $message = 'Success!';
    $msgclass = 'okey';
  }
  else {
    $message = 'Error!';
    $msgclass = 'error';
  }
}

include_once 'index.html';
