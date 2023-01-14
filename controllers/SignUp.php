<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SignUp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Application_model", "application_model");
        $this->load->model("Credential_model", "credential_model");
    }

    public function index() {
        $data = [
            "page_title"    => "Lovvit - Sign Up",
            "header"        => "Sign Up"
        ];
        
        $this->load->view("authentication/signup_view", $data);
    }

    public function invitation() {
        // Fixed url : app.lovvit.id/SignUp/invitation?org=***&approle=***
        $data               = [];
        $data["page_title"] = "Lovvit - SignUp";

        if ( !empty($_GET) ) {
            if ( array_key_exists("org", $_GET) && array_key_exists("approle", $_GET) ) {
                $data["organization_id"]    = $_GET["org"];
                $data["application_role"]   = $_GET["approle"];
                // $this->utilities->printr($this->authentications->encrypt($_GET["org"]));
                // exit();
                $session_url    = !empty($_SERVER["QUERY_STRING"]) ? ["redirect" => $_SERVER["QUERY_STRING"]] : "" ;
                $this->session->set_userdata($session_url);

                $this->load->view("authentication/signup_view", $data);
            } else {
                $this->load->view("authentication/signup_view", $data);
            }
        } else {
            $this->load->view("authentication/signup_view", $data);
        }
    }

    public function run() {
        $redirect_url   = "http://127.0.0.1/lovvit-app/SignUp/invitation?" . $this->session->userdata("redirect");
        // $redirect_url   = "https://app.lovvit.id/SignUp/invitation?" . $this->session->userdata("redirect");
        $config         = [
            [
                "field"     => "organization",
                "rules"     => "required|xss_clean|htmlspecialchars|trim",
                "labels"    => "Organization"
            ],
            [
                "field"     => "email",
                "rules"     => "required|xss_clean|htmlspecialchars|trim",
                "labels"    => "Email"
            ],
            [
                "field"     => "application",
                "rules"     => "required|xss_clean|htmlspecialchars|trim",
                "labels"    => "Application role"
            ],
            [
                "field"     => "password",
                "rules"     => "required|min_length[2]|max_length[32]|xss_clean|htmlspecialchars|trim",
                "labels"    => "Password"
            ],
            [
                "field"     => "re_password",
                "rules"     => "required|min_length[2]|max_length[32]|xss_clean|htmlspecialchars|trim",
                "labels"    => "Retype password"
            ]
        ];
        $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == TRUE) {
            $organization_encrypt       = $this->input->post("organization");
            $application                = $this->input->post("application");
            $password                   = $this->input->post("password");
            $re_password                = $this->input->post("re_password");
            $email                      = $this->input->post("email");
            $organization_id            = $this->authentications->decrypt($organization_encrypt);
            // $api_user_role_list         = $this->application_model->application_get_role_list();

            // $application_role_name = "None";
            // foreach ( $api_user_role_list as $index => $api_user_role ) {
            //     if ( $index == $application ) $application_role_name = $api_user_role;
            // }

            // if ( $application_role_name == "None" ) {
            //     $this->authentications->set_session_flashdata("Application role name is not registered", "danger");
            //     redirect($redirect_url);
            // }

            // Validate: password
            if ( $password != $re_password ) {
                $this->authentications->set_session_flashdata("Password does not match", "danger");
                redirect($redirect_url);
            }

            // Get: organizations
            $organization_name      = "";
            $organization_number    = "";
            $api_organization      = $this->credential_model->set_get("organization/get_list", ["organization_number" => $organization_id]);
            if ( $api_organization->http_response_code() != 200 ) {
                $this->authentications->set_session_flashdata($api_organization->get_error_message() . "code: 1", "danger");
                redirect($redirect_url);
            } else {
                if ( $api_organization->is_exists() ) {
                    $organization_name      = $api_organization->details("name");
                    $organization_number    = $api_organization->details("organization_number");
                } else {
                    $this->authentications->set_session_flashdata("Organization not found " . "code: 1", "danger");
                    redirect($redirect_url);
                }
            }

            // $this->utilities->printr($api_organization);
            // exit();

            // Get: members
            $api_members = $this->credential_model->set_get("member/get_list", []);
            if ( $api_members->http_response_code() == 200 ) {
                if ( $api_members->is_exists() ) {
                    $member_by_organization_id  = [];
                    foreach ( $api_members->list() as $member ) {
                        foreach ( $member["membership"] as $organization ) {
                            if ( 
                                $member["email_address"] == $email &&
                                $member["is_suspended"] == 0 && 
                                $organization["organization_name"] == $organization_name &&
                                $member["membership"][0]["application_role_name"] == $application
                            )
                            $member_by_organization_id = $member;
                        }
                    }

                    // $this->utilities->printr($member_by_organization_id);
                    // exit();

                    if ( !empty($member_by_organization_id) ) {
                         // Set: activate
                        $username       = $member_by_organization_id["username"];
                        $member_number  = $member_by_organization_id["member_number"];
                        $save_data  = [
                            "member_number" => $member_number,
                            "is_active"     => 1,
                            "active_note"   => "Activated member"
                        ];
                        $api_set_active   = $this->credential_model->set_post("member/set_active", $save_data);

                        if ( $api_set_active->http_response_code() == 200 ) {
                            $api_password_reset_token   = $this->credential_model->set_post("member/password_create_reset_token", ["member_number" => $member_number]);
                            if ( $api_password_reset_token->http_response_code() == 200 ) {
                                $save_data  = [
                                    "password_reset_token"  => $api_password_reset_token->details("password_reset_token"),
                                    "new_password"          => $password
                                ]; 
                                $api_confirm_reset_password = $this->credential_model->set_post("member/password_confirm_reset_token", $save_data);
                                
                                if ( $api_confirm_reset_password->http_response_code() == 200 ) {
                                    $this->authentications->set_session_flashdata("Success registered, please login", "success");
                                    redirect("Login");
                                } else {
                                    $this->authentications->set_session_flashdata($api_confirm_reset_password->get_error_message() . "code: 2", "danger");
                                    redirect($redirect_url);
                                }
                            } else {
                                $this->authentications->set_session_flashdata($api_password_reset_token->get_error_message() . "code: 3", "danger");
                                redirect($redirect_url);
                            }
                        } else {
                            $this->authentications->set_session_flashdata($api_set_active->get_error_message() . "code: 4", "danger");
                            redirect($redirect_url);
                        }
                    } else {
                        $this->authentications->set_session_flashdata("Member not found " . "code: 5", "danger");
                        redirect($redirect_url);
                    }
                }
            } else {
                $this->authentications->set_session_flashdata($api_members->get_error_message(). "code: 6", "danger");
                redirect($redirect_url);
            }
        } else {
            $this->authentications->set_session_flashdata(validation_errors(), "danger");
            redirect($redirect_url);
        }
    }

    public function create_password() {
        $this->load->view("authentication/create_password_view.html");
    }

    // public function update() {
    //     $save_data  = [
    //         "member_number" => "",
    //     ]
    // }

}