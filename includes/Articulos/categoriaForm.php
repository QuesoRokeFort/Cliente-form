<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    
    <form action="cargarCategoria.php" method="post">
            <label for="Nombre"> Nombre:</label>
                <input id="nombre" type="text" name="nombre" placeholder ="Nombre">
            <button type:submit> Cargar </button>  
    </form>
    <form action="articulosMenu.php" method="POST">
        <button type="submit">GO BACK</button>
    </form>
</body>
</html>


