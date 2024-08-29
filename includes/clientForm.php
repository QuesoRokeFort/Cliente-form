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


    <form action="clientInsertTable.php" method="post">
        <label for="Nombre"> Nombre:</label>
            <input id="nombre" type="text" name="nombre" placeholder ="Nombre"><br>
        
        <label for="direccion"> Direccion:</label>
            <input id="direccion" type="text" name="direccion" placeholder ="Direccion"><br>
        
        <label for="Profesional a cargo"> Profesional a cargo:</label>
            <input id="profesional" type="text" name="profesional" placeholder ="Profesional"><br>
        
        <label for="Email"> email:</label>
            <input id="email" type="text" name="email" placeholder ="...@gmail.com"><br>
        
        <label for="Telefono"> Telefono:</label>
            <input id="telefono" type="text" name="telefono" placeholder ="0342-000-0000"><br>
        
        <label for="Documento"> Documento:</label>
        <select id="documento" name="documento">
                    <option value="dni"> DNI</option>
                    <option value="CUIT"> CUIT</option>   
                            <input id="nomDoc" type="text" name="numDoc" placeholder ="Numero documento">
        </select><br>

        <button typo="submit">Submit</button><br>
    </form>

</body>
</html>
