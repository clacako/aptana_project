<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication_model extends CI_Model {
    private $_model   = [];

    // Member login
    public function member_login($post_data) {
        // set expiry date
        $today          = date("Y-m-d");
        $today          = strtotime($today);
        $expiry_date    = strtotime("+7 day", $today);

        $parameters                     = [];
        $parameters["credential_hash"]  = md5($post_data["username"] . $post_data["password"]);  
        $parameters["validity_seconds"] = 24*60*60;
        $parameters["expiry_date"]      = date("Y-m-d", $expiry_date);
        
        $result = $this->lovvitengine->curl_post("login/application_access_init", $parameters);
        return $result;
    }

    // Member logout
    public function member_logout() {
        $this->lovvitengine->curl_post("login/application_access_destroy", $parameters = []);
    }

    // Member get list
    public function member_list($parameters = []) {
        return  $this->lovvitengine->curl_get("member/get_list", $parameters);
    }

    // Member details
    public function member_details($data = []) {
        $parameters = [];
        foreach ($data as $key => $value) {
            $parameters[$key]    = $value;
        }
        
        $member_details = $this->lovvitengine->curl_get("member/get_list", $parameters);
        return $result  = !empty($member_details) ? $member_details["message"][0] : [];
    }



    
    public function credential_set_post($endpoint, $parameters=[]) {
        $this->_model   = $this->lovvitengine->curl_post($endpoint, $parameters);

        return $this;
    }

    public function credential_set_get($endpoint, $parameters=[]) {
        $this->_model   = $this->lovvitengine->curl_get($endpoint, $parameters);
        
        return $this;
    }

    


}