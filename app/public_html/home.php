<?php 

require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/db.php');
require_once(TEMPLATES_PATH . '/build.php');

session_start();

$user = $_SESSION['user'];

if ( !$user->is_logged() ) {
    header('location: login.php');
}

head(array('topbar'), array('topbar'));
topbar('Home', 'Test', 'Profile');
foot();

?>