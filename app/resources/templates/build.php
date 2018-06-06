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

function empty_message($msg) {
    echo "<h1>$msg</h1>";
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