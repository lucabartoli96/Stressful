<?php 

require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/db.php');
require_once(TEMPLATES_PATH . '/build.php');

Session::start();
$user = User::get();

if ( !$user->is_logged() ) {
    header('location: login.php');
}

if ( !$user->is_admin() ) {
    header('location: home.php');
}

head(array('sections', 'newtest'), array('newtest'));
section_head();

if( !isset( $_POST['category'] ) ) {
    echo "<h1>Something wrong happened, you are trying to create a test inside no category</h1>";
    die();
} else {
 
    newtest();
    
}

section_foot();
foot();

?>