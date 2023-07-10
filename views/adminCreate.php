<?php
    if(isset($_POST['register'])){
        \controllers\usersController::createUser($_POST['name'], $_POST['email'], $_POST['password'], $_FILES['image']);
    }
?>

<h3 style="margin-bottom:20px;"><span style="font-weight:bold; color: var(--myBlue2); margin-left: 172px; font-size: 35px; font-variant: small-caps;">Criar Administrador</span></h3>
<section class="containerUser w100 h100 itemsFlex alignCenter justCenter">
    <div class="wrap w70">
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="name" class="w100 marginDownSmall" placeholder="Nome de Utilizador" autocomplete="off" required/>
            <input type="text" name="email" class="w100 marginDownSmall" placeholder="Email" autocomplete="off" required/>
            <input type="password" name="password" class="w100 marginDownSmall" placeholder="Palavra-passe" autocomplete="off" required/>
            <input type="file" name="image" class="w100 marginDownSmall" placeholder="Escolher Imagem" autocomplete="off" required/>
            <button type="submit" name="register"  class="w30 buttonBgRad">Criar</button>
        </form>
    </div>
</section>