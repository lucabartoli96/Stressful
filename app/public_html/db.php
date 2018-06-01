<?php 
require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/user.php');

session_start();

function print_if_err($err, $name) {
    if(isset($err) and $err->err($name)) {
      foreach ( $err->get($name) as $msg) {
          login_err($msg);
      }
  }
}

if( !ConnectionParams::set() ) {
    $db = $config['db'];
    ConnectionParams::set($db['host'], $db['username'], $db['password'], $db['database']);
}


?>