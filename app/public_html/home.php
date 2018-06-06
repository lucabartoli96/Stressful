<?php 

require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/db.php');
require_once(TEMPLATES_PATH . '/build.php');

Session::start();
$user = User::get();

if ( !$user->is_logged() ) {
    header('location: login.php');
}

head(array('topbar', 'sections', 'table', 'modal'), array('utils', 'table', 'topbar', 'home'));
topbar($config['info']['topbar']);
section_head();

if ( isset($_POST['category']) ) {
    
    back_button();
    
    $category = $_POST['category'];
    
    if ( $user->is_admin() and isset($_POST['delete']) ) {
        
        Test::get()->delete($category, $_POST['delete']);
        
    } else if( isset($_POST['add']) ){
        
        Test::get()->add($category, $_POST['name']);
        //DO SOMETHING
        
    } else if( isset($_POST['modify']) ) {
        //DO SOMETHING
    }
    
    $all = Test::get()->all($category);
    
    if ( empty($all) ) {
        empty_message("No test to show inside $category");
    } else {
        table('test', $all, $user->is_admin(), 'category', $category);
    }
    
} else {
    
    if ( $user->is_admin() and isset($_POST['delete']) ) {
        
        Category::get()->delete($_POST['delete']);
        
    } else if( isset($_POST['add']) ){
        
        Category::get()->add($_POST['name'], $user->name());
        
    } else if( isset($_POST['modify']) ) {
        $old_name = $_POST['oldname']
        $name = $_POST['name'];
        Category::get()->change_name($old_name, $new_name);
    }
    
    $all = Category::get()->all();
    
    if ( empty($all) ) {
        empty_message("No category to show");
    } else {
        table('category', $all, $user->is_admin());
    }
    
}   
    
if ( $user->is_admin() ) {
    plus_button();
}

section_foot();
foot();

?>