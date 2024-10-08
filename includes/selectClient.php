<?php
$parametro="";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
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
    <style>
        /* CSS for the Excel-like table */
        .excel-table {
            width: 100%;
            border-collapse: collapse; /* Merge borders */
            text-align: left; /* Align text to the left */
            margin-top: 20px; /* Space from the top */
        }

        /* Style for table headers */
        .excel-table th {
            background-color: #f2f2f2; /* Light grey background for headers */
            border: 1px solid #ddd; /* Border for headers */
            padding: 8px; /* Padding inside header cells */
        }

        /* Style for table cells */
        .excel-table td {
            border: 1px solid #ddd; /* Border for cells */
            padding: 8px; /* Padding inside cells */
        }

        /* Alternate row color */
        .excel-table tr:nth-child(even) {
            background-color: #f9f9f9; /* Light grey for even rows */
        }

        /* Highlight on hover */
        .excel-table tr:hover {
            background-color: #ddd; /* Darker grey for hovered rows */
        }
    </style>
</head>
<body>
    <form action="selectClient.php" method="post">
        <label for="Cliente"> Cliente:</label>
            <input id="nomCliente" type="text" name="nomCliente" placeholder ="Nombre">
        <button type="submit">Buscar</button><br>
    </form>
        
    <?php
        if(empty($results)){
            echo "there are no results";
        }else {
            echo '<table class="excel-table">'; // Start table with class
            echo '<tr>'; // Start table header row
            $columns = array_keys($results[0]);
            foreach ($columns as $column) {
                echo '<th>' . htmlspecialchars($column) . '</th>'; // Table headers
            }
            echo '<th>' . "Seleccionar";
            echo '</tr>'; // End table header row
    
            // Iterate through results and create rows
            foreach ($results as $result) {
                echo '<tr>'; // Start a new row
                foreach ($result as $value) {
                    echo '<td>' . htmlspecialchars($value) . '</td>'; // Table cells
                }
                echo '<td>';
                    echo '<form action="clientSelected.php" method="POST">';
                    echo '<input type="hidden" name="id" value="' . htmlspecialchars($result['id']) . '">'; 
                    echo '<input type="hidden" name="nombre" value="' . htmlspecialchars($result['nombre']) . '">';
                    echo '<button type="submit">Seleccionar</button>';
                    echo '</form>';
                echo '</td>';
                echo '</tr>'; // End row
            }
            echo '</table>'; // End table
        }
    ?>
</body>
</html>