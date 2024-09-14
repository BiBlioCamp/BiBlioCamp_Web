<?php
    $loginMsg = "";
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        try{
            include "conectionDB.php";
            if($_POST["button"] == "login"){
                $username = $_POST["emailLogin"];
                $password = $_POST["passwordLogin"];
                if(trim($username) != "" && trim($password) != ""){
                    $stmt = $pdo->prepare("select * from BBC_Cliente where email = :email and senha = :senha;");
                    $stmt->bindParam(":email",$username);
                    $stmt->bindParam(":senha", $password);
                    $stmt->execute();
                    $rows = $stmt->rowCount();
                    if($rows > 0){
                        $userData = $stmt->fetch();
                        session_start();
                        $_SESSION["username"] = $userData["username"];
                        $_SESSION["senha"] = $userData["senha"];
                        header("location: home.html");
                    }else{
                        $loginMsg = "Usuário ou senha incorreto.";
                    }
                }
            }
        }catch(PDOException $e){
            echo "Erro: " . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acessar</title>
    <link rel="stylesheet" href="../styles/login.css">
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" href="../scripts/user.html">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/jpg" href="../images/logobbc.png"/>
</head>
    <script language="javascript">
        function isMobile() {
            const userAgent = navigator.userAgent.toLowerCase();
            if(userAgent.search(/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up.browser|up.link|webos|wos)/i)!= -1)
                window.location.href = "mobileError.html";
        }
        window.onload(isMobile());
    </script>
<body>
        <div class="sidebar close">
            <div class="logo-details">
                <i class="bx bx-menu"></i>
                <span class="logo_name">Menu</span>
            </div>         
            <div class="icon-details">                 
                <div class="icon-content">
                    <a href="home.html">
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
                    <a href="home.html">
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
                    <a href="contato.html">
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
                    <a href="ajuda.html">
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
                            <a href="#">
                                <img src="../images/unsetPfp.png" alt="profileImg">
                            </a>
                        </div>              
                        <div class="name-job">                
                            <div class="profile_name">User</div>
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
                <form class="form formLogin" method="POST" name="login">
                    <h2 class="title">Entrar</h2>
                    <div class="formRegion">
                        <div class="formInputs">
                            <div class="inputGroup">
                                <div>
                                    <!-- <input required type="text" id="email" class="input" name="emailLogin" value="<?= $_SESSION['emailLogin'] ?>"> -->
                                    <input required type="text" id="email" class="input" name="emailLogin">
                                    <label class="label" for="email">Email</label>
                                </div>
                                <div>
                                    <input required type="password" id="senha" class="input" name="passwordLogin">
                                    <label class="label" for="senha">Senha</label>
                                </div>
                            </div>
                        </div>
                        <button class="formButton" id="buttonLogin" name="button" value="login">Entrar</button>
                    </div>
                    <a href="#" class="formLink">Esqueceu a senha?</a>
                    <p><?= $loginMsg ?></p>
                </form>
                <form class="form formRegister" method="POST" name='cadaster' action="profileConf.html">
                    <h1 class="title">Cadastrar-se</h1>
                    <div class="formInputs">
                        <div class="inputGroup">
                            <div>
                                <!-- <input required type="text" id="email" class="input" name="email" value="<?= $_SESSION['email'] ?>"> -->
                                <input required type="text" id="email" class="input" name="email">
                                <label class="label" for="email">Email</label>
                            </div>
                            <div>
                                <!-- <input required type="password" id="senha" class="input" name="password" value="<?= $_SESSION['password'] ?>"> -->
                                <input required type="password" id="senha" class="input" name="password">
                                <label class="label" for="senha">Senha</label>
                            </div>
                            <div>
                                <!-- <input required type="password" id="senha" class="input" name="confPass" value="<?= $_SESSION['confPass'] ?>"> -->
                                <input required type="password" id="senha" class="input" name="confPass">
                                <label class="label" for="confirmarsenha">Confirmar Senha</label>
                            </div>
                        </div>
                    </div>
                    <h1 class="title">Dados pessoais</h1>
                    <div class="formInputs">
                        <div class="inputGroup">
                            <div>
                                <!-- <input required type="text" id="nome" class="input" name="name" value="<?= $_SESSION['name'] ?>"> -->
                                <input required type="text" id="nome" class="input" name="name">
                                <label class="label" for="nome">Nome</label>
                            </div>
                            <div>
                                <!-- <input required type="text" id="ra" class="input" name="ra" value="<?= $_SESSION['ra'] ?>"> -->
                                <input required type="text" id="ra" class="input" name="ra">
                                <label class="label" for="ra">RA</label>
                            </div>
                        </div>
                    </div>
                    <button class="formButton" id="buttonCadaster" name="button" value="cadaster">Cadastrar</button>
                    <!-- <p><?= $msg ?></p> -->
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
