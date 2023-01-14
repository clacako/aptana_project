<?php defined('BASEPATH') OR exit('No direct script access allowed');

class LovvitHome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("Utilities");
    }

    public function index() {
        $this->load->view("lovvit_home");
    }

}