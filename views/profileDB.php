<?php
    include('connectdb.php');

    $id = $_REQUEST['id'];
    $query = "SELECT * FROM Utilizador WHERE UserID='$id'";
    $r = $conn -> query($query);
    $row = $r->fetch_assoc();

    if(isset($_POST['update'])){
        \controllers\usersController::updateAdmin($_POST['name'], $_POST['email'], $_FILES['image']);
    }
?>

<div style="display: flex;">
    <h3 style="margin-bottom:20px;"><span style="font-weight:bold; color: var(--myBlue2); margin-left: 230px; font-size: 35px; font-variant: small-caps;">Atualizar Perfil de </span><span style="font-weight:bold; font-size: 30px; margin-left: 10px;">"<?php echo $row['Email'] ?>"</h3>
</div>
<section class="containerUser w100 h100 itemsFlex alignCenter justCenter">
    <div class="wrap w60">
        <form method="post" enctype="multipart/form-data">
            <div class="box">
                <figure class="imgBiggerUser marginDownSmall textCenter">
                        <label for="image" style="cursor: pointer;" name="image" value="<?php echo $row['Imagem']; ?>">
                            <img src="<?php echo BASE; ?>uploads/<?php echo $row['Imagem']; ?>" />
                        </label>
                        <input type="file" name="image" value="<?php echo $row['Imagem']; ?>" id="image" />
                </figure>
                <div class="infosProfile itemsFlex flexWrap justCenter">
                    <input type="text" name="name" value="<?php echo $row['Username']; ?>" class="w100 marginDownSmall" />
                    <input type="text" name="email" value="<?php echo $row['Email']; ?>" class="w100 marginDownSmall" />
                    <button name="update" type="submit" class="w30">Atualizar</button>
                </div>
            </div>
        </form>
    </div>
</section>