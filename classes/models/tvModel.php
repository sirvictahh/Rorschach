<?php

    namespace models;
    
    class tvModel{

        private $headers = [
            'Authorization: Bearer **************',
            'Content-Type: application/json;charset=utf-8'
        ];
        private $key;
        private $url;
        private $endpoint;
        private $account;

        public function __construct(){
            $this->key = '5355164779446d99dd135b39d34cb287';
            $this->url = 'https://api.themoviedb.org/3';
            $this->account = $_SESSION['id'];
        }

        public function getTVTopsRateds(){
            $this->endpoint = '/tv/top_rated';
            $ch = curl_init($this->url . $this->endpoint . '?api_key='. $this->key . '&language=pt-PT');

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

            $response = json_decode(curl_exec($ch));
                
            curl_close($ch);
            
            return $response;
            
        }

        public function getTVLatest(){
            $this->endpoint = '/tv/on_the_air';
            $ch = curl_init($this->url . $this->endpoint . '?api_key='. $this->key . '&language=pt-PT');

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

            $response = json_decode(curl_exec($ch));
                
            curl_close($ch);
            
            return $response;
        }

        public function getTVFilter($infos){
            $infos = isset($_GET['infos']) ? $_GET['infos'] : 'popular';
            $this->endpoint =  '/tv'.'/'.$infos;
            $ch = curl_init($this->url . $this->endpoint . '?api_key='. $this->key . '&language=pt-PT');

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

            $response = json_decode(curl_exec($ch));
                
            curl_close($ch);
            
            return $response;
        }

        public function getShow($show){
            $this->endpoint =  '/'.$show;
            $ch = curl_init($this->url . $this->endpoint . '?api_key='. $this->key . '&language=pt-PT');

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

            $response = json_decode(curl_exec($ch));
                
            curl_close($ch);
            
            return $response;
        }

        public function getShowVideo($show){
            $this->endpoint =  '/'.$show.'/videos';
            $ch = curl_init($this->url . $this->endpoint . '?api_key='. $this->key);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

            $response = json_decode(curl_exec($ch));
                
            curl_close($ch);
            
            return $response;

        }

        public function searchShow($name){
            $this->endpoint =  '/search/tv';
            $ch = curl_init($this->url . $this->endpoint . '?api_key='. $this->key . '&query='.$name);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

            $response = json_decode(curl_exec($ch));
                
            curl_close($ch);
            
            return $response;
        }

        public function getShowLatestIn(){
            $this->endpoint = '/tv/latest-tv';
            $ch = curl_init($this->url . $this->endpoint . '?api_key='. $this->key . '&language=pt-PT');

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

            $response = json_decode(curl_exec($ch));
                
            curl_close($ch);
            
            return $response;
            
        }
    }
?>