<?php
    class Router{
        public function get(){
            $url = isset($_GET['url']) ? $_GET['url'] : 'home';
            $slug = explode('/',$url)[0];
            if(!(file_exists('views/'.$slug.'.php'))){
                header('Location: '.BASE.'');
                die();
            }
            if(file_exists('views/'.$slug.'.php')){
                $header = 'views/includes/header.php';
                $filename = 'views/'.$slug.'.php';
                $footer = 'views/includes/footer.php';
                include($header);
                include($filename);
                include($footer);
                die();
            }
        }
    }
?>