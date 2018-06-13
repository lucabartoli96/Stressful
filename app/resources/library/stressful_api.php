<?php

require_once("/var/www/html/Stressful/resources/config.php");
require_once('db.php');

$username = "";
$password = "";

$err = null;

$user = User::get();

if ( !$user->is_logged() ) {
    
    try {
        if(isset($_POST['login'])) {
             User::get()->login($_POST['password'], $_POST['username']);
        } else if(isset($_POST['signup'])) {
             User::get()->signup($_POST['username'], $_POST['email'], $_POST['password']);
        }
        echo '{"login" : true }';
    } catch ( UserException $err ) {
        echo $err->to_json();
    }
    
} else {
    
    if ( isset($_POST['logout']) ) {
        $user->logout();
        echo '{"logout" : true }';
    } else {
        
        if ( isset($_POST['all']) ) {
            
            if (isset($_POST['delete']) or isset($_POST['add']) or isset($_POST['modify'])) {
                
                try {
                    if ( isset($_POST['delete']) ) {
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
                } catch ( UserException  $err) {
                    echo  $err->to_json();
                }
            } else {
                $all = Category::get()->all();
                $rep = null;

                if ( empty($all) ) {
                    $rep = array( 
                        "error" => "No category to show"
                    );
                } else  {
                    $rep = array( 
                        "admin" => $user->is_admin(),
                        "content" => $all
                    );
                }

                echo json_encode($rep);
            }
            
        } else if ( isset($_POST['category']) ) {
            $category = $_POST['category'];
    
            if ( isset($_POST['delete']) or isset($_POST['modify']) ) {
                try {

                    if ( isset($_POST['delete']) ) {
                        Test::get()->delete($category, $_POST['delete']);
                    }  else if( isset($_POST['modify']) ) {
                        //DO NOTHING
                    } 

                } catch ( UserException $err ) {
                    echo $err->to_json();
                }
                
            } else {
                $all = Test::get()->all($category);
                $rep = null;

                if ( empty($all) ) {
                    $rep = array( 
                        "error" => "No test to show inside $category"
                    );
                } else  {
                    $rep = array( 
                        "admin" => $user->is_admin(),
                        "content" => $all
                    );
                }

                echo json_encode($rep);
            }
            
        } else if ( isset($_POST['test']) ) {
            
        }
        
    }
}



?>