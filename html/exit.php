<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14.09.16
 * Time: 17:32
 */
session_start();
if(isset($_SESSION['email'])){
  unset($_SESSION['email']);
}
exit("<html><head><meta    http-equiv='Refresh' content='0;    URL=index.php'></head></html>");

