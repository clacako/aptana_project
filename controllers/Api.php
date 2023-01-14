<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("Login_assist");
        $this->load->library("Member_model");
    }

    public function get_member() {
        echo "test";
    }

}