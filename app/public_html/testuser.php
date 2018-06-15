<?php 

require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/db.php');
require_once(TEMPLATES_PATH . '/build.php');

Session::start();
$user = User::get();

if ( !$user->is_logged() ) {
    header('location: login.php');
}

head(array('sections', 'table', 'testui'), array('utils', 'testuser'));
section_head();

if( !isset( $_POST['category'] ) ) {
    echo "<h1>Something wrong happened, you are trying to perform a test inside no category</h1>";
    die();
} else if ( !isset($_POST['test']) ) {
    echo "<h1>Something wrong happened, no test specified</h1>";
    die();
} else {
    loadtest($_POST['category'], $_POST['test']);
}

section_foot();
foot();
?>