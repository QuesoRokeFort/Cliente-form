<?php 

session_start();

// Initialize error message variable
$errorMessage = "";

if($_SERVER["REQUEST_METHOD"]== "POST"){
    $nombre = $_POST['nombre'] ?? '';

    if (empty($nombre)) {
        $errorMessage = "All fields are required. ";
        $_SESSION['errorMessage'] = $errorMessage;
        header("Location: CategoriaForm.php"); // Redirect back to the form page
        exit();
    }
    try {
        require_once "../dbh.inc.php";

       
        $query= "INSERT INTO categoria (nombre)
        VALUES (?);";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$nombre]); 

        $pdo = null;
        $stmt = null;

        /*
        otra opcion es parameter binding 

        $query= "INSERT INTO cliente () VALUES (:nombre,resto de datos);";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":nombre", $nombre)

        $stmt->execute();

        */
        header("Location: articulosMenu.php");
        die();
    } catch (PDOException $e) {
        die("Query failed " . $e->getMessage());
    }
}else{
    header("Location: ../index.php"); //go to main menu if not post method selection
}
