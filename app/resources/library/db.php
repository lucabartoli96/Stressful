<?php

require_once("/var/www/html/Stressful/resources/config.php");
require_once('exceptions.php');
require_once('user.php');
require_once('category.php');

class Session {
    
    public static function start() {
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
    }
    
}

class Connection {
    
    private static $conn = null;
    
    public static function get() {
        
        global $config;
        
        if ( self::$conn === null) {
            self::$conn = new mysqli(
                $config['db']['host'],
                $config['db']['username'],
                $config['db']['password'],
                $config['db']['database']
            );
        }
        
        return self::$conn;
        
    }
}


?>
