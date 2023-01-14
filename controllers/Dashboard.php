<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->authentications->login_required();
    }

    public function index() {
        $data["app_name_first"] = "Lov";
        $data["app_name_last"]  = "vit";
        $data["page_title"]     = "Lovvit - Dashboard";
        $data["header"]         = "Dashboard";

        $this->load->view("dashboard/dashboard_view.php", $data);
    }

}