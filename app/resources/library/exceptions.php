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

class CategoryException extends Exception {

    public function __construct($message) {
        parent::__construct($message);
    }
}

class TestException extends Exception {

    public function __construct($message) {
        parent::__construct($message);
    }
}


?>