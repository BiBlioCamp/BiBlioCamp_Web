<?php

class User {
    private $name;
    private $email;
    private $password;
    private $confPass;
    private $ra;

    public function __construct($email, $password, $confPassword, $name, $ra) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->confPass = $confPassword;
        $this->ra = $ra;
    }

    public function checkEmail() {
        if(str_contains($this->email, '@g.unicamp.br')) {
            return true;
        }
        else {
            return false;
        }
    }
    public function checkPassword() {
        if($this->password == $this->confPass) {
            return true;
        }
        else {
            return false;
        }
    }
    public function checkRa() {
        if(is_numeric($this->ra) && strlen($this->ra) == 6) {
            return true;
        }
        else {
            return false;
        }
    }

    public function checkForm() {
        $msg = '';
        
        if(!$this->checkEmail()) {
            $_SESSION['email'] = '';
            $msg .= 'Use um email Unicamp para fazer login! (@g.unicamp.br)';
        }
        if(!$this->checkPassword()) {
            $_SESSION['confPass'] = '';
            $msg .= 'As senhas não coincidem!';
        }
        if(!$this->checkRa()) {
            $_SESSION['ra'] = '';
            $msg .= 'O RA informado não é valido!';
        }
        
        return $msg;
    }
    
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function getRa() {
        return $this->ra;
    }
    public function setRa($ra) {
        $this->ra = $ra;
    }
    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function getConfPass() {
        return $this->confPass;
    }
    public function setConfPass($confPass) {
        $this->confPass = $confPass;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
}

?>