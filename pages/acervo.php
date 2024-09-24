<?php

    session_start();
    $books = array();
    $booksText = array();
    $lines = "";
    $msg = "Livros";
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
                $stmt = $pdo->prepare("select * from BBC_Book");
                $stmt->execute();
                $count = $stmt->rowCount(); 
                while($rows = $stmt->fetch()){
                    array_push($booksText,
                "<button class=\"book-content\" type=\"submit\" name=\"button\" value=" . $rows["id"] .">
                            <div class=\"book-cover\">
                                <img src=\"../images/covers/". $rows['cover'] ."\" alt=" . $rows["title"] . ">
                            </div>
                            <div class=\"book-title\">" .
                                $rows["title"] ."
                            </div>
                        </button>"
                    );
                }
                for($i = 0; $i<$count; $i++){
                    $lines .= $booksText[$i];
                    if(($i+1)%5 == 0 || $i == $count-1 and $i !=0){
                        array_push($books, 
                            "<div class=\"book-list\">" .
                                $lines .
                            "</div>"
                        );
                        $lines = "";   
                    }
                }
            }catch(PDOException $e){
                echo "Erro: " . $e->getMessage();
            }
            $pdo = null;
        }
    }else if($_SERVER["REQUEST_METHOD"] === "POST"){
        $username = $_SESSION["username"];
        $pfp = "cotil.png";
        $pfpAction = 'profile.php';
        if($_POST["button"] == "search"){
            if(trim($_POST["busca"]) == ""){
                try{
                    include "conexaoDB.php";
                    $stmt = $pdo->prepare("select * from BBC_Book");
                    $stmt->execute();
                    $count = $stmt->rowCount(); 
                    while($rows = $stmt->fetch()){
                        array_push($booksText,
                    "<button class=\"book-content\" type=\"submit\" name=\"button\" value=" . $rows["id"] .">
                                <div class=\"book-cover\">
                                    <img src=\"../images/covers/". $rows['cover'] ."\" alt=" . $rows["title"] . ">
                                </div>
                                <div class=\"book-title\">" .
                                    $rows["title"] ."
                                </div>
                            </button>"
                        );
                    }
                    for($i = 0; $i<$count; $i++){
                        $lines .= $booksText[$i];
                        if(($i+1)%5 == 0 || $i == $count-1 and $i !=0){
                            array_push($books, 
                                "<div class=\"book-list\">" .
                                    $lines .
                                "</div>"
                            );
                            $lines = "";   
                        }
                    }
                    $msg = "Livros";
                }catch(PDOException $e){
                    echo "Erro: " . $e->getMessage();
                }
                $pdo = null;
            }else{
                try{
                    include "conexaoDB.php";
                    $name = "%" . $_POST["busca"] . "%";
                    $stmt = $pdo->prepare("select * from BBC_Book where title LIKE :title");
                    $stmt->bindParam(":title",$name);
                    $stmt->execute();
                    $count = $stmt->rowCount(); 
                    if($count > 0){
                        while($rows = $stmt->fetch()){
                            array_push($booksText,
                        "<button class=\"book-content\" type=\"submit\" name=\"button\" value=" . $rows["id"] .">
                                    <div class=\"book-cover\">
                                        <img src=\"../images/covers/". $rows['cover'] ."\" alt=" . $rows["title"] . ">
                                    </div>
                                    <div class=\"book-title\">" .
                                        $rows["title"] ."
                                    </div>
                                </button>"
                            );
                        }
                        for($i = 0; $i<$count; $i++){
                            $lines .= $booksText[$i];
                            if(($i+1)%5 == 0 || $i == $count-1){
                                array_push($books, 
                                    "<div class=\"book-list\">" .
                                        $lines .
                                    "</div>"
                                );
                                $lines = "";   
                            }
                        }
                        $msg = "\"" . $_POST["busca"] . "\"";
                    }else{
                        $msg = "\"Nenhum Livro Encontrado\"";
                    }
                }catch(PDOException $e){
                    echo "Erro: " . $e->getMessage();
                }
                $pdo = null;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acervo</title>
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/acervo.css">
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
        <div class="title-area">
            <div class="text">
                <p class="title">Acervo</p>
            </div>
        </div>
        <div class="gap">
            <div class="search-area">
                <div class="search-bar">
                    <form class="search" method="post">
                        <input type="text" class="input" placeholder="Digite o titulo que procura" name="busca">
                        <input type="submit" class="formButton" name="button" value="search">
                    </form>
                </div>
            </div>
            <div class="books-page">
                <form method="POST" action="reserva.php">
                    <p><?=$msg?></p> <!-- Quando fizer o php muda isso para a pesquisa da pessoa com aspas -> "a arte da guerra" -->
                    <?php
                        foreach($books as $value){
                            echo $value;
                        }
                    ?>
                    <!--<div class="book-list">
                        <button class="book-content" type="submit" value="{id do livro}">
                            <div class="book-cover">
                                <img src="../images/pythonCover.png" alt="Livro">
                            </div>
                            <div class="book-title">
                                <p>Introdução a programação com python</p>
                            </div>
                        </button>
                        <button class="book-content" type="submit" value="{id do livro}">
                            <div class="book-cover">
                                <img src="../images/pythonCover.png" alt="Livro">
                            </div>
                            <div class="book-title">
                                <p>Introdução a programação com python</p>
                            </div>
                        </button>
                        <button class="book-content" type="submit" value="{id do livro}">
                            <div class="book-cover">
                                <img src="../images/pythonCover.png" alt="Livro">
                            </div>
                            <div class="book-title">
                                <p>Introdução a programação com python</p>
                            </div>
                        </button>
                        <button class="book-content" type="submit" value="{id do livro}">
                            <div class="book-cover">
                                <img src="../images/pythonCover.png" alt="Livro">
                            </div>
                            <div class="book-title">
                                <p>Introdução a programação com python</p>
                            </div>
                        </button>
                        <button class="book-content" type="submit" value="{id do livro}">
                            <div class="book-cover">
                                <img src="../images/pythonCover.png" alt="Livro">
                            </div>
                            <div class="book-title">
                                <p>Introdução a programação com python</p>
                            </div>
                        </button>
                    </div>-->
                </form>
            </div>
        </div>
</body>
    <script src="../scripts/sidebar.js"></script>
</html>

<!--
    acho q umas 10 linhas de livro ta bom, seriam 50
    Eu imagino como caralhos a gente vai fazer isso para trocar de page quando lotar uma de livro
            <div class="controller">
                <div class="pages-control"> 
                    <div class="left-arrow">
                        <a href="#"><i class='bx bx-chevron-left'></i></a>
                    </div>
                    <p>1</p> 2, 3, 4, 5, 6
                    <div class="right-arrow">
                        <a href="#"><i class='bx bx-chevron-right' ></i></a>
                    </div>
                </div>
            </div>
-->