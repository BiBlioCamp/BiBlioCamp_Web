<?php

    $books = array();
    $booksText = array();
    $lines = "";
    session_start();
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(!isset($_SESSION['username'])) {
            header("Location: error.html");
        }
        else {
            $username = $_SESSION["username"];
            $pfp = "cotil.png";
            $pfpAction = 'profile.php';
            try{
                include "conexaoDB.php";
                $stmt = $pdo->prepare("select count(*) as count from BBC_Aloc where userId = :id and status !='entregue'");
                $stmt->bindParam(':id',$_SESSION['ra']);
                $stmt->execute();
                $rows = $stmt->fetch();
                $reservasCount = $rows['count'];
                $stmt = $pdo->prepare("select bookId from BBC_Aloc where userId = :id and status !='entregue'");
            }catch(PDOException $e){
                echo "Erro: " . $e->getMessage();
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suas Reservas</title>
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/alocacao.css">
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
    <div class="upperText">
        <p>Suas Reservas</p>
    </div>
    <div class="reserve-area">
        <p class="reserve-number"><?=$reservasCount?> reservas registradas</p>
        <div class="reserve"> <!-- Seu template de livro reservado começa aqui // ancora aqui para chegar do perfil?? -->
            <div class="book-content">
                <div class="book-title">
                    <p>Introdução a programação com python</p>
                </div>
                <div class="book-cover">
                    <img src="../images/pythonCover.png" alt="Livro">
                </div>
            </div>
            <div class="reserve-data">
                <p>Data de retirada: <br>{data de retirada}</p>
                <p>Data de devolução: <br>{data de devolução}</p>
                <p>Status do livro: <br>{status do livro}</p>
            </div>
            <form>
                <div class="form-area">
                    <p class='warning late'>Expira em {data de devolução - data de hoje} dias</p>
                    <!--
                        Em posse: <p class='warning'>Expira em {data de devolução - data de hoje} dias</p> {
                            se {data de devolução - data de hoje} <= 2 class='warning late'
                            senão class='warning'
                        }
                        Retirar: <p class='warning'>Retirada em {data de retirada - data de hoje} dias</p>
                        Atrasado: <p class='warning late'>Atrasado há {data de hoje - data de devolução} dias</p>
                        Entregue: Some da pagina e aparece no perfil 
                    -->
                    <input type="submit" value="Cancelar Reserva" class="button">
                </div>
            </form>
        </div> <!-- Seu template de livro reservado termina aqui -->
    </div>
</body>
    <script src="../scripts/sidebar.js"></script>
</html>