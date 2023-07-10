<?php
    \controllers\accessController::controlAccess();

    if(isset($_POST['login'])){
        \controllers\accessController::signIn($_POST['name'],$_POST['password']);
    }
?>

<section class="accessContainer itemsFlex alignCenter justCenter">
    <div class="wrap w40 w90DeviceSmall">
        <div class="boxForm">
            <form method="post" class="itemsFlex alignCenter justCenter flexWrap marginDownSmall">
                <input type="text" name="name" class="w100 marginDownSmall" placeholder="Nome de utilizador" autocomplete="off" />
                <input type="password" name="password" class="w100 marginDownSmall" placeholder="Palavra-passe" autocomplete="off" />
                <button type="submit" name="login"  class="w30 buttonBgRad">Log In</button>
            </form>
        </div>
    </div>
</section>