<?php
    $tipo = $_SESSION['type'];
    $id = $_SESSION['id'];
    include('connectdb.php');
    $sql = "SELECT * FROM Utilizador WHERE UserID != '1' AND Tipo = '$tipo'"; 
    $result = $conn->query($sql);
    $list = '';
    $total = $result->num_rows;
    if($result->num_rows > 0) {
        // Output que só mostra os administradores
        while($row = $result->fetch_assoc()) {
            if ($row['Tipo'] == $_SESSION['type']){
                $list = $list.'
                <div class="box w30 marginRightDefault marginDownSmall">
                    <figure class="imgBiggerUser marginDownSmall textCenter">
                        <img src="'.BASE.'uploads/'.$row['Imagem'].'" />
                    </figure>
                    <div class="col textCenter">
                        <h4>'.$row["Username"].'</h4>
                        <p>'.$row["Email"].'</p>
                    </div>
                    <br>
                    <a href="profileDB?id='.$row["UserID"].'" class="btn">Atualizar</a>
                    <a href="deleteuser?id='.$row["UserID"].'" class="btn btn-danger">Eliminar</a>
                </div>         
                ';
            }
        }
        
    } else {
        $list = '<h3 style="margin-bottom:20px;"><span style="font-weight:bold; margin-left: 60px; font-size: 35px; font-variant: small-caps;">Não Existem Administradores! </span></h3>';
    }
?>

<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    </head>
    <body>
        <div style="display: flex;">
            <h3 style="margin-bottom:20px;"><span style="font-weight: bold; color: var(--myBlue2); margin-left: 60px; font-size: 35px; font-variant: small-caps;">Lista de Administradores </span><span style="font-weight:bold; font-size: 35px;">(<?php echo $total ?>)</h3>
            <a href="adminCreate"><button style="height: 50px; width: 200px; font-size: 16px;" class="btn"> Adicionar Nova Conta</button></a>
        </div>
        <section class="usersContainer">
            <div class="wrap w90 center itemsFlex flexWrap">
            <?php
                echo $list;
                $conn->close();
            ?>
        </div>
    </body>
</html>