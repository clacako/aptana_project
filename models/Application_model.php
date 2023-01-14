<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Application_model extends CI_Model {
    private $_model         = [];
    private $_sub_model     = [];
    private $_wa_bot        = [];
    private $_credential    = [];

    public function __construct() {
        $this->load->library("LovvitEngine");
    }

    /*
    *
    *   API lovvit hq
    *
    *
    */


    public function set($endpoint, $parameters, $type="") {
        if ( $type == "coupon_save" || $type == "page_builder_config_save") {
            $response =  $this->lovvitengine->curl_post_hq_coupon_save($endpoint, $parameters);
            // $this->utilities->printr($response);
            // exit();
            $this->_model = $response;
            
            return $this;
        } else {
            $response =  $this->lovvitengine->curl_post_hq($endpoint, http_build_query($parameters));
            // $this->utilities->printr($response);
            // exit();
            $this->_model = $response;
            
            return $this;
        }
    }

    // Debugging function
    public function set_($endpoint, $parameters) {
        $response =  $this->lovvitengine->curl_post_hq($endpoint, http_build_query($parameters));
        $this->utilities->printr($this->lovvitengine->curl_post_hq($endpoint, http_build_query($parameters)));
        exit();
        // $this->_model = $response;
        
        return $response;
    }

    public function get_http_response_code() {
        return $this->_model["status"];
    }

    public function get_error_message() {
        return $this->_model["result"];
    }

    public function is_exists() {
        if ( array_key_exists("status", $this->_model) ) {
            if ( $this->_model["status"] == 400 ) return False;
        } else {
            if ( empty($this->_model) ) return False;
        }

        return True;
    }

    public function list($data="") {
        $result = [];
        if ( $data != "" ) {
            if ( array_key_exists("result", $this->_model) ) {
                foreach ( $this->_model["result"] as $index => $model ) {
                    $result[] = $model[$data];
                }
            } else {
                foreach ( $this->_model as $index => $model ) {
                    $result[] = $model[$data];
                }
            }
        } else {
            if ( array_key_exists("result", $this->_model) ) {
                $result = $this->_model["result"];
            } else {
                $result = $this->_model;
            }
        }

        return $result;
    }

    public function details($data="") {
        $result = [];
        if ( $data == "" ) {
            if ( array_key_exists("result", $this->_model) ) {
                if ( array_key_exists(0, $this->_model["result"]) ) {
                    foreach ( $this->_model["result"] as $index => $model ) {
                        $result = $model;
                    }
                } else {
                    $result = $this->_model["result"];
                }
            } else {
                if ( array_key_exists(0, $this->_model) ) {
                    foreach ( $this->_model as $index => $model ) {
                        $result = $model;
                    }
                } else {
                    $result = $this->_model;
                }
            }
        } else {
            if ( array_key_exists("result", $this->_model) ) {
                $result = array_key_exists(0, $this->_model["result"]) ? $this->_model["result"][0][$data] : $this->_model["result"][$data];
            } else {
                $result = array_key_exists(0, $this->_model) ? $this->_model[0][$data] : $this->_model[$data];
            }       
        }   

        return $result;
    }

    public function get($sub_model) {
        $result = [];
        if ( array_key_exists("result", $this->_model) ) {
            if ( array_key_exists(0, $this->_model["result"]) ) {
                foreach ($this->_model["result"] as $model) {
                    $result[] = $model[$sub_model];
                }
            } else {
                $result[] = $this->_model["result"][$sub_model];
            }
        } else {
            if ( array_key_exists(0, $this->_model) ) {
                foreach ($this->_model as $model) {
                    $result[] = $model[$sub_model];
                }
            } else {
                $result[] = $this->_model[$sub_model];
            }
        }


        $result = count($result) > 1 ? $result : $result[0];
        return $result;
    }

    public function get_default_tracker($trackers) {
        $default_tracker = "";
        foreach ($trackers as $tracker) {
            if ( $tracker["Description"] == 99 ) $default_tracker = $tracker["ShortCode"];
        }

        return $default_tracker;
    }

    public function redeem_coupon($parameters) {
        return $this->lovvitengine->curl_post_hq("coupon/redeem", http_build_query($parameters));
    }


    /*
    *
    *   API wa bot
    *
    *
    */

    public function wa_bot_api($endpoint, $parameters) {
        $response = $this->lovvitengine->curl_post_wa_bot($endpoint, http_build_query($parameters));
        $this->_wa_bot = $response;
        return $this;
    }

    public function http_response_code() {
        // $this->utilities->printr($this->_wa_bot);
        // exit();
        return $this->_wa_bot["status"];
    }

    public function results($data="") {
        if ( !empty($data) ) return $this->_wa_bot[$data];
        return $this->_wa_bot;
    }

    public function bot_status($wa_bot=[]) {
        return $this->_wa_bot["rData"]["statusText"];
    }


    # leads_activities_get_list    

}
