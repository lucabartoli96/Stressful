<?php

class User {
    
    private static $READ = "SELECT * FROM user WHERE username='%s' LIMIT 1";
    private static $CHECK = "SELECT * FROM user WHERE username='%s' OR email='%s' LIMIT 1";
    private static $SIGNUP = "INSERT INTO user (username, email, password) VALUES ('%s', '%s', '%s')";
    private static $LOGIN = "SELECT * FROM user WHERE username='%s' LIMIT 1";
    
    //private static $instance = null;

    private $user = null;
    private $logged = false;
    
    private function __construct() { }
    
    public static function get() {
        
        Session::start();
        
        if ( !isset($_SESSION[__CLASS__]) ) {
            $_SESSION[__CLASS__] = new static();
        }
        
        return $_SESSION[__CLASS__];
        
    }
    
    private function update_user($username) {
        $db = Connection::get();
        $this->user = $db->query(sprintf(self::$READ, $username))->fetch_assoc();
    }
    
    public function name() {
        if($this->is_logged()) {
            return $this->user['username'];
        } else {
            throw new UserException('User still unlogged');
        }
    }
    
    public function email() {
        if($this->is_logged()) {
            return $this->user['email'];
        } else {
            throw new UserException('User still unlogged');
        }
    }
    
    public function since() {
        if($this->is_logged()) {
            return $this->user['date'];
        } else {
            throw new UserException('User still unlogged');
        }
    }
    
    public function is_logged() {
        return $this->user !== null;
    }
    
    public function is_admin() {
        return $this->user['admin'];
    }
    
    public function signup($username, $email, $password) {
        
        $db = Connection::get();
        
        $username = $db->escape_string($username);
        $email = $db->escape_string($email);
        $password = md5($db->escape_string($password));
        
        $user = $db->query(sprintf(self::$CHECK, $username, $email))->fetch_assoc();
        
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
            $db->query(sprintf(self::$SIGNUP, $username, $email, $password));
            $this->update_user($username);
        }
        
    }
    
    
    public function login($username, $password) {
        
        $db = Connection::get();
        
        $username = $db->escape_string($username);
        $password = md5($db->escape_string($password));

        $user = $db->query(sprintf(self::$LOGIN, $username))->fetch_assoc();
        
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
            $this->update_user($username);
        }
    }
    
    
    public function logout() {
        $this->logged = false;
    }
    
    
}
?>