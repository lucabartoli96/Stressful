<?php 
require_once("/var/www/html/Stressful/resources/config.php");

function head( $css = array(), $js = array() ) {
    
    include("header.php");
    
}

function foot() {
    echo "</body> </html> ";
}

function login_form_head($action) {
    echo '<div class="fader"> <div class="form">' .
        '<form method="POST" action="'.$action.'">';
}

function login_form_foot() {
    echo '</form></div></div>';
}

function login_err($msg) {
    echo "<div class='alert alert-warning'>$msg</div>";
}

function topbar() {
    $list_a = func_get_args();
    include('topbar.php');
}