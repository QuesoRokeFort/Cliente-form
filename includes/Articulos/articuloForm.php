<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input[type="text"] {
            text-align: center; /* Center the input text */
        }

        ::placeholder {
            text-align: center; /* Center the placeholder text */
        }
    </style>
</head>
<body>
    <?php
        // Include error message from session or a previous script
        session_start();
        $errorMessage = $_SESSION['errorMessage'] ?? '';
        unset($_SESSION['errorMessage']); // Clear the error message after displaying
        ?>

        <!-- Display error message if there is one -->
        <?php if (!empty($errorMessage)): ?>
            <p style="color: red;"><?php echo htmlspecialchars($errorMessage); ?></p>
         <?php endif; ?>

    <?php 
    require_once "../dbh.inc.php";

    
    $query= "SELECT * FROM categoria";
    $stmt = $pdo->prepare($query);
    $stmt->execute(); 
   
    $categoria = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null;
    ?>

    <form action="cargarArticulo.php" method="post">
        <label for="Descripcion"> Descripcion:</label>
            <input id="descripcion" type="text" name="descripcion" placeholder ="Descripcion"><br>
        
        <label for="Precio"> Precio:</label>
            <input id="precio" type="number" name="precio" placeholder ="Precio"><br>
        
        <label for="Marca"> Marca:</label>
            <input id="marca" type="text" name="marca" placeholder ="Marca"><br>
        
        <label for="Modelo"> Modelo:</label>
            <input id="modelo" type="text" name="modelo" placeholder ="Modelo"><br>
        
        <label for="Cod Serie"> Codigo Serie:</label>
            <input id="codSerie" type="text" name="codSerie" placeholder ="Codigo Serie"><br>
        
        <label for="Categoria"> Categoria:</label>
        <select id="documento" name="documento">
            <?php 
                foreach ($categoria as $cat) {
                    $value = htmlspecialchars($cat["id"]);
                    $label = htmlspecialchars($cat["nombre"]);
                    
                    echo "<option value=\"$value\">$label</option>";
                }
            ?>   
        </select><br>
        <label for="Stock"> Stock:</label>
            <input id="stock" type="number" name="stock" placeholder ="Stock"><br>

        <button typo="submit">Submit</button><br>
    </form>

</body>
</html>
