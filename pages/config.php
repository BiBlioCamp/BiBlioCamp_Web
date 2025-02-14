<?php

    session_start();
    $nameChange = "";
    $passwordChange = "";
    $emailChange = "";
    $deleteChange = "";
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(!isset($_SESSION['username'])) {
            header("Location: error.html");
        }
        else {
            $username = $_SESSION["username"];
            $pfp = "cotil.png";
            $pfpAction = 'profile.php';
            if(isset($_GET['parameter'])){
                $parameter = $_GET['parameter'];
                if($parameter == 'nameS'){
                    $nameChange = '<p class="success">Nome alterado com sucesso</p>';
                }else if($parameter == 'passwordS'){
                    $passwordChange = '<p class="success">Senha alterada com sucesso</p>';
                }else if($parameter == 'emailS'){
                    $emailChange = '<p class="success">Email alterado com sucesso</p>';
                }else if($parameter == 'nameF'){
                    $nameChange= '<p class="fail">Nome Inválido</p>';
                }else if($parameter == 'passwordF'){
                    $passwordChange = '<p class="fail">Senha Inválida</p>';
                }else if($parameter == 'emailF'){
                    $emailChange = '<p class="fail">Email Inválido</p>';
                }else if($parameter == 'deleteF'){
                    $deleteChange = '<p class="fail">Senha Incorreta</p>';
                }
            }
        }
    }else if($_SERVER["REQUEST_METHOD"] === "POST"){
        $username = $_SESSION["username"];
        $pfp = "cotil.png";
        $pfpAction = 'profile.php';
        $button = $_POST['btn'];
        try{
            include "conexaoDB.php";
            if($button == "Alterar Nome"){
                $nome = $_POST['nome'];
                if(isset($nome) and $nome != ""){
                   $pos_Username = strpos($nome,' ');
                    if($pos_Username == null){
                        $update_username = $nome;
                    }else{
                        $update_username = substr($nome,0,$pos_Username);
                    }
                    $stmt = $pdo->prepare("update BBC_Account set name = :nome, username = :username where id = :id");
                    $stmt->bindParam(':nome',$nome);
                    $stmt->bindParam(':username',$update_username);
                    $stmt->bindParam(':id', $_SESSION['ra']);
                    $stmt->execute();
                    $rows = $stmt->rowCount();
                    if($rows > 0){
                        $_SESSION['username'] = $update_username;
                        header("Location: config.php?parameter=nameS");
                    }
                }else{
                    header("Location: config.php?parameter=nameF");
                }
            }else if($button == 'Alterar Email'){
                $email = $_POST['email'];

                if(isset($email) and $email != ""){
                    $stmt = $pdo->prepare("update BBC_Account set email = :email where id = :id");
                    $stmt->bindParam(':email',$email);
                    $stmt->bindParam(":id", $_SESSION['ra']);
                    $stmt->execute();
                    $rows = $stmt->rowCount();
                    if($rows > 0){
                        header("Location: config.php?parameter=emailS");
                    }
                }else{
                    header("Location: config.php?parameter=emailF");
                }
            }else if($button == 'Alterar Senha'){
                $senha = $_POST['senha'];
                $newSenha = $_POST['newSenha'];
                $confNewSenha = $_POST['confNewSenha'];
                if(trim($senha) != '' and trim($newSenha) != '' and trim($confNewSenha) != ''){
                    $stmt = $pdo->prepare("select password from BBC_Account where id = :id");
                    $stmt->bindParam(":id", $_SESSION['ra']);
                    $stmt->execute();
                    $rows = $stmt->fetch();
                    if($senha == $rows['password']){
                        if($senha != $newSenha){
                            if($newSenha == $confNewSenha){
                                $stmt = $pdo->prepare("update BBC_Account set password = :password where id = :id");
                                $stmt->bindParam(":password", $newSenha);
                                $stmt->bindParam(":id", $_SESSION['ra']);
                                $stmt->execute();
                                $rows = $stmt->rowCount();
                                if($rows > 0){
                                    header("Location: config.php?parameter=passwordS");
                                }
                            }else{
                                header("Location: config.php?parameter=passwordF");    
                            }
                        }else{
                            header("Location: config.php?parameter=passwordF");    
                        }
                    }else{
                        header("Location: config.php?parameter=passwordF");
                    }
                }else{
                    header("Location: config.php?parameter=passwordF");
                }
            }else if($button == 'Excluir Conta'){
                $exc = $_POST['exclusão'];
                if($exc != ''){
                    $stmt = $pdo->prepare("select password from BBC_Account where id = :id");
                    $stmt->bindParam(':id',$_SESSION['ra']);
                    $stmt->execute();
                    $rows = $stmt->fetch();
                    if($exc == $rows['password']){
                        $stmt = $pdo->prepare("update BBC_Account set active = 0 where id = :id");
                        $stmt->bindParam(':id',$_SESSION['ra']);
                        $stmt->execute();
                        $rows = $stmt->rowCount();
                        if($rows > 0){
                            header("Location: logout.php");
                        }
                    }else{
                        header('Location: config.php?parameter=deleteF');
                    }
                }else{
                    header('Location: config.php?parameter=deleteF');
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
    <title>Configurações</title>
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/config.css">
    <link rel="stylesheet" href="../styles/reset.css">
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
                    <a href="alocacao.php">
                        <i class='bx bxs-package' ></i>
                        <span class="link_name">Suas Alocações</span>
                    </a>                  
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="alocacao.php">Alocações</a></li>
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
                        <a href="<?=$pfpAction ?>">
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
    </div>
    <div class="body-container">
        <div class="left-content">
            <p class="title">Gerenciamento de conta</p>
            <div class="subs">
                <p><i class='bx bxs-rename'></i>Nome</p>
                <p><i class='bx bxs-envelope'></i>Email</p>
                <p><i class='bx bxs-key'></i>Senha</p>
                <p><i class='bx bxs-shield-x'></i>Status</p>
            </div>
        </div>
        <div class="right-content">
            <form method="POST" id="forms">
                <div class="data-area">
                    <div class="explain-text">
                        <p class="title"><i class='bx bxs-rename'></i> Alterar seu Nome</i></p>
                        <p class="sub">Seu nome é muito importante, é com ele que você se identifica aqui no site e também pode ser usado para confirmar sua identidade na hora de retirar seu livro reservado!</p>
                    </div>
                    <div class="form">
                        <div class="input-msg">
                            <input type="text" class="input" name="nome" oninput="nameValidate()" id="inputs" placeholder="Digite seu Nome">
                            <?=$nameChange?><!--<p class="fail">$nomeAlterado</p> <class = success "Nome alterado com sucesso!" / fail "Seu nome precisa de no minimo X Digitos."-->
                        </div>
                        <input type="submit" class="button hvr" name="btn" value="Alterar Nome">
                    </div>
                </div>   

                <div class="data-area">
                    <div class="explain-text">
                        <p class="title"><i class='bx bxs-envelope'></i> Alterar seu Email</p>
                        <p class="sub">Seu email é muito importante, é a unica forma de podermos notificar você de qualquer distancia sem problema, além de assim como o nome, ajudar você a se identificar!</p>
                    </div>
                    <div class="form">
                        <div class="input-msg">
                            <input type="text" class="input" name="email" id="inputs" oninput="emailValidate()" placeholder="Digite seu Email">
                            <?=$emailChange?><!-- <p class="">$emailAlterado</p> class = success "Email alterado com sucesso!" / fail "Seu email precisa ser UNICAMP." -->
                        </div>
                        <input type="submit" class="button hvr" name="btn" value="Alterar Email">
                    </div>
                </div>  

                <div class="data-area">
                    <div class="explain-text">
                        <p class="title"><i class='bx bxs-key'></i> Alterar sua Senha</p>
                        <p class="sub">Sua senha é muito importante, se você suspeita de que ela esteja comprometida troque imediatamente! A unica maneira de entrar em sua conta é com sua senha, projeta-a com cuidado!</p>
                    </div>
                    <div class="form">
                        <div class="password-inputs">
                            <input type="password" class="input" name="senha" id="inputs" placeholder="Digite sua senha atual">
                            <!-- <p class="fail">$senhaIncorreta</p> class = fail "Senha incorreta." -->
                            <input type="password" class="input" name="newSenha" id="inputs" oninput="passwordValidate()" placeholder="Digite sua nova senha">
                            <!-- <p class="fail">$senhaInvalida</p> class = fail "Sua senha precisa de no minimo 8 digitos." -->
                            <input type="password" class="input" name="confNewSenha" oninput="confPassword()" id="inputs" placeholder="Confirme sua nova senha">
                            <?=$passwordChange?><!-- <p class="">$senhasDiferentes</p> class = success "Senha alterada com sucesso!" / fail "Senhas não coincidem." -->
                        </div>
                        <input type="submit" class="button hvr" name="btn" value="Alterar Senha">
                    </div>
                </div>  

                <div class="data-area">
                    <div class="explain-text">
                        <p class="title"><i class='bx bxs-shield-x'></i> Excluir sua conta</p>
                        <p class="sub">Tome muito cuidado, a unica maneira de recuperar sua conta após exclui-la é diretamente com a diretoria da escola, sua conta será excluida para sempre! (Isso é um tempão)!</p>
                    </div>
                    <div class="form">
                        <div class="input-msg">
                            <input type="password" class="input" name="exclusão" id="inputs" placeholder="Digite sua Senha">
                            <?=$deleteChange?><!-- <p class="">$senhaExcludeIncorreta</p> class = fail "Senha incorreta." -->
                        </div>
                        <input type="submit" class="button hvr" name="btn" value="Excluir Conta">
                    </div>
                </div>   
            </form>
        </div>
    </div>
</body>
    <script src="../scripts/sidebar.js"></script>
    <script>

        const form = document.getElementById('forms');
        const campos = document.querySelectorAll('#inputs');
        const buttons = document.querySelectorAll('.button');

        function setError(index){
            campos[index].style.border = '1px solid #e63636';
            buttons[index].disabled = true;
            buttons[index].style.cursor = 'default';
            buttons[index].classList.remove('hvr');
        }

        function removeError(index){
            campos[index].style.border = '';
            buttons[index].disabled = false;
            buttons[index].style.cursor = 'pointer';
            buttons[index].classList.add('hvr');
        }

        function removeErrorPassword(index){
            campos[index].style.border = '';
            buttons[2].disabled = false;
            buttons[2].style.cursor = 'pointer';
            buttons[2].classList.add('hvr');
        }

        function setErrorPassword(index){
            campos[index].style.border = '1px solid #e63636';
            buttons[2].disabled = true;
            buttons[2].style.cursor = 'default';
            buttons[2].classList.remove('hvr');
        }

        function emailValidate(){
            if(campos[1].value == ""){
                removeError(1);
            }else if((campos[1].value.indexOf("@g.unicamp.br")) == -1){
                setError(1);
            }else{
                removeError(1);
            }
        }

        function passwordValidate(){
            if(campos[3].value == ""){
                removeErrorPassword(3);
                verificaPasswords();
            }else if(campos[3].value.length < 8){
                setErrorPassword(3);
            }else{
                removeErrorPassword(3);
                verificaPasswords();
            }
        }

        function verificaPasswords(){
            if(campos[3].value != campos[4].value || campos[3].value.length < 8 || campos[4].value.length < 8){
                setButtonError();
            }else{
                removeButtonError();
            }
        }

        function setButtonError(){
            buttons[2].disabled = true;
            buttons[2].style.cursor = 'default';
            buttons[2].classList.remove('hvr');
        }

        function removeButtonError(){
            buttons[2].disabled = false;
            buttons[2].style.cursor = 'pointer';
            buttons[2].classList.add('hvr');
        }

        function confPassword(){
            if(campos[4].value == ""){
                removeErrorPassword(4);
                verificaPasswords();
            }else if(campos[4].value != campos[3].value || campos[4].value.length < 8 || campos[3].value.length < 8){
                setErrorPassword(4);
            }else{
                removeErrorPassword(4);
                verificaPasswords();
            }
        }

        function nameValidate(){
            if(campos[0].value == ""){
                removeError(0);
            }else if(campos[0].value.length < 3){
                setError(0);
            }else{
                removeError(0);
            }
        }

    </script>
</html>