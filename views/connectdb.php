<?php
    $host="localhost";
    $user="root";
    $password="";
    $db="Rorschach";

    $conn = mysqli_connect($host, $user, $password);
    mysqli_select_db($conn, $db);

    if ($conn->connect_error) {
        die("Erro ao conectar à base de dados".$conn->connect_error);
    }
?>