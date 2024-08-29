<?php
$parametro="";
if ($_SERVER["REQUEST_METHOD"]= "POST"){
    require_once "dbh.inc.php";
    if (isset($_POST["nomCliente"])) {$parametro = htmlspecialchars($_POST["nomCliente"]);}
    
    $query= "SELECT * FROM cliente";
    if (!empty($parametro) && $parametro != ""){
        $query .= " WHERE nombre = :nombre";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":nombre",$parametro);
        $stmt->execute();
    }else{
        $stmt = $pdo->prepare($query);
        $stmt->execute(); 
    }
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null;
}   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="selectClient.php" method="post">
        <label for="Cliente"> Cliente:</label>
            <input id="nomCliente" type="text" name="nomCliente" placeholder ="Nombre"><br>
        <button typo="submit">Buscar</button><br>
    </from>
        
    <?php
        if(empty($results)){
            echo "there are no results";
        }else{
            foreach ($results as $result){
                print_r($result);
                echo "<br>";
            }
        }
    ?>
</body>
</html>