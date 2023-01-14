<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Application_model", "app_model");
    }

    public function index() {
        $data["app_name_first"] = "Lov";
        $data["app_name_last"]  = "vit";
        $data["page_title"]     = "Lovvit - Login";
        $data["header"]         = "Login";
        $this->load->view("authentication/login_view", $data);
    }

    public function run() {
        $config = [
            [
                "field"     => "email",
                "rules"     => "required|min_length[2]|max_length[32]|xss_clean|htmlspecialchars|trim",
                "labels"    => "Email"
            ],
            [
                "field"     => "password",
                "rules"     => "required|xss_clean|htmlspecialchars",
                "labels"    => "Password"
            ]
        ];
        $this->form_validation->set_rules($config);

        if ( $this->form_validation->run() == TRUE ) {
            $data               = [];
            $data["email"]      = $this->input->post("email");
            $data["password"]   = $this->input->post("password");
            $this->authentications->do_login($data);
            // redirect("Dashboard");
        } else {
            $this->authentications->set_session_flashdata(validation_errors(), "danger");
            redirect("Login");
        }
    }

}