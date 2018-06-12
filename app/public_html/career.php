<?php 

require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/db.php');
require_once(TEMPLATES_PATH . '/build.php');

Session::start();
$user = User::get();

if ( !$user->is_logged() ) {
    header('location: login.php');
}

head(array('topbar', 'sections', 'table'), array('utils', 'topbar'));
topbar($config['info']['topbar'], 'Career');
section_head();

$submitted = Submission::get()->all($user->name());

if ( empty($submitted) ) {
    echo "<h1> No submitted test to show </h1>";
} else {
    table('career', $submitted, false);
}

section_foot();
foot();

?>