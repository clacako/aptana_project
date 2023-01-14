<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Authentications {
    private $_post_data  = [];
    private $_data       = [];
    private $_secret_key = "%lql3&a_(m@-d-6)5ratx9i)bw0(9u744+5&g^flsmt=mikru9";

    public function __construct() {
        $this->lovvit   =& get_instance();
        $this->lovvit->load->model("Authentication_model", "auth_model");
        $this->lovvit->load->model("Credential_model", "credential_model");
        $this->lovvit->load->library("LovvitEngine");
        $this->lovvit->load->library("Utilities");
    }

    /*
    *
    * Set custom flashdata function
    *
    *
    */

    public function set_session_flashdata($message, $type) {
        $data   = [];
        $data   = [ "message" => $message, "type" => $type ];
        $this->lovvit->session->set_flashdata("notif", $data);
    }

    /*
    *
    *   Login action
    *   
    *
    */

    public function do_login($post_data) {
        // $password           = $this->hashPassword($post_data["password"]);
        $parameters         = [
            "email_address" => $post_data["email"],
            "is_suspended"  => 0,
            "is_active"     => 1
        ];
        $api_credential     = $this->lovvit->credential_model->set_get("member/get_list", $parameters);
        // $this->lovvit->utilities->printr($results);
        // exit();
        $data   = [];
        if ( $api_credential->http_response_code() == 200 ) {
            if ( $api_credential->is_exists() ) {
                $data   = [ 
                    "username"  => $api_credential->details("username"),
                    "password"  => $this->hashPassword($post_data["password"]),
                ];

                $member = $api_credential->initialize($data)->do_login();
                if ( $member ) {
                    $this->set_session($member);
                    redirect("Dashboard");
                } else {
                    $this->set_session_flashdata("Wrong email or password", "danger");
                    redirect("Login");
                }
            } else {
                $this->set_session_flashdata("Wrong email or password", "danger");
                redirect("Login");
            }
        } else {
            $this->set_session_flashdata($api_credential->get_error_message(), "danger");
            redirect("Login");
        }
    }

    /*
    *
    * Session (LOVVIT APP)
    *
    *
    */

    public function set_session($member) {
        $user_data  = [
            "is_logged_in"  => True,
            "member_number" => $member["member_details"]["member_number"],
            "username"      => $member["member_details"]["username"],
            "photo"         => $member["member_details"]["photo_url"],
            "role"          => $member["organization_list"][0]["role"],
            "org_id"        => $member["organization_list"][0]["organization_number"]
        ];

        $this->lovvit->session->set_userdata($user_data);
    }

    public function login_required() {
        if ( $this->lovvit->session->userdata("is_logged_in") == False ) {
            $this->set_session_flashdata("Please login", "danger");
            redirect("Login");
        }
    }

    public function destroy() {
        $this->lovvit->auth_model->member_logout();
        $this->lovvit->session->sess_destroy();
        redirect("Login");
    }

    /*
    *
    *   Credential and password hashing functions (API Credential):
    *   1. hashPassword   
    *   2. credentialHash
    *
    *
    */

    // Hash password
    public function hashPassword($password) {
        return  md5(md5($password));
    }

    // Credential hash
    public function credentialHash($username, $password) {
        return md5($username . $this->hashPassword($password));
    }

    /*
    *
    *   Check session (API Credential):
    *
    *
    */

    public function access_check() {
        var_dump($this->lovvit->lovvitengine->curl_get("login/application_access_check", []));
    }


    /*
    *
    *   Encrypt and decrypt
    *   
    *
    */

    public function encrypt($organization_id) {
        // $organization_id = "test";
        $ciphering      = "AES-128-CTR";
        $iv_length      = openssl_cipher_iv_length($ciphering); 
        $options        = 0;
        $encryption_iv  = '$13*{0%323431}66';
        $encryption_key = "aptana.lovvit.id";
        $encryption     = openssl_encrypt($organization_id, $ciphering, $encryption_key, $options, $encryption_iv);

        return $encryption;
    }

    public function decrypt($text) {
        $ciphering      = "AES-128-CTR";
        $iv_length      = openssl_cipher_iv_length($ciphering); 
        $options        = 0;
        $decryption_iv  = '$13*{0%323431}66';
        $decryption_key = "aptana.lovvit.id";
        $decryption     = openssl_decrypt ($text, $ciphering, $decryption_key, $options, $decryption_iv);
        
        return $decryption;
    }
}