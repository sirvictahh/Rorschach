<?php

    namespace models;

    class usersModel{

        public static function getUsers(){
            $idUser = $_SESSION['id'];
            $users = \MySql::connect()->prepare("SELECT * FROM Utilizador WHERE UserID != '$idUser'");
            $users->execute();
            $users = $users->fetchAll();
            return $users;
        }

        public static function getPileList(){
            $getPileList = \MySql::connect()->prepare("SELECT * FROM Pile WHERE UserID = '$_SESSION[id]'");
            $getPileList->execute();
            $getPileList = $getPileList->fetchAll();
            return $getPileList;
        }

        public static function getActivityList(){
            $getActivityList = \MySql::connect()->prepare("SELECT * FROM Activity WHERE UserID = '$_SESSION[id]'");
            $getActivityList->execute();
            $getActivityList = $getActivityList->fetchAll();
            return $getActivityList;
        }

        public static function getShelfList(){
            $getShelfList = \MySql::connect()->prepare("SELECT * FROM Shelf WHERE UserID = '$_SESSION[id]'");
            $getShelfList->execute();
            $getShelfList = $getShelfList->fetchAll();
            return $getShelfList;
        }
    }
?>