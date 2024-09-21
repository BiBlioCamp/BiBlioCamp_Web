<?php
    $msg = "";
    $loginMsg = "";
    if($_SERVER["REQUEST_METHOD"] === "POST"){
        try{
            include "conexaoDB.php";
            if($_POST["button"] == "login"){
                $username = $_POST["emailLogin"];
                $password = $_POST["passwordLogin"];
                if(trim($username) != "" && trim($password) != ""){
                    $stmt = $pdo->prepare("select * from BBC_Account where email = :email and password = :senha;");
                    $stmt->bindParam(":email",$username);
                    $stmt->bindParam(":senha", $password);
                    $stmt->execute();
                    $rows = $stmt->rowCount();
                    if($rows > 0){
                        $userData = $stmt->fetch();
                        session_start();
                        $_SESSION["username"] = $userData["username"];
                        $_SESSION["senha"] = $userData["password"];
                        $_SESSION["ra"] = $userData["id"];
                        header("location: profile.php");
                    }else{
                        $loginMsg = "Usuário ou senha incorreto.";
                    }
                }
            }else if($_POST["button"] == "cadaster"){
                $email = $_POST["email"];
                $senha = $_POST["password"];
                $confSenha = $_POST["confPass"];
                $name = $_POST["name"];
                $ra = $_POST["ra"];
                $pos_Username = strpos($name,' ');
                $cadaster_username = substr($name,0,$pos_Username);
                if($senha == $confSenha){
                    $stmt = $pdo->prepare("select * from BBC_Account where email = :email");
                    $stmt->bindParam(":email", $email);
                    $stmt->execute();
                    $rows = $stmt->rowCount();
                    if($rows > 0){
                        $msg = "Email já cadastrado";
                    }else{
                        $stmt = $pdo->prepare("insert into BBC_Account (id, name, email, password, username) values (:ra, :nome, :email, :senha, :username)");
                        $stmt->bindParam(":ra",$ra);
                        $stmt->bindParam(":nome",$name);
                        $stmt->bindParam(":email",$email);
                        $stmt->bindParam(":senha",$senha);
                        $stmt->bindParam(":username", $cadaster_username);
                        $stmt->execute();
                        $rows = $stmt->rowCount();
                        if($rows > 0){
                            $msg = "Cadastrado com sucesso!";
                        }else{
                            $msg = "Falha no cadastro";
                        }
                    }
                }else{
                    $msg = "Senhas não compatíveis";
                }
            }
        }catch(PDOException $e){
            echo "Erro: " . $e->getMessage();
        }
        $pdo = null;
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
                    <a href="home.php">
                        <img src="../images/logobbc.png" alt="Logo">
                    </a>
                </div>              
                <div class="name-bbc">                
                    <div class="bbc_name">BiblioCamp</div>
                </div>     
                <a href="https://www.cotil.unicamp.br" target="blank" class="about">
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
                        <li><a class="link_name" href="home.php">Home</a></li>
                    </ul>                
                </li>

                <li>                
                    <a href="acervo.php">
                        <i class='bx bx-library'></i>
                        <span class="link_name">Acervo</span>
                    </a>                  
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="acervo.php">Acervo</a></li>
                    </ul>                
                </li>

                <li>                
                    <a href="contato.php">
                        <i class='bx bxs-phone' ></i>
                        <span class="link_name">Contato</span>
                    </a>                  
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="contato.php">Contato</a></li>
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
                        <li><a class="link_name" href="ajuda.php">Ajuda</a></li>
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
                        <a href="#" class="logout">
                            <i class="bx bx-log-out"></i>
                        </a>    
                    </div>            
                </li>
            </ul>
        </div>
    <main>
        <div class="loginContainer" id="loginContainer">
            <div class="formContainer">
                <form class="form formLogin" method="POST" name="login" action="">
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
                        <button class="formButton" id="buttonLogin" name="button" value="login" >Entrar</button>
                    </div>
                    <a href="#" class="formLink">Esqueceu a senha?</a>
                    <p><?= $loginMsg ?></p>
                </form>
                <form class="form formRegister" id="formRegister" method="POST" name='cadaster' onload="desableSpan()" action="">
                    <h1 class="title">Cadastrar-se</h1>
                    <div class="formInputs">
                        <div class="inputGroup">
                            <div>
                                <!-- <input required type="text" id="email" class="input" name="email" value="<?= $_SESSION['email'] ?>"> -->
                                <input required type="text" id="email" class="input inputValidate" name="email" oninput="emailValidate(), verifyCadaster()">
                                <label class="label labelValidate" for="email">Email</label><br>
                                <span class="span-required">O email informado precisa ser da Unicamp</span>
                            </div>

                            <div>
                                <!-- <input required type="password" id="senha" class="input" name="password" value="<?= $_SESSION['password'] ?>"> -->
                                <input required type="password" id="senha" class="input inputValidate" name="password" oninput="passwordValidate(), verifyCadaster()">
                                <label class="label labelValidate" for="senha">Senha</label><br>
                                <span class="span-required">A senha precisa conter 8 caracteres</span>
                            </div>
                            <div>
                                <!-- <input required type="password" id="senha" class="input" name="confPass" value="<?= $_SESSION['confPass'] ?>"> -->
                                <input required type="password" id="senha" class="input inputValidate" name="confPass" oninput="confPassword(), verifyCadaster()">
                                <label class="label labelValidate" for="confirmarsenha">Confirmar Senha</label><br>
                                <span class="span-required">Senhas devem ser compatíveis</span>
                            </div>
                        </div>
                    </div>
                    <h1 class="title">Dados pessoais</h1>
                    <div class="formInputs">
                        <div class="inputGroup">
                            <div>
                                <!-- <input required type="text" id="nome" class="input" name="name" value="<?= $_SESSION['name'] ?>"> -->
                                <input required type="text" id="nome" class="input inputValidate" name="name" oninput="nameValidate(), verifyCadaster()">
                                <label class="label labelValidate" for="nome">Nome</label><br>
                                <span class="span-required">O nome deve ter 3 caracteres no mínimo</span>
                            </div>
                            <div>
                                <!-- <input required type="text" id="ra" class="input" name="ra" value="<?= $_SESSION['ra'] ?>"> -->
                                <input required type="number" id="ra" class="input inputValidate" name="ra" oninput="raValidate(), verifyCadaster()" ><br>
                                <label class="label labelValidate" for="ra">RA</label>
                                <span class="span-required ra">RA precisa ter 6 números</span>
                            </div>
                        </div>
                    </div>
                    <button class="formButton" id="buttonCadaster" name="button" value="cadaster">Cadastrar</button>
                    <p id="cadasterMessage"><?= $msg ?></p>
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
    <script>
        const form = document.getElementById("formRegister");
        const campos = document.querySelectorAll(".inputValidate");
        const spans = document.querySelectorAll(".span-required");
        const labels =document.querySelectorAll(".labelValidate");

        function setError(index){
            campos[index].style.border = '1px solid #e63636';
            labels[index].style.color = '#e53636';
            spans[index].style.display = 'block';
        }

        function removeError(index){
            campos[index].style.border = '';
            labels[index].style.color = '#4dcbff';
            spans[index].style.display = 'none';
        }

        function emailValidate(){
            if(campos[0].value == ""){
                removeError(0);
            }else if((campos[0].value.indexOf("@g.unicamp.br")) == -1){
                console.log(campos[0].value.indexOf("@g.unicamp.br"));
                setError(0);
            }else{
                removeError(0);
            }
        }

        function passwordValidate(){
            if(campos[1].value == ""){
                removeError(1);
            }else if(campos[1].value.length < 8){
                setError(1);
            }else{
                removeError(1);
            }
        }

        function confPassword(){
            if(campos[2].value == ""){
                removeError(2);
            }else if(campos[2].value != campos[1].value){
                setError(2);
            }else{
                removeError(2);
            }
        }

        function nameValidate(){
            if(campos[3].value == ""){
                removeError(3);
            }else if(campos[3].value.length < 3){
                setError(3);
            }else{
                removeError(3);
            }
        }

        function raValidate(){
            if(campos[4].value == ""){
                resetInput(4);
            }else if(campos[4].value.length != 6){
                setError(4);
            }else{
                removeError(4);
            }
        }

        function desableSpan(){
            spans.style.display = 'none';
        }

        function verifyCadaster(){
            if((campos[0].value.indexOf("@g.unicamp.br")) == -1 || campos[1].value.length < 8 || campos[2].value != campos[1].value || campos[3].value < 3 || campos[4].value.length != 6){
                document.querySelector("#buttonCadaster").disabled = true;
            }else{
                document.querySelector("#buttonCadaster").disabled = false;
            }
        }
    </script>
</html>
