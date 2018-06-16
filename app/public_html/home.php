<?php 

require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/db.php');
require_once(TEMPLATES_PATH . '/build.php');

Session::start();
$user = User::get();

if ( !$user->is_logged() ) {
    header('location: login.php');
}

head(array('topbar', 'sections', 'table', 'modal'), array('utils', 'topbar', 'table', 'home'));
topbar($config['info']['topbar']);
section_head();

section_foot();
foot();

?>