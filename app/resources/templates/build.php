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

function topbar() {
    $sections = func_get_args();
    include('topbar.php');
}

function section_head($id, $display = false) {
    echo "<div id='$id' class='section'";
    if( !$display ) {
        echo "style='display:none'";
    }
    echo '>';
    echo '<div class="container-section">';
}

function section_foot() {
    echo "</div> </div>";
}

function table($content) {
    include('table.php');
}

function profile($user) {
    include('profile.php');
}