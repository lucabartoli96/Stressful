<?php 

require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/db.php');
require_once(TEMPLATES_PATH . '/build.php');

Session::start();
$user = User::get();

if ( !$user->is_logged() ) {
    header('location: login.php');
}

head(array('topbar', 'sections', 'profile'), array('utils', 'topbar', 'profile'));
topbar($config['info']['topbar'], 'Profile');

section_head();
login_form_head('profile-form');
login_form_foot();

section_foot();
foot();

?>