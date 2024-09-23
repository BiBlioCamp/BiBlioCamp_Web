<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(!isset($_SESSION['username'])) {
            header("Location: error.html");
            /*$username = "User";
            $pfp = "unsetPfp.png";
            $pfpAction = "login.php";*/
        }
    }else if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = $_SESSION["username"];
        $pfp = "cotil.png";
        $pfpAction = "profile.php";
        try{
            include "conexaoDB.php";
            $id = $_POST["button"];
            $_SESSION["bookId"] = $id;
            $stmt = $pdo->prepare("select title,author,editor,actualStock from BBC_Book where id = :id");
            $stmt->bindParam(":id",$id);
            $stmt->execute();
            $rows = $stmt->fetch();
            $bookName = $rows['title'];
            $bookAuthor = $rows['author'];
            $bookEditor = $rows['editor'];
            $stock = $rows['actualStock'];
            if($stock == 0){
                $btn = "<div class=\"aloc-confirm\">
                            <input type=\"submit\" class=\"button\" id=\"formButton\" value=\"Agendar reserva\" disabled>
                            <p class='stockError'>Esse livro está fora de estoque!</p>
                        </div>";
                $userStockView = "<p class='stock noStock' id='stock'>Estoque: " . $stock . "</p>";
            }else{
                $btn = "<div class=\"aloc-confirm\">
                            <input type=\"submit\" class=\"formButton\" id=\"formButton\" value=\"Agendar reserva\" onclick=\"enableInput()\">
                        </div>";
                $userStockView = "<p class='stock' id='stock'>Estoque: " . $stock . "</p>";
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
    <title><?=$bookName?></title>
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/reserva.css">
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
                        <a href="<?= $pfpAction ?>">
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
            <div class="left">
                <div class="title">
                    <p><?=$bookName?></p>
                </div>
                <img src="../images/javaCover.png" alt="Capa do Livro">
                <div class="info">
                    <p>Autor: <?=$bookAuthor?></p>
                    <p>Editora: <?=$bookEditor?></p>
                </div>
            </div>
            <div class="right">
                <div class="title">
                    <p>Reserva de livro</p>
                </div>
                <div class="aloc-area">
                    <form method="POST" class="form" action="reservaForm.php">
                        <div class="aloc-data">
                            <?php echo $userStockView ?>
                            <p>Data de retirada</p>
                            <input type="date" class="date" name="dataInit" id="dataInit" required onchange="adicionarSeteDias()">
                            <p>Data de devolução</p>
                            <input type="date" class="date return" name="dataReturn" id="dataReturn" disabled>
                            <p>Local:</p>
                            <p> Biblioteca do Campus II de Limeira</p>
                        </div>
                        <?php echo $btn ?>
                    </form>
                </div>
            </div>
        </div>   
    </div>
</body>

<script>
    function enableInput(){
        document.getElementById('dataReturn').disabled = false;
    }

    function adicionarSeteDias() {
        // Pega o valor do primeiro input (data de retirada)
        let dataRetirada = document.getElementById('dataInit').value;
    
        // Verifica se a data está preenchida
        if (dataRetirada) {
            // Converte a string da data para o formato Date
            let data = new Date(dataRetirada);
        
            // Adiciona 7 dias
            data.setDate(data.getDate() + 7);
        
            // Formata a data de volta para o formato YYYY-MM-DD
            let ano = data.getFullYear();
            let mes = ('0' + (data.getMonth() + 1)).slice(-2);  // Adiciona o zero à esquerda no mês, se necessário
            let dia = ('0' + data.getDate()).slice(-2);  // Adiciona o zero à esquerda no dia, se necessário
        
            // Atribui o valor formatado ao segundo input (data de devolução)
            document.getElementById('dataReturn').value = `${ano}-${mes}-${dia}`;
        }
    }
</script>
    <script src="../scripts/sidebar.js"></script>
</html>