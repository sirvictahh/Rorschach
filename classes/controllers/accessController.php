<?php

    namespace controllers;

    class accessController{

        public static function controlAccess(){
            if(isset($_SESSION['login'])){
                if($_GET['url'] === 'login'){
                    header('Location: '.BASE.'');
                }
            }
        }

        // LogIn do utilizador e guardar sessões, assim como adicionar cookies de tempo
        public static function signIn($name, $password){
            if($name == '' || $password == ''){
                echo "<script> alert('Preencha todos os campos!'); </script>";
                return;
            }
            $login = \MySql::connect()->prepare("SELECT * FROM Utilizador WHERE Username = ? AND Palavra_passe = ? AND Tipo = 'admin'");
            $login->execute(array($name,$password));
            if($login->rowCount() == 1) {
                $info = $login->fetch();
                $_SESSION['id'] = $info['UserID'];
                $_SESSION['login'] = true;
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $info['Email'];
                $_SESSION['password'] = $password;
                $_SESSION['image'] = $info['Imagem'];
                $_SESSION['type'] = $info['Tipo'];
                if(isset($_POST['remember'])){
                    setcookie('remember', true, time()+(60*60*7), '/');
                    setcookie('name', $name, time()+(60*60*7), '/');
                    setcookie('password', $password, time()+(60*60*7), '/');
                }
                header('Location: '.BASE.'');
            }else{
                echo "<script> alert('Dados inválidos!'); </script>";
                return;
            }
        }
    }

?>