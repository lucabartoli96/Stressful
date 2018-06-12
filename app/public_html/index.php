<?php

require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/db.php');

$username = "";
$password = "";

$err = null;

$user = User::get();


if ( !$user->is_logged() ) {
    
    if(isset($_POST['login'])) {
    
        try {

            $username = $_POST['username'];
            $password = $_POST['password'];
            User::get()->login($username, $password);

        } catch ( UserException $err ) {
            echo $err->to_json();
        }
    
    } else if(isset($_POST['signup'])) {

        try {

            User::get()->signup($_POST['username'], $_POST['email'], $_POST['password']);

        } catch ( UserException $err ) {
            echo $err->to_json();
        }
    }
    
} else {
    
    
    if ( $user->is_admin() and isset($_POST['delete']) ) {    
        Category::get()->delete($_POST['delete']);
        
    } else if( isset($_POST['add']) ){
        
        try {
            Category::get()->add($_POST['name'], $user->name());
        } catch ( CategoryException $err ) {
            echo $err->to_json();
        }
        
    } else if( isset($_POST['modify']) ) {
        
        $old_name = $_POST['modify'];
        $name = $_POST['name'];
        
        try {
            Category::get()->change_name($old_name, $name);
        } catch ( CategoryException $err ) {
            echo $err->to_json();
        }
    }
    
    $all = Category::get()->all();
    
    if ( empty($all) ) {
        empty_message('category', "No category to show");
    } else {
        table('category', $all, $user->is_admin());
    }
    
}




?>