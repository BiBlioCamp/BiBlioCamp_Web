<?php

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
                header('Location: home.php');
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/profileConf.css">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/jpg" href="../images/logobbc.png"/>
</head>
<body>
    <main>
        <div class="main-container">
            <div class="presentation-text">
                <h1>PERSONALIZE SEU PERFIL</h1>
            </div>
            <form method="POST">
            <div class="content-divider">

                <div class="content-left">
                    <p>Foto de perfil</p>
                    <div class="personal-image">
                        <label class="labelForm">
                            <input class="pfp" type="file" accept="image/*" capture name="pfp">
                            <figure class="personal-figure">
                                <img src="../images/unsetPfp.png" class="personal-avatar" alt="avatar">
                                <figcaption class="personal-figcaption">
                                    <img src="https://raw.githubusercontent.com/ThiagoLuizNunes/angular-boilerplate/master/src/assets/imgs/camera-white.png">
                                </figcaption>
                            </figure>
                        </label>
                    </div>
                </div>
                <div class="content-right">
                    <div class="formInputs">
                        <div class="inputGroup">
                            <div>
                                <p>Escolha seu nome de usuário!</p>
                                <input required type="text" id="email" class="input" name="username">
                                <label class="label" for="email">Username</label>
                            </div>
                            <button class="formButton" id="buttonCadaster">Confirmar</button>
                        </div>
                    </div>                    
                </div>
            </div>
            </form>
        </div>
    </main>
</body>
    <script src="../scripts/pfpChange.js"></script>
</html>