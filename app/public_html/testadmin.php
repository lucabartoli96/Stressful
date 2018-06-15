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

head(array('sections', 'testadmin'), array('utils','testadmin'));
section_head();

if( !isset( $_POST['category'] ) ) {
    echo "<h1>Something wrong happened, you are trying to create/modify a test inside no category</h1>";
    die();
} else {
 
    $category = $_POST['category'];
    
    if ( isset( $_POST['update'] ) ) {
        
        $name = $_POST['name'];
        newtest('Update', $category, $name);
        
    } else {
        newtest('Create',$category);
    }
    
}

section_foot();
foot();

?>