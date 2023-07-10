<?php
    if(isset($_POST['update'])){
        \controllers\usersController::updateUser($_POST['name'], $_POST['email'], $_POST['password'], $_FILES['image']);
    }
?>

<h3 style="margin-bottom:20px;"><span style="font-weight:bold; color: var(--myBlue2); margin-left: 230px; font-size: 35px; font-variant: small-caps;">Atualize O Seu Perfil</span></h3>
<section class="containerUser w100 h100 itemsFlex alignCenter justCenter">
    <div class="wrap w60">
        <form method="post" enctype="multipart/form-data">
            <div class="box">
                <figure class="imgBiggerUser marginDownSmall textCenter">
                    <label for="image" style="cursor: pointer;" name="image" value="<?php echo $_SESSION['image']; ?>">
                        <img src="<?php echo BASE; ?>uploads/<?php echo $_SESSION['image']; ?>" />
                    </label>
                    <input type="file" name="image" value="<?php echo $_SESSION['image']; ?>" id="image" />
                </figure>
                <div class="infosProfile itemsFlex flexWrap justCenter">
                    <input type="text" name="name" value="<?php echo $_SESSION['name']; ?>" class="w100 marginDownSmall" />
                    <input type="text" name="email" value="<?php echo $_SESSION['email']; ?>" class="w100 marginDownSmall" />
                    <input type="text" name="password" value="<?php echo $_SESSION['password']; ?>" class="w100 marginDownSmall" />
                    <button name="update" class="w30">Atualizar</button>
                </div>
            </div>
        </form>
    </div>
</section>