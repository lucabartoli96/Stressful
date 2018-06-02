<?php 

require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/user.php');
require_once(TEMPLATES_PATH . '/build.php');

$user = $_SESSION['user'];

if ( !$user->is_logged() ) {
    header('location: login.php');
}

head(array('topbar'), array('topbar'));
topbar();
foot();

?>