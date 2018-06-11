<?php 
require_once("/var/www/html/Stressful/resources/config.php");

function head( $css = array(), $js = array() ) {
    
    include("header.php");
    
}

function foot() {
    echo "</body> </html> ";
}

function login_form_head($action) {
    echo '<div class="form-container"> <div class="form">' .
        '<form method="POST" action="'.$action.'">';
}

function login_form_foot() {
    echo '</form></div></div>';
}

function print_if_err($err, $name) {
    if(isset($err) and $err->err($name)) {
      foreach ( $err->get($name) as $msg) {
          login_err($msg);
      }
  }
}

function login_err($msg) {
    echo "<div class='alert alert-warning'>$msg</div>";
}

function topbar($sections, $active = null) {

    if( !isset($active) ) {
        $active = $sections[0];
    }
    
    include('topbar.php');
}

function section_head() {
    echo "<div class='section'>";
    echo '<div class="container-section">';
}

function section_foot() {
    echo "</div> </div>";
}

function back_button() {
    echo "<button id='back' class='home-button' > <img src='img/back.png' /> </button>";    
}

function plus_button() {
    echo "<button id='plus' class='home-button' > <img src='img/plus.png' /> </button>";
}

function empty_message($id, $msg, $name='', $value='') {
    echo "<h1 data-id='$id'";
    
    if ( $name !== '' and $value !== '' ) {
        echo " data-$name=$value ";
    }
    
    echo ">$msg</h1>";
}

function modal($operation, $err, $value = null) {
    include("modal.php");
}

function table($id, $content, $admin, $name='', $value='') {
    include('table.php');
}

function profile($user) {
    include('profile.php');
}

function profile_desc_line($field, $value) {
    echo "<h5><b>$field:</b> $value</h5>";
}

function profile_inputs($username, $email, $err=null) {
    echo "<input type='text' placeholder='username' name='username' value='$username'/>";
    print_if_err($err, 'username');
    echo "<input type='email' placeholder='email' name='email' value='$email' />";
    print_if_err($err, 'email');
    echo "<input type='password' placeholder='new password' name='password'/>";
    echo "<input type='password' placeholder='password confirmation' name='password_conf'/>";
    echo "<button type='submit' name='save'>Save</button>";  
}

function profile_desc($user) {
    profile_desc_line('Username', $user->name());
    profile_desc_line('Email', $user->email());
    profile_desc_line('Since', $user->since());
    echo "<button type='submit' name='modify'>Modify</button>";  
}

function hiddenForm($module, $params) {
    echo "<form id='hiddenForm' method='post' action='$module' style='display: none'>";
    
    foreach ($params as $a => $b) {
        echo '<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">';
    }
    
    echo "</form>" .
         "<script type='text/javascript'>" .
            "document.getElementById('hiddenForm').submit();" .
         "</script>";
}


function print_questions_admin($questions_json) {
    $questions = json_decode($questions_json, true);
    
    $index = 0;
    
    foreach ( $questions as $question ) {
        
        echo "<li class='question'>" .
                        "<input type='text' value='${question['question']}'>" . 
                        "<ul id='question-$index' class='fields'>";
        
        $option_index = 0;
        
        foreach ( $question['options'] as $option ) {
            
            echo "<li> <input type='radio' name='question-$index'";
            
            if( $option_index == $question['answear'] ) {
                
                echo ' checked ';
                
            }
                
            echo "> <input type='text' value='$option'> </li>";
            
            $option_index++;
        }
        
        
                            
        echo            "<li> <button class='plus-option'> <img src='img/plus.png' /> </button> </li>" . 
                        "</ul>" . 
                        "<div class='buttons'>" .
                            "<button class='delete'>" .
                                "<img src='img/delete.png' />" . 
                            "</button>" .
                        "</div>" .
                    "</li>";
        
        $index++;
        
    }
}


function print_questions($questions_json) {
    $questions = json_decode($questions_json, true);
    
    echo "<div id='question-form'>";
    
    $index = 0;
    
    foreach ( $questions as $question ) {
        
        echo "<li class='question'>";
        echo $question['question'];
        echo    "<ul class='fields'>";
        
        foreach ( $question['options'] as $option ) {
            echo "<li> <input type='radio' name='question-$index'><p>$option</p></li>";
        }
                            
        echo   "</ul>" . 
            "</li>";
        
        $index++;
        
    }
    
    echo "</div>";
}




function newtest($operation, $creator, $category, $name=null, $number=null, $correct=null, $mistake=null, $questions=null, $err = null) {
    include('testtools.php');
}

function loadtest($category, $name, $questions) {
    include('testui.php');
}


