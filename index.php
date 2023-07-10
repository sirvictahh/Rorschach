<?php
    include('config.php');

    $Router = new Router;
    $Router->get();

    $accessController = new \controllers\accessController();
?>