<?php 

require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/db.php');
require_once(TEMPLATES_PATH . '/build.php');

Session::start();
$user = User::get();

if ( !$user->is_logged() ) {
    header('location: login.php');
}

head(array('topbar', 'sections', 'table'), array('utils', 'table', 'topbar'));
topbar($config['info']['topbar'], 'Career');

section_head();
section_foot();

foot();

?>