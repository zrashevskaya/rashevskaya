<?php
session_start();
if (isset($_POST['emailLog'])) {
  $email = trim($_POST['emailLog']);
  if ($email == '') {
    unset($email);
  }
}

if (isset($_POST['passLog'])) {
  $password = trim($_POST['passLog']);
  if ($password == '') {
    unset($password);
  }
}

$pass = sha1($email . $password);

if (empty($email) or empty($password)) {
  $logMessage = ('All fields should be filled in!');
  $logMsgClass = 'error';
  include 'index.php';
}
else {
  include_once 'dbconf.php';

  $db = Database::connect();
  $db->query('SELECT * FROM `user` WHERE `password` = :pass');
  $db->bind(':pass', $pass);
  $result = $db->single();
  if (empty($db->rowCount())) {
    $logMessage = ('Sorry, your e-mail or password is wrong.');
    $logMsgClass = 'error';
    include 'index.php';
  }
  else {
    $_SESSION['email'] = $result['email'];
    exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php'></head></html>");
  }
}
