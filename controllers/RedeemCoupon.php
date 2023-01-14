<?php defined('BASEPATH') OR exit('No direct script access allowed');

class RedeemCoupon extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->authentications->login_required();
        $this->load->model("Application_model", "app_model");
    }

    public function index() {
        $data["app_name_first"] = "Lov";
        $data["app_name_last"]  = "vit";
        $data["page_title"]     = "Lovvit - Reedem coupon";
        $data["header"]         = "Reedem coupon";
        $this->load->view("redeem_coupon/redeem_coupon_view", $data);
    }

    public function redeem() {
        $config = [
            [
                "field" => "coupon_code",
                "rules" => "required|min_length[2]|max_length[32]|xss_clean|htmlspecialchars|trim",
                "label" => "Coupon Code"
            ],
        ];
        $this->form_validation->set_rules($config);
        if ( $this->form_validation->run() == TRUE ) {
            $response = $this->app_model->redeem_coupon(["coupon_code" => $this->input->post("coupon_code")]);
            // $this->utilities->printr($response);
            if ( $response["status"] == 200 ) {
                $result = [
                    'status' => "success",
                    'type' => 'success',
                    'icon' => '<i class="fa fa-times-circle"></i>',
                    'btn-type' => 'btn-danger',
                    'modal-type' => 'modal-danger',
                    'message' => $response["result"],
                    'message2' => ''
                ];
            } else {
                $result = [
                    'status' => "error",
                    'type' => 'info',
                    'icon' => '<i class="fa fa-times-circle"></i>',
                    'btn-type' => 'btn-danger',
                    'modal-type' => 'modal-danger',
                    'message' => $response["result"],
                    'message2' => ''
                ];
            }
        } else {
            $result = [
                'status' => "error",
                'type' => 'info',
                'icon' => '<i class="fa fa-times-circle"></i>',
                'btn-type' => 'btn-danger',
                'modal-type' => 'modal-danger',
                'message' => validation_errors(),
                'message2' => ''
            ];
        }

        echo json_encode($result);
    }

}