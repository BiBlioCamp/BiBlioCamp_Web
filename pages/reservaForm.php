<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"] === "GET"){
        header("Location: error.html");
    }else if($_SERVER["REQUEST_METHOD"] === 'POST'){
    $dataInit = $_POST["dataInit"];
    $dataReturn = $_POST["dataReturn"];
    try{
        include "conexaoDB.php";
        $stmt = $pdo->prepare("insert into BBC_Aloc (userId, bookId, alocDate, returnDate) values (:userId, :bookId, :alocDate, :returnDate)");
        $stmt->bindParam(":userId", $_SESSION["ra"]);
        $stmt->bindParam(":bookId", $_SESSION["bookId"]);
        $stmt->bindParam(":alocDate", $dataInit);
        $stmt->bindParam(":returnDate", $dataReturn);
        $stmt->execute();
        $rows = $stmt->rowCount();
        if($rows > 0){
            header("Location: profile.php");
        }
        else{
            echo "deu bom não";
        }
    }catch(PDOException $e){
        echo "Erro: " . $e->getMessage();
    }
}