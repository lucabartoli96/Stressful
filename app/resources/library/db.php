<?php

require_once("/var/www/html/Stressful/resources/config.php");
require_once('user.php');
require_once('categories.php');

class Connection {
    
    private static $conn = null;

    public static function set() {

        if(func_num_args() === 4) {

            if(self::$conn !== null) {
                throw new Exception("Parameters can be set only once");
            }

            self::$conn = new mysqli(
                func_get_arg(0),
                func_get_arg(1),
                func_get_arg(2),
                func_get_arg(3)
            );

        } else {
            return self::$conn !== null;
        }

    }

    public static function get() {
        if (self::set()) {
            return self::$conn;
        } else {
            throw new Exception('Parameters not set yet');
        }
    }

}


?>
