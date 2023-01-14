<?php defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardPageBuilder extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->authentications->login_required();
    }

    public function index() {
        $data   = [
            "page_title"    => "Dashboard",
            "header"        => "Brand landing page"
        ];

        // Get: organization
        $parameters         = [ "organization_number" => $this->session->userdata("org_id") ];
        $api_organization   = $this->credential_model->set_get("organization/get_list", $parameters);

        if ( $api_organization->http_response_code() == 200 ) {
            if ( $api_organization->is_exists() ) {
                // Set: brand url landing page
                $brand_url          = json_decode($api_organization->details("organization_details"), True)["brand_url"];
                $data["brand_url"]  = $brand_url;
                $data["url"]        = "https://lovvit.id/" . $brand_url;
                
                // Generate: qr code
                $qrcode_str         = $data["url"];
                $file_name          = md5($qrcode_str);
                $params['data']     = $qrcode_str;
                $params['level']    = 'H';
                $params['size']     = 6;
                $params['savename'] = FCPATH.'qr_code/'. $file_name .'.png';
                $this->ciqrcode->generate($params);
                // Set: qr code
                $data["qr_code_url"]    = $file_name;
                
                $this->load->view("dashboard_page_builder_view", $data);
            } else {
                # code: not exist
            }
        } else {
            # code: response code != 200
        }


        // $this->utilities->printr($data);
        // exit();

        // $this->load->view("dashboard_page_builder_view", $data);
    }

}