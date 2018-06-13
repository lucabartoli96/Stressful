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
                        echo '{"deleted": true}';
                    } else if( isset($_POST['add']) ){
                        try {
                            Category::get()->add($_POST['name'], $user->name());
                            echo '{"added": true}';
                        } catch ( CategoryException $err ) {
                            echo $err->to_json();
                        }
                    } else if( isset($_POST['modify']) ) {
                        $old_name = $_POST['modify'];
                        $name = $_POST['name'];
                        try {
                            Category::get()->change_name($old_name, $name);
                            echo '{"modified": true}';
                        } catch ( CategoryException $err ) {
                            echo $err->to_json();
                        }
                    }
                } catch ( UserException  $err) {
                    echo  $err->to_json();
                }
            } else {
                $all = Category::get()->all();
                $rep = array( 
                    "admin" => $user->is_admin(),
                );

                if ( empty($all) ) {
                    $rep["error"] = "No category to show";
                } else  {
                    $rep["content"] = $all;
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
                $rep = array( 
                    "admin" => $user->is_admin(),
                );

                if ( empty($all) ) {
                    $rep["error"] = "No category to show";
                } else  {
                    $rep["content"] = $all;
                }

                echo json_encode($rep);
            }
            
        } else if ( isset($_POST['submission']) ) {
            
            $all = Submission::get()->all($user->name());
            
            $rep = array( 
                "admin" => $user->is_admin(),
            );

            if ( empty($all) ) {
                $rep["error"] = "No submitted test to show";
            } else  {
                $rep["content"] = $all;
            }

            echo json_encode($rep);
        } else if ( isset($_POST['profile']) ) {
            
            $err = null;
            
            if ( isset($_POST['modify']) ) {
                
                $password = '';
                
                if ( isset($_POST['password']) ) {
                    $password = $_POST['password'];
                }
                
                try {
                    $user->change($_POST['name'], $_POST['email'], $password);
                } catch( UserException $err) {
                    echo $err->to_json();
                }
            }
            
            if ( !$err ) {
                
                $rep = array(
                    "name" => $user->name(),
                    "email" => $user->email(),
                    "since" => $user->since()
                );

                echo json_encode($rep);
            }
        
            
        }
        
    }
}



?>