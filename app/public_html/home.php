<?php 

require_once("/var/www/html/Stressful/resources/config.php");
require_once(LIBRARY_PATH . '/db.php');
require_once(TEMPLATES_PATH . '/build.php');

Session::start();
$user = User::get();

if ( !$user->is_logged() ) {
    header('location: login.php');
}

head(array('topbar', 'sections', 'table'), array('topbar', 'table'));
topbar('Home', 'Test', 'Profile');

section_head('home', true);
table(Category::get()->all());
section_foot();

section_head('test');
table(Category::get()->all());
section_foot();

section_head('profile');
profile(User::get());
section_foot();
profile(User::get());
foot();

?>