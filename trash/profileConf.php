<?php

    include '../scripts/user.php';

    session_start();
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(!isset($_SESSION['email']))
            header('Location: error.html');
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];

        if(trim($username) != '') {
            if(strlen($username) <= 11) {
                $_SESSION['username'] = $username;
                if($_POST['pfp'] == '') {
                    $_SESSION['pfp'] = 'unknownPfp.png';
                }
                else $_SESSION['pfp'] = $_POST['pfp'];
                $user = new User('', '', '', '', '', $_SESSION['username'], $_SESSION['pfp']);
                $user->refreshUser();
                header('Location: home.php');
            }
        }
    }

?>