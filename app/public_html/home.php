<?php 

require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/db.php');
require_once(TEMPLATES_PATH . '/build.php');

Session::start();
$user = User::get();

if ( !$user->is_logged() ) {
    header('location: login.php');
}

head(array('topbar', 'sections', 'table'), array('table', 'topbar', 'home'));
topbar(array('Home', 'Career', 'Profile'));
section_head();


if ( isset($_POST['category']) ) {
    
    $category = $_POST['category'];
    table(Test::get()->all($category));
    
} else {
    
    table(Category::get()->all());
    
}

    section_foot();
    foot();

?>