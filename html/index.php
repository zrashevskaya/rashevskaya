<?php

session_start();
if (!isset($_SESSION['email'])) {
  require_once 'form.html';
}
else {
  include 'layout.phtml';
}
