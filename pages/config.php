<?php

    session_start();
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(!isset($_SESSION['username'])) {
            header("Location: error.html");
        }
        else {
            $username = $_SESSION["username"];
            $pfp = "cotil.png";
            $pfpAction = 'profile.php';
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
                    }
                }
<<<<<<< HEAD
            }else if($button == 'Alterar Email'){
                $email = $_POST['email'];
=======
            }else if($button == 'email'){
                $email = $_POST['Alterar Email'];
>>>>>>> 0583e25e274c39d3f47e10b69d916e976f058994
                if(isset($email) and $email != ""){
                    $stmt = $pdo->prepare("update BBC_Account set email = :email where id = :id");
                    $stmt->bindParam(':email',$email);
                    $stmt->bindParam(":id", $_SESSION['ra']);
                    $stmt->execute();
                }
            }else if($button == 'Alterar Senha'){
                $senha = $_POST['senha'];
                $newSenha = $_POST['newSenha'];
                $confNewSenha = $_POST['confNewSenha'];
                if($senha != '' and $newSenha != '' and $confNewSenha != ''){
                    $stmt = $pdo->prepare("select password from BBC_Account where id = :id");
                    $stmt->bindParam(":id", $_SESSION['ra']);
                    $stmt->execute();
                    $rows = $stmt->fetch();
                    if($senha == $rows['password']){
                        if($newSenha == $confNewSenha){
                            $stmt = $pdo->prepare("update BBC_Account set password = :password where id = :id");
                            $stmt->bindParam(":password", $newSenha);
                            $stmt->bindParam(":id", $_SESSION['ra']);
                            $stmt->execute();
                        }
                    }
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
            <form method="POST">
                <div class="data-area">
                    <div class="explain-text">
                        <p class="title"><i class='bx bxs-rename'></i> Alterar seu Nome</i></p>
                        <p class="sub">Seu nome é muito importante, é com ele que você se identifica aqui no site e também pode ser usado para confirmar sua identidade na hora de retirar seu livro reservado!</p>
                    </div>
                    <div class="form">
                        <div class="input-msg">
                            <input type="text" class="input" name="nome" placeholder="Digite seu Nome">
                            <!-- <p class="">$nomeAlterado</p> class = success "Nome alterado com sucesso!" / fail "Seu nome precisa de no minimo X Digitos."-->
                        </div>
                        <input type="submit" class="button" name="btn" value="Alterar Nome">
                    </div>
                </div>   

                <div class="data-area">
                    <div class="explain-text">
                        <p class="title"><i class='bx bxs-envelope'></i> Alterar seu Email</p>
                        <p class="sub">Seu email é muito importante, é a unica forma de podermos notificar você de qualquer distancia sem problema, além de assim como o nome, ajudar você a se identificar!</p>
                    </div>
                    <div class="form">
                        <div class="input-msg">
                            <input type="text" class="input" name="nome" placeholder="Digite seu Email">
                            <!-- <p class="">$emailAlterado</p> class = success "Email alterado com sucesso!" / fail "Seu email precisa ser UNICAMP." -->
                        </div>
                        <input type="submit" class="button" name="btn" value="Alterar Email">
                    </div>
                </div>  

                <div class="data-area">
                    <div class="explain-text">
                        <p class="title"><i class='bx bxs-key'></i> Alterar sua Senha</p>
                        <p class="sub">Sua senha é muito importante, se você suspeita de que ela esteja comprometida troque imediatamente! A unica maneira de entrar em sua conta é com sua senha, projeta-a com cuidado!</p>
                    </div>
                    <div class="form">
                        <div class="password-inputs">
                            <input type="text" class="input" name="senha" placeholder="Digite sua senha atual">
                            <!-- <p class="fail">$senhaIncorreta</p> class = fail "Senha incorreta." -->
                            <input type="text" class="input" name="newSenha" placeholder="Digite sua nova senha">
                            <!-- <p class="fail">$senhaInvalida</p> class = fail "Sua senha precisa de no minimo 8 digitos." -->
                            <input type="text" class="input" name="confNewSenha" placeholder="Confirme sua nova senha">
                            <!-- <p class="">$senhasDiferentes</p> class = success "Senha alterada com sucesso!" / fail "Senhas não coincidem." -->
                        </div>
                        <input type="submit" class="button" name="btn" value="Alterar Senha">
                    </div>
                </div>  

                <div class="data-area">
                    <div class="explain-text">
                        <p class="title"><i class='bx bxs-shield-x'></i> Excluir sua conta</p>
                        <p class="sub">Tome muito cuidado, a unica maneira de recuperar sua conta após exclui-la é diretamente com a diretoria da escola, sua conta será excluida para sempre! (Isso é um tempão)!</p>
                    </div>
                    <div class="form">
                        <div class="input-msg">
                            <input type="text" class="input" name="nome" placeholder="Digite sua Senha">
                            <!-- <p class="">$senhaExcludeIncorreta</p> class = fail "Senha incorreta." -->
                        </div>
                        <input type="submit" class="button" name="btn" value="Excluir Conta">
                    </div>
                </div>   
            </form>
        </div>
    </div>
</body>
    <script src="../scripts/sidebar.js"></script>
    <script>

        function setError(index){
            campos[index].style.border = '1px solid #e63636';
            labels[index].style.color = '#e53636';
            spans[index].style.display = 'block';
        }

        function removeError(index){
            campos[index].style.border = '';
            labels[index].style.color = '#A7A5B5';
            spans[index].style.display = 'none';
        }

        function emailValidate(){
            if(document.getElementById('email').value == ""){
                removeError(0);
            }else if((document.getElementById('email').value.indexOf("@g.unicamp.br")) == -1){
                setError(0);
            }else{
                removeError(0);
            }
        }
    </script>
</html>