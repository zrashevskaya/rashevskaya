<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 15.09.16
 * Time: 12:10
 */
# inclue the ActiveRecord library
require_once 'php-activerecord/ActiveRecord.php';

$connections = array(
  'development' => 'mysql://rashevskaya:Adyax-2016@Rashevskaya.com/testdb?charset=utf8'
);

ActiveRecord\Config::initialize(function ($cfg) use ($connections) {
  $cfg->set_model_directory('Class/Model');
  $cfg->set_connections($connections);
  // Default connection is now production.
  $cfg->set_default_connection('development');
});
