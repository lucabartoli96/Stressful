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

/*

There are two states in home, CATEGORIES and TESTS, we are in the
secondo state iff $_POST['category'] is set.

On the client side the state TESTS differs from the state CATEGORIES
because the table has a field data-id equals to state in lower case 
and if the state is TESTS it has the field data-catgory = "category_name".

*/


if ( isset($_POST['category']) ) { //TESTS state
    
    back_button();
    
    $category = $_POST['category'];
    
    if ( $user->is_admin() ) {
        
        if ( $user->is_admin() and isset($_POST['delete']) ) {
        
            Test::get()->delete($category, $_POST['delete']);
        
        }  else if( isset($_POST['modify']) ) {
            //DO SOMETHING
        }
    
    }
    
    $all = Test::get()->all($category);
    
    if ( empty($all) ) {
        empty_message('test', "No test to show inside $category", 'category', $category);
    } else {
        table('test', $all, $user->is_admin(), 'category', $category);
    }
    
} else { //CATEGORY state
    
    if ( $user->is_admin() and isset($_POST['delete']) ) {
        
        Category::get()->delete($_POST['delete']);
        
    } else if( isset($_POST['add']) ){
        
        try {
            Category::get()->add($_POST['name'], $user->name());
        } catch ( CategoryException $err ) {
            modal('Add', $err->getMessage());
        }
        
    } else if( isset($_POST['modify']) ) {
        
        $old_name = $_POST['modify'];
        $name = $_POST['name'];
        
        try {
            Category::get()->change_name($old_name, $name);
        } catch ( CategoryException $err ) {
            modal('Modify', $err->getMessage(), $old_name);
        }
    }
    
    $all = Category::get()->all();
    
    if ( empty($all) ) {
        empty_message('category', "No category to show");
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