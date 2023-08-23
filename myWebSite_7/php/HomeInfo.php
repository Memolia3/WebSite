<?php

class HomeInfo {
    
    private String $email;
    private String $name;
    private String $password;
    private String $sessionMode;
    
    public function __construct(String $email, String $name, String $password, String $sessionMode) {
        $this->email = $email;
        $this->name = $name;
        $this->password = $password;
        $this->sessionMode = $sessionMode;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getPassword() {
        return $this->password;
    }
    
    public function getSessionMode() {
        return $this->sessionMode;
    }
    
}
