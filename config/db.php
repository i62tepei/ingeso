<?php
    $host = "localhost";
    $dbname = "ingeso_db";
    $username = "root";
    $password = "";
    $port = 3308; //En mi caso en local este es el puerto

    try {
        $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
?>