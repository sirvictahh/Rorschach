<?php

    namespace controllers;

    class usersController{

        // Logout do utilizador ao "eliminar" as sessões criadas do SignIn do accessController
        public static function logout(){
            if(isset($_GET['logout'])){
                unset($_SESSION['id']);
                unset($_SESSION['login']);
                unset($_SESSION['name']);
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                unset($_SESSION['image']);
                unset($_SESSION['type']);
                setcookie('remember', true, time()-(60*60*7), '/');
                setcookie('name', $name, time()-(60*60*7), '/');
                setcookie('password', $password, time()-(60*60*7), '/');
                header('Location: '.BASE.'');
                die();
            }
        }

        public static function createUser ($name, $email, $password, $image) {
            if($name == '' || $email == '' || $password == '' || $image == ''){
                echo "<script> alert('Preencha os campos necessários!'); </script>";
                return;
            }else{
                $register = \MySql::connect()->prepare("INSERT INTO Utilizador VALUES (null,?,?,?,?,?)");
                $register->execute(array($name, $email, $password, $image['name'], 'admin'));
                move_uploaded_file($image['tmp_name'], BASE_UPLOADS.$image['name']);
                if($register->rowCount() == 1){
                    echo "<script> window.location.href='".BASE."admins'; </script>";
                }else{
                    echo "<script> alert('Erro ao registrar'); </script>";
                }
            }
        }

        // função para atualizar as informações do utilizador correspondente
        public static function updateUser($name, $email, $password, $image){
            $idUser = $_SESSION['id'];
            $type = $_SESSION['type'];

            // se a imagem de perfil não estiver vazia (preenchida) as informações do utilizador serão atualizadas correspondentemente ao form que a publicou, e a imagem será a que escolheu
            if(!empty($image['name'])) {
                $update = \MySql::connect()->prepare("UPDATE Utilizador SET Username = ?, Email = ?, Palavra_passe = ?, Imagem = ? ,  Tipo = ? WHERE UserID = '$idUser'");
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['image'] = $image['name'];
                $update->execute(array($name, $email, $password, $image['name'], $type));
                move_uploaded_file($image['tmp_name'], BASE_UPLOADS.$image['name']);
            // se a imagem de perfil estiver vazia (não foi preenchida) as informações do utilizador serão atualizadas correspondentemente ao form que a publicou, e a imagem será a mesma que quando registou
            } else {
                $imagem = $_SESSION['image'];
                $update = \MySql::connect()->prepare("UPDATE Utilizador SET Username = ?, Email = ?, Palavra_passe = ?, Imagem = ? ,  Tipo = ? WHERE UserID = '$idUser'");
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['image'] = $imagem;
                $update->execute(array($name, $email, $password, $imagem, $type));
            }
            if($update->rowCount() == 1){
                echo "<script> window.location.href='".BASE."profileUser'; </script>";
            }
        }
        
        // função para atualizar as informações do utilizador através do admin (não pode atualizar a password)
        public static function updateAdmin($name, $email, $image){
            $idUser = $_REQUEST['id'];

            include('C:\xampp\htdocs\Rorschach\views\connectdb.php');
            $id = $_REQUEST['id'];
            $query = "SELECT * FROM Utilizador WHERE UserID='$id'"; 
            $r = $conn -> query($query);
            $row = $r->fetch_assoc();

            $password = $row['Palavra_passe'];
            $type1 = 'user';
            $type2 = 'admin';
            if ($row['Tipo'] == 'user') {
                if(!empty($image['name'])) {
                    $update = \MySql::connect()->prepare("UPDATE Utilizador SET Username = ?, Email = ?, Palavra_passe = ?, Imagem = ? ,  Tipo = ? WHERE UserID = '$idUser'");
                    $update->execute(array($name, $email, $password, $image['name'], $type1));
                    move_uploaded_file($image['tmp_name'], BASE_UPLOADS.$image['name']);
                } else {
                    $imagem = $row['Imagem'];
                    $update = \MySql::connect()->prepare("UPDATE Utilizador SET Username = ?, Email = ?, Palavra_passe = ?, Imagem = ? ,  Tipo = ? WHERE UserID = '$idUser'");
                    $update->execute(array($name, $email, $password, $imagem, $type1));
                }
                if($update->rowCount() == 1){
                    echo "<script> window.location.href='".BASE."users'; </script>";
                } else {
                    echo "<script> window.location.href='".BASE."users'; </script>";
                }
            } else {
                if(!empty($image['name'])) {
                    $update = \MySql::connect()->prepare("UPDATE Utilizador SET Username = ?, Email = ?, Palavra_passe = ?, Imagem = ? ,  Tipo = ? WHERE UserID = '$idUser'");
                    $update->execute(array($name, $email, $password, $image['name'], $type2));
                    move_uploaded_file($image['tmp_name'], BASE_UPLOADS.$image['name']);
                } else {
                    $imagem = $row['Imagem'];
                    $update = \MySql::connect()->prepare("UPDATE Utilizador SET Username = ?, Email = ?, Palavra_passe = ?, Imagem = ? ,  Tipo = ? WHERE UserID = '$idUser'");
                    $update->execute(array($name, $email, $password, $imagem, $type2));
                }
                if($update->rowCount() == 1){
                    echo "<script> window.location.href='".BASE."admins'; </script>";
                } else {
                    echo "<script> window.location.href='".BASE."admins'; </script>";
                }
            }
        }

        public static function Pile($userId, $movieId, $name, $image){
            $insert = \MySql::connect()->prepare("INSERT INTO Pile VALUES (null,?,?,?,?)");
            $insert->execute(array($userId, $movieId, $name, $image));
            if($insert->rowCount() == 1){
                echo "<script> window.location.href='".BASE."Pile'; </script>";
            }else{
                echo "<script> alert('Ops... Ocorreu um erro!'); </script>";
            }
        }

        public static function Activity($userId, $movieId, $name, $image){
            $insert = \MySql::connect()->prepare("INSERT INTO Activity VALUES (null,?,?,?,?)");
            $insert->execute(array($userId, $movieId, $name, $image));
            if($insert->rowCount() == 1){
                echo "<script> window.location.href='".BASE."Activity'; </script>";
            }else{
                echo "<script> alert('Ops... Ocorreu um erro!'); </script>";
            }
        }

        public static function Shelf($userId, $movieId, $name, $image){
            $insert = \MySql::connect()->prepare("INSERT INTO Shelf VALUES (null,?,?,?,?)");
            $insert->execute(array($userId, $movieId, $name, $image));
            if($insert->rowCount() == 1){
                echo "<script> window.location.href='".BASE."Shelf'; </script>";
            }else{
                echo "<script> alert('Ops... Ocorreu um erro!'); </script>";
            }
        }

        public static function deletePileList($movie){
            $deletePileList = \MySql::connect()->prepare("DELETE FROM Pile WHERE MovieID = '$movie'");
            $deletePileList->execute();
            if($deletePileList->rowCount() >= 1) {
                echo "<script> alert('Item eliminado com sucesso!'); </script>";
            } else if($deletePileList->rowCount() <= 0){
                echo "<script> alert('Item eliminado com sucesso!'); window.location.href='".BASE."Movies'; </script>";
            }
        }

        public static function deleteActivityList($movie){
            $deleteActivityList = \MySql::connect()->prepare("DELETE FROM Activity WHERE MovieID = '$movie'");
            $deleteActivityList->execute();
            if($deleteActivityList->rowCount() >= 1) {
                echo "<script> alert('Item eliminado com sucesso!'); </script>";
            } else if($deleteActivityList->rowCount() <= 0){
                echo "<script> alert('Item eliminado com sucesso!'); window.location.href='".BASE."Movies'; </script>";
            }
        }

        public static function deleteShelfList($movie){
            $deleteShelfList = \MySql::connect()->prepare("DELETE FROM Shelf WHERE MovieID = '$movie'");
            $deleteShelfList->execute();
            if($deleteShelfList->rowCount() >= 1) {
                echo "<script> alert('Item eliminado com sucesso!'); </script>";
            } else if($deleteShelfList->rowCount() <= 0){
                echo "<script> alert('Item eliminado com sucesso!'); window.location.href='".BASE."Movies'; </script>";
            }
        }

    }

?>