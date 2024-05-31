<?php

    session_start();
    $_SESSION['email'] = "";
    $_SESSION['password'] = "";
    $_SESSION['confPass'] = "";
    $_SESSION['name'] = "";
    $_SESSION['ra'] = "";
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $username = "User";
        $pfp = "unsetPfp.png";
        $pfpAction = "login.php";
        $msg = "";
    }
    else if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $method = $_POST['button'];

        if($method == 'cadaster') {
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['ra'] = $_POST['ra'];
            if($_SESSION['password'] == $_POST['confPass']) {
                $_SESSION['confPass'] = $_POST['confPass'];
                header('Location: profileConf.php');
            }
            else {
                $msg = 'As senhas não coincidem!';
            }
        }
        else if($method = 'login') {

        }
        else {
            $username = "User";
        }
    }

?>