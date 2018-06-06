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
topbar($config['info']['topbar']);
section_head();


if ( isset($_POST['category']) ) {
    
    if ( $user->is_admin() and isset($_POST['delete']) ) {
        
        Test::get()->delete($_POST['delete']);
        
    }
    
    $category = $_POST['category'];
    $all = Test::get()->all($category);
    
    if ( empty($all) ) {
        empty_message("No test to show inside $category");
    } else {
        table('test', $all, $user->is_admin(), 'category', $category);
    }
    
} else {
    
    if ( $user->is_admin() and isset($_POST['delete']) ) {
        
        Category::get()->delete($_POST['delete']);
        
    }
    
    $all = Category::get()->all();
    
    if ( empty($all) ) {
        empty_message("No category to show");
    } else {
        table('category', $all, $user->is_admin());
    }
    
}

    section_foot();
    foot();

?>