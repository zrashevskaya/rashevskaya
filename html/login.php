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
  include_once 'dbconnect.php';

  $result = User::all(array(
    'conditions' => array(
      'email = ? and password = ?',
      $email,
      $pass
    )
  ));

  if (empty($result)) {
    $logMessage = ('Sorry, your e-mail or password is wrong.');
    $logMsgClass = 'error';
    include 'index.php';
  }
  else {
    $_SESSION['id'] = $result[0]->user_id;
    exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php'></head></html>");
  }

}
