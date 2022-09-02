<?php

class Onesignal{
    private $API_KEY;
    private $APP_ID;
    private $host = "https://onesignal.com";

    function __constructor($api_key, $app_id){
        $this->API_KEY = $api_key;
        $this->APP_ID = $app_id;
    }

    private function Curl($url, $fields){
        if (!empty($this->API_KEY) && !empty($this->APP_ID)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: Basic '.$this->API_KEY
                
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            
            $response = curl_exec($ch);
            curl_close($ch);
            
            return $response;
        }else{
            throw new Exception("You must need to set `API_KEY` and `app_id`");
        }
    }
}
?>