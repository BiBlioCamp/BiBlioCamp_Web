<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"] === "GET"){
        if(!isset($_SESSION["username"])){
            header("location: login.php");
        }
    }else if($_SERVER["REQUEST_METHOD"] === "POST"){
        $btn = $_POST["button"];
        if($btn == "Confirmar"){
            try{
                include("conexaoDB.php");
                $ra = $_SESSION["ra"];
                $stmt = $pdo->prepare("update from BBC_Account set active = 0 where id = :ra");
                $stmt->bindParam(":ra",$ra);
                $stmt->execute();
                $rows = $stmt->rowCount();
                if($rows>0){
                    header("location: logout.php");
                }
            }catch(PDOException $e){
                echo "Erro: " . $e->getMessage();
            }
            $pdo = null;
        }else if($btn == "Cancelar"){
            header("location: profile.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/reset.css">
    <link rel="stylesheet" href="../styles/exclude.css">
    <link href="https://fonts.googleapis.com/css2?family=Red+Hat+Display:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <title>Excluir</title>
</head>
<body>
    <div class="popup">
        <p>Tem certeza que deseja excluir a conta?</p>
        <form method="post" >
            <input type="submit" value="Confirmar" class="formButton" name="button">
            <input type="submit" value="Cancelar" class="formButton" name="button">
        </form>
    </div>
</body>
</html>