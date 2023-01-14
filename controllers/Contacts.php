<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->authentications->login_required();
    }

    private function _base64_encode_url($string) {
		return str_replace(['+','/','='], ['-','_',''], base64_encode($string));
	}

	private function _base64_decode_url($string) {
		return base64_decode(str_replace(['-','_'], ['+','/'], $string));
	}

    public function index() {
        $data["app_name_first"] = "Lov";
        $data["app_name_last"]  = "vit";
        $data["page_title"]     = "Lovvit - Contacts";
        $data["header"]         = "Contacts";
        $this->load->view("contact/contact_view", $data);
    }

    public function list_datatable() {
        $data       = [];
        $results    = [ "data" => $data ];
        echo json_encode($results);
    }

    public function tag_list_datatable() {
        $data       = [];
        $results    = [ "data" => $data ];
        echo json_encode($results);
    }

    public function tag_save() {
        $config = [
            [
                "field" => "tag_name",
                "rules" => "required|xss_clean|htmlspecialchars|trim",
                "label" => "Tag name"
            ],
        ];
        $this->form_validation->set_rules($config);
        
        if ( $this->form_validation->run() == TRUE ) {
            $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
            // $this->utilities->printr($organization_id);
            
            $result = [
                'status'    => "success",
                'type'      => 'success',
                'message'   => "OK",
                'message2'  => ""
            ];
        } else {
            $result = [
                'status'    => "error",
                'type'      => 'danger',
                'message'   => validation_errors(),
                'message2'  => ""
            ];
        }

        echo json_encode($result);
    }

    public function tag_delete($id) {
        $result = [
            'status'    => "success",
            'type'      => 'success',
            'message'   => "OK, $id",
            'message2'  => ""
        ];

        echo json_encode($result);
    }

}