<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Credential_model extends CI_Model {
    private $_model = [];
    private $_data  = [];
    
    public function __construct() {
        $this->load->library("LovvitEngine");
    }

    /*
    *
    *   API credential
    *
    *
    */

    public function set_post($endpoint, $parameters=[]) {
        $this->_model   = $this->lovvitengine->curl_post($endpoint, $parameters);

        return $this;
    }

    public function set_get($endpoint, $parameters=[]) {
        $this->_model   = $this->lovvitengine->curl_get($endpoint, $parameters);
        
        return $this;
    }

    public function is_exists() {
        // $this->utilities->printr(count($this->_model["message"]));
        // exit();
        if ( count($this->_model["message"]) != 0 ) return True;
        return False; 
    }

    public function list($data="") {
        $results    = [];
        if ( $data == "" ) {
            $results    = $this->_model["message"];
        } else {
            foreach ( $this->_model["message"] as $index => $model ) {
                $results[]   = $model[$data];
            }
        }

        return $results;
    }

    public function details($data="") {
        $results    = [];
        if ( $data == "" ) {
            if ( array_key_exists(0, $this->_model["message"]) ) {
                $results    = $this->_model["message"][0];
            } else {
                $results    = $this->_model["message"];
            }
        } else {
            if ( array_key_exists(0, $this->_model["message"]) ) {
                $results    = $this->_model["message"][0][$data];
            } else {
                $results    = $this->_model["message"][$data];
            }
        }

        return $results;
    }

    public function member_register($save_data) {
        $this->_model   = $this->lovvitengine->curl_post("member/register", $save_data);
        
        return $this;
    }

    public function http_response_code() {
       return $this->_model["status"];
    }

    public function get_error_message() {
        return $this->_model["message"];
    }


    public function application_get_role_list() {
        $application = $this->lovvitengine->curl_get("application/get", []);
        $application_role_list = $application["message"]["application_role_list"];
        unset($application_role_list[0]);
        // unset($application_role_list[1]);
       
        return $application_role_list;
    }

    public function initialize($data) {
        $this->_data   = $data;
        return $this;
    }

    public function do_login() {
        // set expiry date
        $today          = date("Y-m-d");
        $today          = strtotime($today);
        $expiry_date    = strtotime("+7 day", $today);

        $parameters                     = [];
        $parameters["credential_hash"]  = md5($this->_data["username"] . $this->_data["password"]);  
        $parameters["validity_seconds"] = 24*60*60;
        $parameters["expiry_date"]      = date("Y-m-d", $expiry_date);
        
        $result = $this->lovvitengine->curl_post("login/application_access_init", $parameters);
        if ( $result["status"] == 200 ) {
            return $result["message"];
        } else {
            return False;
        }
    }

}
