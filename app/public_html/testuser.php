<?php 

require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/db.php');
require_once(TEMPLATES_PATH . '/build.php');

Session::start();
$user = User::get();

if ( !$user->is_logged() ) {
    header('location: login.php');
}

head(array('sections', 'testui'), array());
section_head();

if( !isset( $_POST['category'] ) ) {
    echo "<h1>Something wrong happened, you are trying to perform a test inside no category</h1>";
    die();
} else {
    
    $category = $_POST['category'];
    $name = $_POST['name'];
    
    $test = Test::get()->getTest($category, $name);
    
    if ( isset($_POST['submit']) ) {
        /* TODO 
        
        Code to check if answears are correct and tell the result.
        
        */
    } else {
        loadtest($category, $name, $test['questions']);
    }
}

?>