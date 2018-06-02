<?php

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

class User {
    
    private static $CHECK = "SELECT * FROM user WHERE username='%s' OR email='%s' LIMIT 1";
    private static $SIGNUP = "INSERT INTO user (username, email, password) VALUES ('%s', '%s', '%s')";
    private static $LOGIN = "SELECT * FROM user WHERE username='%s' LIMIT 1";
    
    private static $instance = null;

    private $db = null;
    private $user = null;
    private $admin = false;
    private $logged = false;
    
    private function __construct() {
        $this->db = Connection::get();
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
            $this->logged = true;
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
            $this->logged = true;
            $this->admin = $user['admin'];
        }
    }
    
    
    public function logout() {
        $this->logged = false;
    }
    
    
    public function is_logged() {
        return $this->logged;
    }
    
    public function is_admin() {
        return $this->admin;
    }
    
}
?>