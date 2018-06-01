<?php
require_once("/var/www/html/Stressful/resources/config.php");


class UserException extends Exception {
    private $stack;
    
    public function __construct($message) {
        parent::__construct($message);
        $this->stack = null;
    }
    
    public function err($name) {
        return isset($this->stack[$name]);
    }
    
    public function push($name, $message) {
        
        if ( !$this->is_set() ) {
            $this->stack = array();
        }
        
        if ( !$this->err($name) ) {
            $this->stack[$name] = array();
        }
        
        array_push($this->stack[$name], $message);
    }
    
    public function get($name) {
        if ( $this->err($name) ) {
            return $this->stack[$name];
        } else {
            return null;
        }
    }
    
    public function is_set() {
        return $this->stack !== null;
    }
}

class ConnectionParams {
    
    private static $params = null;

    public static function set() {

        if(func_num_args() === 4) {

            if(self::$params !== null) {
                throw new Exception("Parameters can be set only once");
            }

            self::$params = array(
                "hostname" => func_get_arg(0),
                "username" => func_get_arg(1),
                "password" => func_get_arg(2),
                "database" => func_get_arg(3)           
            );

        } else {
            return self::$params !== null;
        }

    }

    public static function get($name) {
        if (self::set()) {
            return self::$params[$name];
        } else {
            throw new Exception('Parameters not set yet');
        }
    }

}

class User {
    
    private static $CHECK = "SELECT * FROM users WHERE username='%s' OR email='%s' LIMIT 1";
    private static $SIGNUP = "INSERT INTO users (username, email, password) VALUES ('%s', '%s', '%s')";
    private static $LOGIN = "SELECT * FROM users WHERE username='%s' LIMIT 1";
    
    private static $instance = null;

    private $db = null;
    private $user = null;
    private $admin = false;
    private $logged = false;
    
    private function __construct() {
        $this->db = new mysqli(
            ConnectionParams::get("hostname"),
            ConnectionParams::get("username"),
            ConnectionParams::get("password"),
            ConnectionParams::get("database")
        );
    }
    
    public static function get() {
        
        if(self::$instance === null) {
            self::$instance = new static();   
        }
        
        return self::$instance;
    }
    
    //TODO: add more controls!
    
    public function signup($username, $email, $password) {
        
        $username = $this->db->escape_string($username);
        $email = $this->db->escape_string($email);
        $password = md5($this->db->escape_string($password));
        
        $user = $this->db->query(sprintf(self::$CHECK, $username, $email))->fetch_assoc();
        
        $err = new UserException("Can't create User");
        
        if ( $user ) {
            if ($user['username'] === $username) {
                $err->push('username', 'Username already exists');
            }

            if ($user['email'] === $email) {
                $err->push('email', 'Email already exists');
            }
        }
        
        if( $err->is_set() ) {
            throw $err;
        } else {
            $this->db->query(sprintf(self::$SIGNUP, $username, $email, $password));
            $logged = true;
        }
        
    }
    
    
    public function login($username, $password) {
        
        $username = $this->db->escape_string($username);
        $password = md5($this->db->escape_string($password));

        $user = $this->db->query(sprintf(self::$LOGIN, $username))->fetch_assoc();
        
        $err = new UserException("Can't login User");
        
        if( !$user ) {
            $err->push('username', 'No user with given name');
        } else {
            if ($user['password'] != $password) {
                $err->push('password', 'Wrong password');
            }
        }
        
        if( $err->is_set() ) {
            throw $err;
        } else {
            $logged = true;
        }
    }
    
    
    public function logout() {
        $logged = false;
    }
    
    
    public function is_logged() {
        return $logged;
    }
    
}
?>