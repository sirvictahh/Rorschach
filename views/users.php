<?php
    $tipo = $_SESSION['type'];
    include('connectdb.php');
    $sql = "SELECT * FROM Utilizador WHERE Tipo != '$tipo'"; 
    $result = $conn->query($sql);
    $list = '';
    $total = $result->num_rows;
    if($result->num_rows > 0) {
        // Output que só mostra os utilizadores normais (que não são administradores)
        while($row = $result->fetch_assoc()) {
            if ($row['Tipo'] != $_SESSION['type']){
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
        $list = '<h3 style="margin-bottom:20px;"><span style="font-weight:bold; margin-left: 60px; font-size: 35px; font-variant: small-caps;">Não Existem Utilizadores! </span></h3>';
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
        <h3 style="margin-bottom:20px;"><span style="font-weight: bold; color: var(--myBlue2); margin-left: 60px; font-size: 35px; font-variant: small-caps;">Lista de Utilizadores </span><span style="font-weight:bold; font-size: 35px;">(<?php echo $total ?>)</h3>
        <section class="usersContainer">
            <div class="wrap w90 center itemsFlex flexWrap">
            <?php
                echo $list;
                $conn->close();
            ?>
        </div>
    </body>
</html>