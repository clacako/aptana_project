<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class LovvitEngine {

    private $_lovvit;

    public function __construct() {
        $this->_lovvit   =& get_instance();
        $this->_lovvit->config->load("lovvit_server");
        $this->_lovvit->load->library("Utilities");
    }

    /*
    *
    *   API Credentials
    *
    *
    */

    public function curl_post($endpoint, $parameters) {
        $url = config_item("api_server") . $endpoint . "?" . http_build_query($parameters);

        $header = array();
        $header[] = "Authorization: {\"APPID\":\"" . config_item("app_id") . "\",\"SERVERID\":\"" . config_item("server_id") . "\"}";
        $header[] = "Content-type: application/json";

        // COOKIE
        $cookie_server_id = substr(preg_replace('/[^A-Za-z0-9\-]/', "", config_item("server_id")), -7);
        $cookie_application_id = substr(preg_replace('/[^A-Za-z0-9\-]/', "", config_item("app_id")), -7);
        // $cookie_string = "PHPSESSID=". $_COOKIE["PHPSESSID"] . "-" . $cookie_server_id . "-" . $cookie_application_id . ";";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);        
        curl_setopt($ch, CURLOPT_URL, $url);    
        // curl_setopt($ch, CURLOPT_COOKIE, $cookie_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 1); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters)); 

        $output = curl_exec($ch); 

        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($output, 0, $header_size);
        $body = substr($output, $header_size);

        // ** 
        // try to detect error if any
        $info = curl_getinfo($ch);
        if($info["http_code"] != "200") {
            // try to get the error message;
            $error_message = "";
            if($info["http_code"] == "201") {
                $temp = explode("HTTP/1.1 201 ", $output);
                $temp = explode("\n", $temp[1])[0];
                $error_message = "(" . $info["http_code"] . ") " . $temp;
            } else {
                $temp = explode("HTTP/1.1 " . $info["http_code"] . " ", $output);
                $temp = explode("\n", $temp[1])[0];
                $error_message = "(" . curl_errno($ch)  . ") " . $temp . " " . curl_error($ch);
            }

            // throw new Exception($endpoint . " : " . $error_message);
            $results    = [
                "status"    => $info["http_code"],
                "message"   => $error_message
            ];
            return $results;
        } 
        
        curl_close($ch);
        $body = json_decode($body, true);

        $results    = [
            "status"    => 200,
            "message"   => $body 
        ];

        return $results;
    }    

    public function curl_get($endpoint, $parameters) {
        
        $header[]   = "Authorization: {\"APPID\":\"" . config_item("app_id") . "\",\"SERVERID\":\"" . config_item("server_id") . "\"}";
        $api_server = config_item("api_server");

        $url = $api_server . $endpoint . "?" . http_build_query($parameters);
        
        // COOKIE
        $cookie_server_id = substr(preg_replace('/[^A-Za-z0-9\-]/', "", config_item("server_id")), -7);
        $cookie_application_id = substr(preg_replace('/[^A-Za-z0-9\-]/', "", config_item("app_id")), -7);
        // $cookie_string = "PHPSESSID=". $_COOKIE["PHPSESSID"] . "-" . $cookie_server_id . "-" . $cookie_application_id . ";";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);        
        curl_setopt($ch, CURLOPT_URL, $url);    
        // curl_setopt($ch, CURLOPT_COOKIE, $cookie_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HEADER, 1); 
        curl_setopt($ch, CURLOPT_HTTPGET, 1); 

        $output = curl_exec($ch); 
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($output, 0, $header_size);
        $body = substr($output, $header_size);

        // ** 
        // try to detect error if any
        $info = curl_getinfo($ch);
        if($info["http_code"] != "200") {
            // try to get the error message;
            $error_message = "";
            if($info["http_code"] == "201") {
                $temp = explode("HTTP/1.1 201 ", $output);
                $temp = explode("\n", $temp[1])[0];
                $error_message = "(" . $info["http_code"] . ") " . $temp;
            } else {
                $temp = explode("HTTP/1.1 " . $info["http_code"] . " ", $output);
                $temp = explode("\n", $temp[1])[0];
                $error_message = "(" . $info["http_code"]  . ") " . $temp . " " . curl_error($ch);
            }

            // throw new Exception($endpoint . " : " . $error_message);
            $results    = [
                "status"    => 201,
                "message"   => $error_message
            ];

            return $results;
        }

        curl_close($ch);
        $body       = json_decode($body, true);
        $results    = [
            "status"    => 200,
            "message"   => $body
        ];

        return $results;
    }

    /*
    *
    *   API lovvit hq
    *
    *
    */

    public function curl_post_hq($endpoint, $parameter) {
        ini_set("memory_limit", "-1");
        $url    = config_item("api_server_hq") . $endpoint;
        
        $curl   = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            // CURLOPT_URL => 'localhost/lovvit_id_hq/api/campaign_get_list',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $parameter,
            CURLOPT_HTTPHEADER => array(
                'APPKEY: ' . config_item("api_key_hq"),
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));

        $response = curl_exec($curl);
        // var_dump($response);
        curl_close($curl);
        return json_decode($response, TRUE);
    }

    public function curl_post_hq_coupon_save($endpoint, $parameters) {
        $url    = config_item("api_server_hq") . $endpoint;
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $parameters,
        CURLOPT_HTTPHEADER => array(
            'APPKEY: AE^TxYVgL9NPaf!Y^_n&theMGVG#7^9@',
            'Content-Type: application/json',
            'Cookie: ci_session=t66hdvnhhdiep1262sshrpligjrfq92m'
        ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return json_decode($response, true);
    }

    /*
    *
    *   API Wa bot
    *
    *
    */

    public function curl_post_wa_bot($endpoint, $parameters) {
		$url = config_item("host").$endpoint;
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $parameters,
			CURLOPT_HTTPHEADER => array(
                'APPKEY: AE^TxYVgL9NPaf!Y^_n&theMGVG#7^9@',
				'Content-Type: application/x-www-form-urlencoded',
				'Cookie: ci_session=04uel7qqpa702010grj78evk68jcvitd'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		$result = json_decode($response,true);
		return $result;
	}

}