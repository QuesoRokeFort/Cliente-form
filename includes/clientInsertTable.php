<?php 

session_start();

// Initialize error message variable
$errorMessage = "";

if($_SERVER["REQUEST_METHOD"]== "POST"){
    $nombre = $_POST['nombre'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $profesional = $_POST['profesional'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $numDocumento = $_POST['numDoc'] ?? '';
    $email = $_POST['email'] ?? '';


    /*if (empty($nombre)){
        $errorMessage .= "Nombre, ";
    }
    if (empty($direccion)){
        $errorMessage .= "Direccion, ";
    }
    if(empty($profesional)){
        $errorMessage .= "Profesional, ";
    }
    if (empty($email)){
        $errorMessage .= "Email, ";
    }
    if (empty($telefono)){
        $errorMessage .= "Telefono, ";
    }
    if (empty($numDocumento)) {
        $errorMessage .= "Numero documento, ";
    }
    if($errorMessage != ""){
        $errorMessage = "Faltan: " . $errorMessage . "All fields are required.";
        $_SESSION['errorMessage'] = $errorMessage;
        header("Location: ../index.php"); // Redirect back to the form page
        exit();
    }*/
    // queda un modelo que permite enseñar el error espesifico y como se ingresaria el mismo 
    if (empty($nombre) || empty($direccion) || empty($profesional) || empty($telefono) || empty($numDocumento) || empty($email)) {
        $errorMessage = "All fields are required. " . $nombre . $direccion . $profesional . $telefono . $email . $numDocumento;
        $_SESSION['errorMessage'] = $errorMessage;
        header("Location: clientForm.php"); // Redirect back to the form page
        exit();
    }
    try {
        require_once "dbh.inc.php";

       
        $query= "INSERT INTO cliente (nombre, email, telefono, direccion, profesional, documento)
        VALUES (?,?,?,?,?,?);";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$nombre,$email,$telefono,$direccion,$profesional,$numDocumento]); 

        $pdo = null;
        $stmt = null;

        /*
        otra opcion es parameter binding 

        $query= "INSERT INTO cliente () VALUES (:nombre,resto de datos);";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":nombre", $nombre)

        $stmt->execute();

        */
        header("Location: ../index.php");
        die();
    } catch (PDOException $e) {
        die("Query failed " . $e->getMessage());
    }
}else{
    header("Location: ../index.php");
}
