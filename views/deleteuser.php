<?php
    $id = $_REQUEST['id'];
    include('connectdb.php');

    $query = "SELECT * FROM Utilizador WHERE UserID='$id'";
    $del = "DELETE FROM Utilizador WHERE UserID = '$id'";
    $result = $conn -> query($query);
    $row = $result->fetch_assoc();

    if ($row['Tipo'] === 'user') {
        $result = $conn -> query($del);
        echo "<script> window.location.href='".BASE."users'; </script>";
    } 
    if ($row['Tipo'] === 'admin') {
        $result = $conn -> query($del);
        echo "<script> window.location.href='".BASE."admins'; </script>";
    }
    $conn->close();
?>