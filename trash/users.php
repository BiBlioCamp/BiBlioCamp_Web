<?php
    session_start();
    $text = array();
    if($_SERVER['REQUEST_METHOD'] === 'GET') {
        if(!isset($_SESSION['username'])) {
            $username = "User";
            $pfp = "unsetPfp.png";
            $pfpAction = "login.php";
        }
        else {
            $username = $_SESSION["username"];
            $pfp = "unknownPfp.png";
            $pfpAction = 'profile.php';
        }
    }else if($_SERVER["REQUEST_METHOD"] === "POST"){
        try{
            include("conexaoDB.php");
            if(!isset($_SESSION['username'])) {
                $username = "User";
                $pfp = "unsetPfp.png";
                $pfpAction = "login.php";
            }
            else {
                $username = $_SESSION["username"];
                $pfp = "unknownPfp.png";
                $pfpAction = 'profile.php';
            }

            if(trim($_POST["ra"]) != ""){
                $ra = $_POST["ra"];
                $stmt = $pdo->prepare("select * from BBC_User where ra = :ra");
                $stmt->bindParam(":ra",$ra);
                $stmt->execute();
                while($rows = $stmt->fetch()){
                    array_push($text,
                    "<tr>
                    <td>" . $rows["username"] . "</td>
                    <td>" . $rows["email"] ."</td>
                    <td>". $rows["ra"] . "</td>
                    </tr>");
                }
            }else{
                $stmt = $pdo->prepare("select * from BBC_User order by username");
                $stmt->execute();
                while($rows = $stmt->fetch()){
                    array_push($text,
                    "<tr>
                    <td>" . $rows["username"] . "</td>
                    <td>" . $rows["email"] ."</td>
                    <td>". $rows["ra"] . "</td>
                    </tr>");
                }
            }
        }catch(PDOException $e){
            "Error: " . $e->getMessage();
        }
        $pdo = null;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="../styles/sidebar.css">
    <link rel="stylesheet" href="../styles/users.css">
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
<body onload="makeTableScroll()">
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
                <a href="home.php" class="about">
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
                    <a href="#">
                        <i class='bx bxs-user-pin' ></i>
                        <span class="link_name">Usuários</span>
                    </a>                  
                    <ul class="sub-menu blank">
                        <li><a class="link_name" href="#">Usuários</a></li>
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
                            <a href="<?=$pfpAction?>">
                                <img src="../images/<?=$pfp?>" alt="profileImg">
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
        <div class="search-area">
            <div class="search">
                <div>
                    <p>Procurar por RA</p>
                </div>
                <form method="POST">
                    <div class="inputs">
                        <input  type="text" id="ra" class="input" name="ra">
                        <input type="submit" class="button" id="buttonCadaster" name="enviar">
                    </div>
                </form>
            </div>
        </div>                 
    </div>
</body>
    <script src="../scripts/sidebar.js"></script>
    <script type="text/javascript">
        function makeTableScroll() {
            var maxRows = 10;

            var table = document.getElementById('table');
            var wrapper = table.parentNode;
            var rowsInTable = table.rows.length;
            var height = 0;
            if (rowsInTable > maxRows) {
                for (var i = 0; i < maxRows; i++) {
                    height += table.rows[i].clientHeight;
                }
                wrapper.style.height = height + "px";
            }
        }
    </script>
</html>

<?php 
    echo "<div class='result-area'>";
    echo    "<div class='table'>";
    echo        "<table id='table'>";
    echo            "<thead>";
    echo                "<tr>";
    echo                    "<th scope='col'>Username</th>";
    echo                    "<th scope='col'>Email</th>";
    echo                    "<th scope='col'>RA</th>";
    echo                "</tr>" ;
    echo            "</thead>";
    echo            "<tbody>";
    foreach($text as $val){
        echo $val;
    };
    echo            "</tbody>";
    echo        "</table>";
    echo    "</div>";
    echo "</div>";