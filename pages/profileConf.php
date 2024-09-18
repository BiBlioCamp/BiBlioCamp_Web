<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"] === "GET"){
        if(!isset($_SESSION["username"])){
            header("location: error.html");
        }
    }else if($_SERVER["REQUEST_METHOD"] === "POST"){
        try{
            include("conexaoDB.php");
            $username = $_POST["username"];
            $senha = $_POST["senha"];
            $stmt = $pdo->prepare("update BBC_User set username = :username, senha = :senha where ra = :ra ");
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":senha", $senha);
            $stmt->bindParam(":ra", $_SESSION["ra"]);
            $stmt->execute();
            $rows = $stmt->rowCount();
            if($rows>0){
                $_SESSION["username"] = $username;
                $_SESSION["senha"] = $senha;
                header("location: profile.php");
            }
        }catch(PDOException $e){
            echo "Erro: " . $e->getMessage();
        }
        $pdo = null;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalizar Perfil</title>
    <link rel="stylesheet" href="../styles/profileConf.css">
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
    <main>
        <div class="main-container">
            <div class="presentation-text">
                <p>Edite seu perfil</p>
            </div>
            <form method="POST" action="">
                    <div class="content-right">
                        <div class="formInputs">
                            <div class="inputGroup">
                                <div>
                                    <p>Altere seu nome de usuario</p>
                                    <input required type="text" id="username" class="input" name="username">
                                </div>
                                <div>
                                    <p>Altere sua senha</p>
                                    <input required type="password" id="senha" class="input" name="senha">
                                </div>
                                <input type="submit" class="formButton" id="buttonCadaster" name="enviar"></input>
                            </div>
                        </div>                    
                    </div>
            </form>
        </div>
    </main>
</body>
    <script src="../scripts/pfpChange.js"></script>
</html>