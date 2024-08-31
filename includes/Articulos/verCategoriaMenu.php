<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $results = getallCat();
}   
function getallCat(){
    require_once "../dbh.inc.php";

    
    $query= "SELECT * FROM categoria";
    $stmt = $pdo->prepare($query);
    $stmt->execute(); 
    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null;
    return $results;
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
            echo '</tr>'; // End table header row
    
            // Iterate through results and create rows
            foreach ($results as $result) {
                echo '<tr>'; // Start a new row
                foreach ($result as $value) {
                    echo '<td>' . htmlspecialchars($value) . '</td>'; // Table cells
                }
                echo '</tr>'; // End row
            }
            echo '</table>'; // End table
            echo '<form action="articulosMenu.php" method="POST">';
            echo '<button type="submit">GO BACK</button>';
            echo '</form>';
        }
    ?>
</body>
</html>