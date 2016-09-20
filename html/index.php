<?php

session_start();

if (!isset($_SESSION['id'])) {
  require_once 'form.html';
}
else {
  include 'layout.phtml';
}

