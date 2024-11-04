<?php
    session_start();
    if($_SERVER["REQUEST_METHOD"] === "GET"){
        header("Location: error.html");
    }else if($_SERVER["REQUEST_METHOD"] === 'POST'){
    $dataInit = $_POST["dataInit"];
    $dataReturn = $_POST["dataReturn"];
    try{
        include "conexaoDB.php";
        $stmt = $pdo->prepare("insert into BBC_Aloc (userId, bookId, alocDate, returnDate, status) values (:userId, :bookId, :alocDate, :returnDate, 'retirar')");
        $stmt->bindParam(":userId", $_SESSION["ra"]);
        $stmt->bindParam(":bookId", $_SESSION["bookId"]);
        $stmt->bindParam(":alocDate", $dataInit);
        $stmt->bindParam(":returnDate", $dataReturn);
        $stmt->execute();
        $rows = $stmt->rowCount();
        if($rows > 0){
            $stmt = $pdo->prepare("update BBC_Book set actualStock = actualStock - 1 where id = :bookId");
            $stmt->bindParam(':bookId',$_SESSION['bookId']);
            $stmt->execute();
            $rows = $stmt->rowCount();
            if($rows > 0){
                header("Location: alocacao.php");
            }else{
                echo "deu ruim";
            }
        }
        else{
            echo "deu bom não";
        }
    }catch(PDOException $e){
        echo "Erro: " . $e->getMessage();
    }
}