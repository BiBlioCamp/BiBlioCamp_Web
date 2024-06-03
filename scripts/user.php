<?php

class User {
    private $name;
    private $email;
    private $password;
    private $confPass;
    private $ra;
    private $username;
    private $pfp;

    public function __construct($email, $password, $confPassword, $name, $ra, $username, $pfp) {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->confPass = $confPassword;
        $this->ra = $ra;
        $this->username = $username;
        $this->pfp = $pfp;
    }

    public function checkEmail() {
        $exists = false;
        if(str_contains($this->email, '@g.unicamp.br')) {
            foreach($_SESSION['userList'] as $user) {
                if($this->email == $user->getEmail()) {
                    $exists = true;
                }
            }
            if ($exists) {
                return 'exists';
            }
            else {
                return 'elegible';
            }
        }
        else {
            return 'inelegible';
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
        
        switch($this->checkEmail()) {
            case 'inelegible':
                $_SESSION['email'] = '';
                $msg .= 'Use um email Unicamp para fazer login! (@g.unicamp.br)<br>';
                break;
            case 'exists':
                $_SESSION['email'] = '';
                $msg .= 'Esse email já esta cadastrado!<br>';
                break;
        }
        if(!$this->checkPassword()) {
            $_SESSION['confPass'] = '';
            $msg .= 'As senhas não coincidem!<br>';
        }
        if(!$this->checkRa()) {
            $_SESSION['ra'] = '';
            $msg .= 'O RA informado não é valido!<br>';
        }
        
        return $msg;
    }
    public function checkLogin() {
        $msg = '';

        foreach($_SESSION['userList'] as $user) {
            if($this->email == $user->getEmail()) {
                if($this->password == $user->getPassword()) {
                    $this->setName($user->getName());
                    $_SESSION['name'] = $user->getName();
                    $this->setEmail($user->getEmail());
                    $_SESSION['email'] = $user->getEmail();
                    $this->setPassword($user->getPassword());
                    $_SESSION['password'] = $user->getPassword();
                    $this->setConfPass($user->getConfPass());
                    $this->setRa($user->getRa());
                    $_SESSION['ra'] = $user->getRa();
                    $this->setPfp($user->getPfp());
                    $_SESSION['pfp'] = $user->getPfp();
                    $this->setUsername($user->getUsername());
                    $_SESSION['username'] = $user->getUsername();
                    $msg = '';
                    break;
                }
                else {
                    $msg = 'Senha incorreta!<br>';
                    $_SESSION['password'] = '';
                    $_SESSION['emailLogin'] = $user->getEmail();
                    break;
                }
            }
            else {
                $msg = 'Esse email não está cadastrado ou está incorreto!<br>';
                $_SESSION['emailLogin'] = '';
                $_SESSION['passwordLogin'] = '';
            }
        }
        return $msg;
    }
    public function refreshUser() {
        $pos = count($_SESSION['userList']) - 1;
        $newUser = new User(            
            $_SESSION['userList'][$pos]->getEmail(),            
            $_SESSION['userList'][$pos]->getPassword(),            
            $_SESSION['userList'][$pos]->getConfPass(),
            $_SESSION['userList'][$pos]->getName(),
            $_SESSION['userList'][$pos]->getRa(),
            $this->username,
            $this->pfp,
        );
        $userList = $_SESSION['userList'];
        array_pop($userList);
        array_push($userList, $newUser);
        $_SESSION['userList'] = $userList;
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
    public function getUsername() {
        return $this->username;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function getPfp() {
        return $this->pfp;
    }
    public function setPfp($pfp) {
        $this->pfp = $pfp;
    }
}