<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 13.09.16
 * Time: 10:35
 */

if (isset($_POST['firstName'])) {
  $firstName = trim($_POST['firstName']);
  if ($firstName == '') {
    unset($firstName);
  }
}

if (isset($_POST['lastName'])) {
  $lastName = trim($_POST['lastName']);
  if ($lastName == '') {
    unset($lastName);
  }
}

if (isset($_POST['email'])) {
  $email = trim($_POST['email']);
  if ($email == '') {
    unset($email);
  }
}

if (isset($_POST['password'])) {
  $password = trim($_POST['password']);
  if ($password == '') {
    unset($password);
  }
}

if (empty($email) or empty($password) or empty($firstName) or empty($lastName)) {
  $message = ('All fields should be filled in!');
  $msgClass = 'error';
}
else {
  $pattern = '/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i';
  try {
    if (strlen($firstName) < 2) {
      throw new Exception('Your First Name is too short!!!');
    }
    if (strlen($lastName) < 3) {
      throw new Exception('Your Last Name is too short!!!');
    }
    if (!preg_match($pattern, $email)) {
      throw new Exception('Please, check you e-mail. It seems to be incorrect.');
    }
    if (strlen($password) < 6) {
      throw new Exception('Your password is too short!!! It should be not less than 6 simbols.');
    }

    $pass = sha1($email . $password);
    include_once 'dbconf.php';

    $db = Database::connect();
    $db->query('SELECT `user_id` FROM `user` WHERE `email` = :email');
    $db->bind(':email', $email);
    $db->resultset();
    if (!empty($db->rowCount())) {
      $message = ('Sorry, this e-mail is already registered.');
      $msgClass = 'error';
    }
    else {
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
        $msgClass = 'okey';
      }
      else {
        $message = 'Error!';
        $msgClass = 'error';
      }
    }
  } catch (Exception $e) {
    $message = $e->getMessage();
    $msgClass = 'error';
  }
}
include_once 'index.php';

