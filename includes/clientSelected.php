<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = htmlspecialchars($_POST["id"]);
    $nombre = htmlspecialchars($_POST["nombre"]);
    echo $id . " " . $nombre;
}