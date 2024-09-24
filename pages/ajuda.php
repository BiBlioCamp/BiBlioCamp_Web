<?php
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
    <title>Ajuda</title>
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/help.css">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
        <div class="upperContainer">
            <div class="leftImage">
                <img src="../images/helpImage.png" alt="help">
            </div>
            <div class="text">
                <p><b>Duvidas frequentes</b></p>
                <span>Esta com algum problema? Veja algumas duvidas que frequentemente são enviadas a nós!</span>
            </div>
        </div>
        <div class="help">
            <div class="main-article">
                <details>
                    <summary>Problemas com login?</summary>
                    <p>1: Verifique se os dados digitados estão realmente corretos.</p>
                    <p>2: Tente alterar sua senha.</p>
                    <p>3: Se não funcionar use o formulário de contato!</p>
                </details>
                <details>
                    <summary>Problemas com cadastro?</summary>
                    <p>1: Verifique se os dados digitados estão realmente corretos.</p>
                    <p>2: Se seus dados não forem veridicos o cadastro pode não funcionar.</p>
                    <p>3: Se não funcionar use o formulário de contato!</p>
                </details>
                <details>
                    <summary>Problemas buscando por livros?</summary>
                    <p>1: Talvez a biblioteca não possua este livro, tente conversar com o funcionario da biblioteca.</p>
                    <p>2: Não use caracteres especiais.</p>
                    <p>3: Tente pesquisar com apenas algumas letras do nome do livro.</p>
                    <p>4: Tente pesquisar por variações do nome do livro.</p>
                    <p>5: Se não funcionar use o formulário de contato!</p>
                </details>
                <details>
                    <summary>Problemas usando o formulario de contato?</summary>
                    <p>1: Verifique se o email não foi digitado incorretamente.</p>
                    <p>2: O uso de palavras de baixo calão em sua mensagem podem barrar o envio do formulario.</p>
                    <p>3: O site pode estar com problemas de conexão, tente novamente mais tarde.</p>
                </details>
                <details>
                    <summary>Problemas com reservas?</summary>
                    <p>1: Verifique se não há um erro na hora de escolher a data.</p>
                    <p>2: Verifique se o estoque do livro não acabou.</p>
                    <p>3: O site pode estar com problemas de conexão, tente novamente mais tarde.</p>
                    <p>4: Se não funcionar use o formulário de contato!</p>
                </details>
            </div>
        </div>
        <div class="bottomContainer">
            <div class="text">
                <h4>Não conseguiu resolver seu problema?</h4>
                <h4>Entre em <a href="contato.php">contato</a> conosco!</h4>
            </div>
        </div>
    </div>
</body>
    <script src="../scripts/sidebar.js"></script>
</html>