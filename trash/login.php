<?php

    include '../scripts/user.php';

    session_start();
    $msg = "";
    $loginMsg = "";
    $_SESSION['email'] = "";
    $_SESSION['emailLogin'] = "";
    $_SESSION['password'] = "";
    $_SESSION['confPass'] = "";
    $_SESSION['name'] = "";
    $_SESSION['ra'] = "";
    if(isset($_SESSION['userList']))
        $userList = $_SESSION['userList'];
    else {
        $userList = array(
            new User('joao@g.unicamp.br', 'joao', 'joao', 'joao', '202235', 'joao', '../images/pfp.png'),
            new User('enrique@g.unicamp.br', 'enrique', 'enrique', 'enrique', '202207', 'enrique', '../images/pfp.png'),
            new User('jedson@g.unicamp.br', 'jedson', 'jedson', 'jedson', '202157', 'jedson', '../images/pfp.png'),
            new User('gabriel@g.unicamp.br', 'gabriel', 'gabriel', 'gabriel', '202200', 'gabriel', '../images/pfp.png'),
            new User('julya@g.unicamp.br', 'julya', 'julya', 'julya', '202200', 'julya', '../images/pfp.png'),
        );
        $_SESSION['userList'] = $userList;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $method = $_POST['button'];

        if($method == 'cadaster') {
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            $_SESSION['confPass'] = $_POST['confPass'];
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['ra'] = $_POST['ra'];    

            $user = new User($_SESSION['email'], $_SESSION['password'], $_SESSION['confPass'], $_SESSION['name'], $_SESSION['ra'], '', '');
            $msg = $user->checkForm();
            if($msg == '') {
                array_push($userList, $user);
                $_SESSION['userList'] = $userList;
                header('Location: profileConf.php');
            }
        }

        if($method == 'login') {
            $_SESSION['emailLogin'] = $_POST['emailLogin'];
            $_SESSION['passwordLogin'] = $_POST['passwordLogin'];

            $user = new User($_SESSION['emailLogin'], $_SESSION['passwordLogin'], '', '', '', '', '');
            $loginMsg = $user->checkLogin();
            if($loginMsg == '') {
                header('Location: home.php');
            }
        }
    }

?>