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
            else
                $msg = "As senhas não coincidem!";
        }
        else if($method = 'login') {

        }
        else {
            $username = "User";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="../javascript/loginSwap.js" defer></script>
    <link rel="stylesheet" href="../styles/login.css">
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/jpg" href="../images/logobbc.png"/>
</head>
<body>
    <div class="container">
        <div class="sidebar close">
            <div class="logo-details">
                <i class="bx bx-menu"></i>
                <span class="logo_name">Menu</span>
            </div>         
            <div class="icon-details">                 
                <div class="icon-content">
                    <a href="home.php">
                        <img src="../images/logobbc.png" alt="Logo">
                    </a>
                </div>              
                <div class="name-bbc">                
                    <div class="bbc_name">BiblioCamp</div>
                </div>     
                <a href="#" class="about">
                    <i class='bx bx-link-external'></i>
                </a>    
            </div>    
            <ul class="nav-links">            
                <li>                
                    <a href="home.php">
                        <i class='bx bxs-home'></i>
                        <span class="link_name">Home</span>
                    </a>                  
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="home.html">Home</a></li>
                    </ul>                
                </li>

                <li>                
                    <a href="#">
                        <i class='bx bx-library'></i>
                        <span class="link_name">Acervo</span>
                    </a>                  
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="#">Acervo</a></li>
                    </ul>                
                </li>

                <li>                
                    <a href="contato.php">
                        <i class='bx bxs-phone' ></i>
                        <span class="link_name">Contato</span>
                    </a>                  
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="contato.html">Contato</a></li>
                    </ul>                
                </li>

                <li>                
                    <a href="#">
                        <i class='bx bxs-package' ></i>
                        <span class="link_name">Suas Alocações</span>
                    </a>                  
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="#">Alocações</a></li>
                    </ul>                
                </li>

                <li>                
                    <a href="ajuda.php">
                        <i class='bx bxs-help-circle' ></i>
                        <span class="link_name">Ajuda</span>
                    </a>                  
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="ajuda.html">Ajuda</a></li>
                    </ul>                
                </li>
                <li>           
                    <div class="profile-details">                 
                        <div class="profile-content">
                            <a href="<?= $pfpAction ?>">
                                <img src="../images/<?= $pfp ?>" alt="profileImg">
                            </a>
                        </div>              
                        <div class="name-job">                
                            <div class="profile_name"><?= $username ?></div>
                        </div>                
                        <a href="logout.php" class="logout">
                            <i class="bx bx-log-out"></i>
                        </a>    
                    </div>            
                </li>
            </ul>
        </div>
    <main>
        
        <div class="loginContainer" id="loginContainer">
            <div class="formContainer">
                <form class="form formLogin" method="POST">
                    <h2 class="title">Entrar</h2>
                    <div class="formRegion">
                        <div class="formInputs">
                            <div class="inputGroup">
                                <div>
                                    <input required type="text" id="email" class="input" name="email">
                                    <label class="label" for="email">Email</label>
                                </div>
                                <div>
                                    <input required type="password" id="senha" class="input" name="password">
                                    <label class="label" for="senha">Senha</label>
                                </div>
                            </div>
                        </div>
                        <button class="formButton" id="buttonLogin" name="button" value="login">Entrar</button>
                    </div>
                    <a href="#" class="formLink">Esqueceu a senha?</a>
                </form>
                <form class="form formRegister" method="POST">
                    <h1 class="title">Cadastrar-se</h1>
                    <div class="formInputs">
                        <div class="inputGroup">
                            <div>
                                <input required type="text" id="email" class="input" name="email" value="<?= $_SESSION['email'] ?>">
                                <label class="label" for="email">Email</label>
                            </div>
                            <div>
                                <input required type="password" id="senha" class="input" name="password" value="<?= $_SESSION['password'] ?>">
                                <label class="label" for="senha">Senha</label>
                            </div>
                            <div>
                                <input required type="password" id="senha" class="input" name="confPass">
                                <label class="label" for="confirmarsenha">Confirmar Senha</label>
                            </div>
                            <p><?= $msg ?></p>
                        </div>
                    </div>
                    <h1 class="title">Dados pessoais</h1>
                    <div class="formInputs">
                        <div class="inputGroup">
                            <div>
                                <input required type="text" id="nome" class="input" name="name" value="<?= $_SESSION['name'] ?>">
                                <label class="label" for="nome">Nome</label>
                            </div>
                            <div>
                                <input required type="text" id="ra" class="input" name="ra" value="<?= $_SESSION['ra'] ?>">
                                <label class="label" for="ra">RA</label>
                            </div>
                        </div>
                    </div>
                    <button class="formButton" id="buttonCadaster" name="button" value="cadaster">Cadastrar</button>
                </form>
            </div>
            <div class="overlayContainer">
                <div class="overlay" id="overlayLogin">
                    <h2 class="title">Já tem uma conta?</h2>
                    <p class="text">Entre agora mesmo</p>
                    <button class="overlayButton" id="openLogin">Ir</button>
                </div>
                <div class="overlay" id="overlayCadaster">
                    <h2 class="title">Não tem uma conta?</h2>
                    <p class="text">Cadastre-se agora em nosso site!</p>
                    <button class="overlayButton" id="openCadaster">Ir</button>
                </div>
            </div>
        </div>
    </main>
</body>
    <script src="../scripts/sidebar.js"></script>
    <script src="../scripts/loginSwap.js"></script>
</html>
