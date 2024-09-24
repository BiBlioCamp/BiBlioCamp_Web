<?php
    //lembra de bloquear pra quem n é user
    //Eu tenho que admitir que essa página ficou bonita pra KARALHO, só isso mesmo

    session_start();
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(!isset($_SESSION['username'])) {
            $username = "User";
            $pfp = "unsetPfp.png";
            $pfpAction = "login.php";
        }
        else {
            $username = $_SESSION["username"];
            $pfp = "cotil.png";
            $pfpAction = 'profile.php';
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
                        <input type="text" class="input" placeholder="Digite seu nome">
                        <input type="submit" class="button" value="Confirmar nome">
                    </div>
                </div>   

                <div class="data-area">
                    <div class="explain-text">
                        <p class="title"><i class='bx bxs-envelope'></i> Alterar seu Email</p>
                        <p class="sub">Seu email é muito importante, é a unica forma de podermos notificar você de qualquer distancia sem problema, além de assim como o nome, ajudar você a se identificar!</p>
                    </div>
                    <div class="form">
                        <input type="text" class="input" placeholder="Digite seu email">
                        <input type="submit" class="button" value="Confirmar email">
                    </div>
                </div>  

                <div class="data-area">
                    <div class="explain-text">
                        <p class="title"><i class='bx bxs-key'></i> Alterar sua Senha</p>
                        <p class="sub">Sua senha é muito importante, se você suspeita de que ela esteja comprometida troque imediatamente! A unica maneira de entrar em sua conta é com sua senha, projeta-a com cuidado!</p>
                    </div>
                    <div class="form">
                        <div class="password-inputs">
                            <input type="text" class="input" placeholder="Digite sua senha atual">
                            <input type="text" class="input" placeholder="Digite sua nova senha">
                            <input type="text" class="input" placeholder="Confirme sua nova senha">
                        </div>
                        <input type="submit" class="button" value="Trocar senha">
                    </div>
                </div>  

                <div class="data-area">
                    <div class="explain-text">
                        <p class="title"><i class='bx bxs-shield-x'></i> Excluir sua conta</p>
                        <p class="sub">Tome muito cuidado, a unica maneira de recuperar sua conta após exclui-la é diretamente com a diretoria da escola, sua conta será excluida para sempre! (Isso é um tempão)!</p>
                    </div>
                    <div class="form">
                        <input type="text" class="input" placeholder="Digite sua senha">
                        <input type="submit" class="button" value="Confirmar exclusão">
                    </div>
                </div>   
            </form>
        </div>
    </div>
</body>
    <script src="../scripts/sidebar.js"></script>
</html>