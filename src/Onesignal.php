<?php

class Onesignal{
    public $API_KEY;
    public $APP_ID;
    private $HOST = "https://onesignal.com";

    function __constructor(){
    }

    private function Curl($url, $fields, $method = "POST"){
        if (!empty($this->API_KEY) && !empty($this->APP_ID)) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: Basic '.$this->API_KEY
                
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            if ($method == "POST") {
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            }
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            
            $response = curl_exec($ch);
            curl_close($ch);
            
            return $response;
        }else{
            throw new Exception("You must need to set `API_KEY` and `app_id`");
        }
    }

    public function sendPushToAllSubscribedUsers($data = array()) {
        if (isset($data['title']) && isset($data['body']) && isset($data["url"])) {
        
            $heading = array(
                "en" => $data['title']
             );
            $content      = array(
                "en" => $data['body']
            );
            
            $fields = array(
                'app_id' => $this->APP_ID,
                'included_segments' => array(
                    'Subscribed Users'
                ),
                'app_url' => $data['url'],
                'contents' => $content,
                'headings' => $heading,
                "small_icon" => "ic_stat_onesignal_default",
                "big_picture" => isset($data['big_picture']) ? $data["big_picture"] : "",
                "android_accent_color" => "2464b3",
                "android_led_color" => "2464b3"
                
            );
            if(isset($data["data"])){
                $fields["data"] = $data["data"];
            }
            
            $fields = json_encode($fields);
            
            
            $response = $this->Curl($this->HOST."/api/v1/notifications", $fields);
        }else{
            $response = json_encode(["Error" => "Please Insert `title`, `body` and `url`"]);
        }
            
            return $response;
    }

    public function SendPushToUser($users_id = array(), $data = array()){
        if (isset($data['title']) && isset($data['body']) && isset($data["url"])) {
            $content      = array(
                "en" => $data['body']
            );
            $heading = array(
                "en" => $data['title']
             );
             
    
            $fields = array(
                'app_id' => $this->APP_ID,
                // 'included_segments' => array('All'),
                'include_player_ids' => $users_id,
                'app_url' => $data['url'],
                'contents' => $content,
                'headings' => $heading,
                "small_icon" => "ic_stat_onesignal_default",
                "big_picture" => isset($data['big_picture']) ? $data["big_picture"] : "",
                "android_accent_color" => "2464b3",
                "android_led_color" => "2464b3"
            );
            if(isset($data["data"])){
                $fields["data"] = $data["data"];
            }
            $fields = json_encode($fields);
            
            
            $response = $this->Curl($this->HOST."/api/v1/notifications", $fields);
        }else{
            $response = json_encode(["Error" => "Please Insert `title`, `body` and `url`"]);
        }
        
        return $response;
    }

    public function SendPushToUserByExternalIds($users_id = array(), $data = array()){
        if (isset($data['title']) && isset($data['body']) && isset($data["url"])) {
            $content      = array(
                "en" => $data['body']
            );
            $heading = array(
                "en" => $data['title']
             );
             
    
            $fields = array(
                'app_id' => $this->APP_ID,
                // 'included_segments' => array('All'),
                'include_external_user_ids' => $users_id,
                'app_url' => $data['url'],
                'contents' => $content,
                'headings' => $heading,
                "small_icon" => "ic_stat_onesignal_default",
                "big_picture" => isset($data['big_picture']) ? $data["big_picture"] : "",
                "android_accent_color" => "2464b3",
                "android_led_color" => "2464b3"
            );
            if(isset($data["data"])){
                $fields["data"] = $data["data"];
            }
            $fields = json_encode($fields);
            
            
            $response = $this->Curl($this->HOST."/api/v1/notifications", $fields);
        }else{
            $response = json_encode(["Error" => "Please Insert `title`, `body` and `url`"]);
        }
        
        return $response;
    }

    public function getDevices(){ 
        return $this->Curl($this->HOST."/api/v1/players?app_id=".$this->APP_ID, [], "GET"); 
    }

    public function viewDevice($device_id){ 
        return $this->Curl($this->HOST."/api/v1/players/".$device_id, [], "GET"); 
    }
}
?>
