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
            $pfp = "unknownpfp.png";
            $pfpAction = 'profile.php';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página inicial</title>
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/home.css">
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
                        <li><a class="link_name" href="home.php">Home</a></li>
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
                    <a href="users.php">
                        <i class='bx bxs-user-pin' ></i>
                        <span class="link_name">Usuários</span>
                    </a>                  
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="users.php">Usuários</a></li>
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
            <div class="main-area">
                <div class="right-area">
                    <p class="title">BiblioCamp</p>
                    <p>A melhor maneira de gerenciar suas alocações da biblioteca de escola!</p>
                </div>
            </div>    
            <div class="emphasis-area">
                <p>Livros mais requisitados</p>
                <div class="carousel-container">
                    <div class="carousel-inner">
                        <div class="track">
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/aArteDaGuerraCover.png" alt="Livro"> </div>
                                    <div class="info"> A Arte da Guerra </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/javaCover.png" alt="livro"> </div>
                                    <div class="info"> Programação em Java </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/pythonCover.png" alt="livro"> </div>
                                    <div class="info"> Introdução a Programação com Python </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/cienceCover.png" alt="livro"> </div>
                                    <div class="info"> História das Ciências </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/aArteDaGuerraCover.png" alt="Livro"> </div>
                                    <div class="info"> A Arte da Guerra </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/javaCover.png" alt="livro"> </div>
                                    <div class="info"> Programação em Java </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/pythonCover.png" alt="livro"> </div>
                                    <div class="info"> Introdução a Programação com Python </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/cienceCover.png" alt="livro"> </div>
                                    <div class="info"> História das Ciências </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/aArteDaGuerraCover.png" alt="Livro"> </div>
                                    <div class="info"> A Arte da Guerra </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/javaCover.png" alt="livro"> </div>
                                    <div class="info"> Programação em Java </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/pythonCover.png" alt="livro"> </div>
                                    <div class="info"> Introdução a Programação com Python </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/cienceCover.png" alt="livro"> </div>
                                    <div class="info"> História das Ciências </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/aArteDaGuerraCover.png" alt="Livro"> </div>
                                    <div class="info"> A Arte da Guerra </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/javaCover.png" alt="livro"> </div>
                                    <div class="info"> Programação em Java </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/pythonCover.png" alt="livro"> </div>
                                    <div class="info"> Introdução a Programação com Python </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/cienceCover.png" alt="livro"> </div>
                                    <div class="info"> História das Ciências </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav">
                        <button class="prev">
                            <i class='bx bx-chevron-left'></i>
                        </button>
                        <button class="next shown">
                            <i class='bx bx-chevron-right'></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="bottom-area">
                <p>Livros fora de estoque</p>
                <div class="carousel-container border-black">
                    <div class="carousel-inner">
                        <div class="track track2">
                        <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/aArteDaGuerraCover.png" alt="Livro"> </div>
                                    <div class="info black"> A Arte da Guerra </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/javaCover.png" alt="livro"> </div>
                                    <div class="info black"> Programação em Java </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/pythonCover.png" alt="livro"> </div>
                                    <div class="info black"> Introdução a Programação com Python </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/cienceCover.png" alt="livro"> </div>
                                    <div class="info black"> História das Ciências </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/aArteDaGuerraCover.png" alt="Livro"> </div>
                                    <div class="info black"> A Arte da Guerra </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/javaCover.png" alt="livro"> </div>
                                    <div class="info black"> Programação em Java </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/pythonCover.png" alt="livro"> </div>
                                    <div class="info black"> Introdução a Programação com Python </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/cienceCover.png" alt="livro"> </div>
                                    <div class="info black"> História das Ciências </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/aArteDaGuerraCover.png" alt="Livro"> </div>
                                    <div class="info black"> A Arte da Guerra </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/javaCover.png" alt="livro"> </div>
                                    <div class="info black"> Programação em Java </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/pythonCover.png" alt="livro"> </div>
                                    <div class="info black"> Introdução a Programação com Python </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/cienceCover.png" alt="livro"> </div>
                                    <div class="info black"> História das Ciências </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/aArteDaGuerraCover.png" alt="Livro"> </div>
                                    <div class="info black"> A Arte da Guerra </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/javaCover.png" alt="livro"> </div>
                                    <div class="info black"> Programação em Java </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/pythonCover.png" alt="livro"> </div>
                                    <div class="info black"> Introdução a Programação com Python </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/cienceCover.png" alt="livro"> </div>
                                    <div class="info black"> História das Ciências </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/aArteDaGuerraCover.png" alt="Livro"> </div>
                                    <div class="info black"> A Arte da Guerra </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/javaCover.png" alt="livro"> </div>
                                    <div class="info black"> Programação em Java </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/pythonCover.png" alt="livro"> </div>
                                    <div class="info black"> Introdução a Programação com Python </div>
                                </div>
                            </div>
                            <div class="card-container">
                                <div class="card">
                                    <div class="img"> <img src="../images/cienceCover.png" alt="livro"> </div>
                                    <div class="info black"> História das Ciências </div>
                                </div>
                            </div>
                    </div>
                    <div class="nav">
                        <button class="prev2">
                            <i class='bx bx-chevron-left'></i>
                        </button>
                        <button class="next2 shown">
                            <i class='bx bx-chevron-right'></i>
                        </button>
                    </div>
                </div>
    </div>
</body>
    <script src="../scripts/carouselButton.js"></script>
    <script src="../scripts/sidebar.js"></script>
</html>