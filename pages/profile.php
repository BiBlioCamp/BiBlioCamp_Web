<?php
    session_start();
    $booksPosse = array();
    $booksPosseText = array();
    $lines = "";
    $booksRead = array();
    $booksReadText = array();
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(!isset($_SESSION['username'])) {
            header("Location: error.html");
            #$username = "User";
            #$pfp = "unsetPfp.png";
            #$pfpAction = "login.php";
        }
        else {
            $username = $_SESSION["username"];
            $pfp = "cotil.png";
            $pfpAction = 'profile.php';
            try{
                include "conexaoDB.php";
                $stmt = $pdo->prepare("select BBC_Book.id, BBC_Book.title from BBC_Book, BBC_Account, BBC_Aloc where BBC_Book.id = :bookId and BBC_Book.id = BBC_Aloc.bookId and BBC_Account.id = :userId and BBC_Account.id = BBC_Aloc = ");
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
    <title><?= $_SESSION['username'] ?></title>
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/profile.css">
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
                                <img src="../images/cotil.png" alt="profileImg">
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
            <div class="profile-area">
                <div class="pfp-area">
                    <div class="pfp">
                        <!-- <img src="../images/<?= $_SESSION['pfp'] ?>" alt="Foto de perfil"> -->
                        <img src="../images/Cotil.png" alt="Foto de perfil">
                    </div>
                </div>
                <div class="username-area">
                    <div class="username-data">
                        <p><?= $_SESSION['username'] ?></p>
                        <p><?= $_SESSION['ra'] ?></p>
                    </div>
                </div>
                <div class="config">
                    <i class='bx bxs-cog'></i>
                </div>
            </div>
            <div class="books-area">
                <p>Em posse</p>
                <form method="POST">
                    <div class="book-list owning">
                        <button class="book-content">
                            <div class="book-cover">
                                <img src="../images/pythonCover.png" alt="Livro">
                            </div>
                            <div class="book-title">
                                <p>Introdução a programação com python</p>
                            </div>
                        </button>
                        <button class="book-content">
                            <div class="book-cover">
                                <img src="../images/pythonCover.png" alt="Livro">
                            </div>
                            <div class="book-title">
                                <p>Introdução a programação com python</p>
                            </div>
                        </button>
                        <button class="book-content">
                            <div class="book-cover">
                                <img src="../images/pythonCover.png" alt="Livro">
                            </div>
                            <div class="book-title">
                                <p>Introdução a programação com python</p>
                            </div>
                        </button>
                        <button class="book-content">
                            <div class="book-cover">
                                <img src="../images/pythonCover.png" alt="Livro">
                            </div>
                            <div class="book-title">
                                <p>Introdução a programação com python</p>
                            </div>
                        </button>
                        <button class="book-content">
                            <div class="book-cover">
                                <img src="../images/pythonCover.png" alt="Livro">
                            </div>
                            <div class="book-title">
                                <p>Introdução a programação com python</p>
                            </div>
                        </button>
                    </div>
                </form>
                <p>Já reservados pelo menos uma(1) vez</p>
                <div class="book-list">
                    <div class="book-content">
                        <div class="book-cover">
                            <img src="../images/pythonCover.png" alt="Livro">
                        </div>
                        <div class="book-title">
                            <p>Introdução a programação com python</p>
                        </div>
                    </div>
                    <div class="book-content">
                        <div class="book-cover">
                            <img src="../images/pythonCover.png" alt="Livro">
                        </div>
                        <div class="book-title">
                            <p>Introdução a programação com python</p>
                        </div>
                    </div>
                    <div class="book-content">
                        <div class="book-cover">
                            <img src="../images/pythonCover.png" alt="Livro">
                        </div>
                        <div class="book-title">
                            <p>Introdução a programação com python</p>
                        </div>
                    </div>
                    <div class="book-content">
                        <div class="book-cover">
                            <img src="../images/pythonCover.png" alt="Livro">
                        </div>
                        <div class="book-title">
                            <p>Introdução a programação com python</p>
                        </div>
                    </div>
                    <div class="book-content">
                        <div class="book-cover">
                            <img src="../images/pythonCover.png" alt="Livro">
                        </div>
                        <div class="book-title">
                            <p>Introdução a programação com python</p>
                        </div>
                    </div>
                </div>
                <div class="book-list">
                    <div class="book-content">
                        <div class="book-cover">
                            <img src="../images/pythonCover.png" alt="Livro">
                        </div>
                        <div class="book-title">
                            <p>Introdução a programação com python</p>
                        </div>
                    </div>
                    <div class="book-content">
                        <div class="book-cover">
                            <img src="../images/pythonCover.png" alt="Livro">
                        </div>
                        <div class="book-title">
                            <p>Introdução a programação com python</p>
                        </div>
                    </div>
                    <div class="book-content">
                        <div class="book-cover">
                            <img src="../images/pythonCover.png" alt="Livro">
                        </div>
                        <div class="book-title">
                            <p>Introdução a programação com python</p>
                        </div>
                    </div>
                    <div class="book-content">
                        <div class="book-cover">
                            <img src="../images/pythonCover.png" alt="Livro">
                        </div>
                        <div class="book-title">
                            <p>Introdução a programação com python</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="botton-content">

            </div>
    </div>
</body>
    <script src="../scripts/sidebar.js"></script>
</html>