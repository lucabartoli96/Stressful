<?php 
require_once("/var/www/html/Stressful/resources/config.php");

function head( $css = array(), $js = array() ) {
    
    include("header.php");
    
}

function foot() {
    echo "</body> </html> ";
}

function login_form_head($id) {
    echo "<div class='form-container'> <div class='form'>" .
        "<form id='$id'>";
}

function login_form_foot() {
    echo '</form></div></div>';
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


function newtest($operation, $category, $name=null) {
    include('testtools.php');
}

function loadtest($category, $name) {
    include('testui.php');
}


