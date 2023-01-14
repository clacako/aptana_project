<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Campaigns extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->authentications->login_required();
        $this->load->model("Application_model", "app_model");
        $this->load->library("Reports");
    } 

    private function _base64_encode_url($string) {
		return str_replace(['+','/','='], ['-','_',''], base64_encode($string));
	}

	private function _base64_decode_url($string) {
		return base64_decode(str_replace(['-','_'], ['+','/'], $string));
	}

    public function index() {
        ini_set("memory_limit", "-1");
        $data   = [
            "page_title"    => "Lovvit - Campaigns",
            "header"        => "Campaigns"
        ];

        $this->load->view("campaign/campaign_view", $data);
    }

    public function campaign_list_datatable() {
        $data               = [];
        $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
        $parameters         = [ "OrganizationID" => $organization_id ];
        $api_campaign       = $this->app_model->set("campaign_get_list", $parameters);
        
        if ( $api_campaign->is_exists() ) {
            $counter = 0;
            $campaigns = $api_campaign->list();
            foreach ($campaigns as $campaign) {
                // Set status
                $today = date("Y-m-d");
                $campaign_start_date = date("Y-m-d", strtotime($campaign["CampaignStartDate"]));
                $campaign_end_date = date("Y-m-d", strtotime($campaign["CampaignEndDate"]));
                if ( $campaign["Is_Active"] && ($today >= $campaign_start_date && $today <= $campaign_end_date) ) {
                    $font_class = "text-success";
                    $status = "RUNNING";
                } elseif ( $campaign["Is_Active"] && ($today <= $campaign_start_date) ) {
                    $font_class = "text-warning";
                    $status= "SCHEDULED";
                } elseif ( $campaign["Is_Active"] && ($today >= $campaign_end_date) ) {
                    $font_class = "text-info";
                    $status = "COMPLETED";
                } else {
                    $font_class = "text-danger";
                    $status = "INACTIVE";
                }
    
                $counter++;
                $data[] = [
                    $counter,
                    date("d-m-Y", strtotime($campaign["created"])),
                    $campaign["CampaignTitle"],
                    date("d-m-Y", strtotime($campaign["CampaignStartDate"])),
                    date("d-m-Y", strtotime($campaign["CampaignEndDate"])),
                    "<a href='javascript:void(0)' class='${font_class}'>${status}</a>",
                    "<a href='". base_url("Campaigns/details/". $campaign["id"] ."") ."' data-id='". $campaign["id"] ."' class='btn btn-block btn-light waves-effect waves-light text-info'>
                        Details
                    </a>"
                ];
            }  
            
            $results = ['data' => $data];
        } else {
            $results = [ "data" => $data ];
        }

        echo json_encode($results);
    }

    public function details($id) {
        // Set data
        $data               = [];
        $data["id"]         = (int)$id;
        $data["page_title"] = "Lovvit - Campaign details";
        $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
        $parameters         = [ "id" => (int)$id, "OrganizationID" => $organization_id ];
        $api_campaign       = $this->app_model->set("campaign_get_details", $parameters);

        if ( $api_campaign->is_exists() ) {
            /*
            *   Campaign details
            *
            *
            */
            
            $campaign_mobile_coupon = !empty($api_campaign->get("MobileCouponCampaign")) ? $api_campaign->get("MobileCouponCampaign")[0] : $api_campaign->get("MobileCouponCampaign");
            
            // $this->utilities->printr($campaign->details());
            // Set status
            // if ( $campaign->details("CampaignStatus") == "Active" ) {
            //     $font_class = "text-success";
            //     $status = "RUNNING";
            // } elseif ( $campaign->details("CampaignStatus") == "Scheduled" ) {
            //     $font_class = "text-warning";
            //     $status = "SCHEDULED";
            // } elseif ( $campaign->details("CampaignStatus") == "Completed" ) {
            //     $font_class = "text-info";
            //     $status = "COMPLETED";
            // } else {
            //     $font_class = "text-danger";
            //     $status = "INACTIVE";
            // }

            // Campaign status
            $today = date("Y-m-d");
            $campaign_start_date = date("Y-m-d", strtotime($api_campaign->details("CampaignStartDate")));
            $campaign_end_date = date("Y-m-d", strtotime($api_campaign->details("CampaignEndDate")));
            if ( $api_campaign->details("Is_Active") && ($today >= $campaign_start_date && $today <= $campaign_end_date) ) {
                $font_class = "text-success";
                $status = "RUNNING";
            } elseif ( $api_campaign->details("Is_Active") && ($today <= $campaign_start_date) ) {
                $font_class = "text-warning";
                $status= "SCHEDULED";
            } elseif ( $api_campaign->details("Is_Active") && ($today >= $campaign_end_date) ) {
                $font_class = "text-info";
                $status = "COMPLETED";
            } else {
                $font_class = "text-danger";
                $status = "INACTIVE";
            }

            // Set data
            $data["header"]                 = "Campaigns details - " . $api_campaign->details("CampaignTitle");
            $data["campaign"]               = $api_campaign->details();
            $data["campaign_trackers"]      = $api_campaign->get("Trackers");
            $data["campaign_mobile_coupon"] = $campaign_mobile_coupon;
            $data["font_class"]             = $font_class;
            $data["status"]                 = $status;
           
            $this->load->view("campaign/details_view", $data);
        } else {
            $data   = [
                "page_title"    => "Lovvit - Campaign details",
                "header"        => "",
            ];
            $this->load->view("campaign/details_no_data_found_view", $data);
        }
    }

    public function campaign_report($id) {
         // Set data
        $data               = [];
        $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
        $parameters         = [ "id" => (int)$id, "OrganizationID" => $organization_id ];
        $api_campaign       = $this->app_model->set("campaign_get_details", $parameters);

        if ( $api_campaign->is_exists() ) {
            /*
            *   Campaign report ads performance
            *   1. Ads performance
            *   2. Coupon issued
            *   3. Landing page visits
            *   4. Coupon details view
            *   5. Redeem coupon
            *
            *   
            */

            // #1 Ads performance

            // #2 Coupon issued
            $leads = $api_campaign->get("Leads");
            $coupon_issued_list = [];
            foreach ($leads as $lead ) {
                if ( !empty($lead["CouponCode"]) ) $coupon_issued_list[$lead["TrackerShortCode"]][] = $lead;
            }

            // Set data
            $data["coupon_issued_list"] = $coupon_issued_list;



            // #3. Landing page visits
            $trackers = $api_campaign->get("Trackers");
            $default_tracker = $this->app_model->get_default_tracker($trackers);
            
            $leads_hash = $this->utilities->array_to_hash($leads, "id");
            $lead_id_list = array_keys($leads_hash);
           
            $lead_activities    = [];
            $parameters         = [];
            foreach ($lead_id_list as $leads_id) {
                $parameters = ["Lead_id" => $leads_id, "ActivityType" => "VisitLandingPage"];
                $api_leads_activities   = $this->app_model->set("leads_activities_get_list", $parameters);
                if ( $api_leads_activities->get_http_response_code() == 200 ) {
                    $lead_activities = array_merge($api_leads_activities->list(), $lead_activities);
                }
            }
            
            $lead_activities_by_tracker_short_code = [];
            foreach ($lead_activities as $lead_activity) {
                if ( empty($lead_activity["Parameters"]) ) {
                    $lead_activity["Parameters"] = $default_tracker;
                }
            
                $lead_activities_by_tracker_short_code[$lead_activity["Parameters"]][]   = $lead_activities;
            }
                
            // Set data
            $data["landing_page_visits"] = $lead_activities_by_tracker_short_code;

            // #4. Coupon details view
            $default_tracker = $this->app_model->get_default_tracker($trackers);
            
            $leads_hash = $this->utilities->array_to_hash($leads, "id");
            $lead_id_list = array_keys($leads_hash);
            
            $lead_activities    =   [];
            $parameters = [];
            foreach ($lead_id_list as $leads_id) {
                $parameters = ["Lead_id" => $leads_id, "ActivityType" => "ViewCouponDetails"];
                $api_leads_activities   = $this->app_model->set("leads_activities_get_list", $parameters);
                if ( $api_leads_activities->get_http_response_code() == 200 ) {
                    $lead_activities = array_merge($api_leads_activities->list(), $lead_activities);
                }
            }
            
            $lead_activities_by_tracker_short_code = [];
            foreach ($lead_activities as $lead_activity) {
                if ( empty($lead_activity["Parameters"]) ) {
                    $lead_activity["Parameters"] = $default_tracker;
                }
            
                $lead_activities_by_tracker_short_code[$lead_activity["Parameters"]][]   = $lead_activities;
            }

            // Set data
            $data["coupon_details_view"] = $lead_activities_by_tracker_short_code;



            #5 Redeem Coupon
            $coupon_redeem_list = [];
            $coupon_not_redeem_list = [];
            $coupon_not_redeem_count = 0;
            foreach ($leads as $lead) {
                if ( !empty($lead["CouponCode"]) && date("d-m-Y H:i:s", strtotime($lead["CouponRedeemDate"])) != "01-01-1971 00:00:00" ) $coupon_redeem_list[$lead["TrackerShortCode"]][] = $lead;
                if ( !empty($lead["CouponCode"]) && date("d-m-Y H:i:s", strtotime($lead["CouponRedeemDate"])) == "01-01-1971 00:00:00" ) $coupon_not_redeem_list[$lead["TrackerShortCode"]][] = $lead;
            }

            $data["coupon_redeem_list"] = $coupon_redeem_list;
            $data["coupon_not_redeem_count"] = $coupon_not_redeem_count;

            $this->load->view("campaign/reports", $data);
        } else {
            $this->load->view("campaign/details_no_data_found_view");
        }
    }

    public function campaign_leads_datatable($id) {
        $data               = [];
        $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
        $parameters         = [ "id" => (int)$id, "OrganizationID" => $organization_id ];
        $api_campaign       = $this->app_model->set("campaign_get_list", $parameters);

        if ( $api_campaign->is_exists() ) {
            // Get: mobile coupon campaign
            $campaign_mobile_coupon = !empty($api_campaign->get("MobileCouponCampaign")) ? $api_campaign->get("MobileCouponCampaign")[0] : $api_campaign->get("MobileCouponCampaign");

            // Get: leads
            $leads                  = $api_campaign->get("Leads");
            
            // Get: leads by issued
            $lead_id_list  = [];
            foreach ($leads as $lead) {
                if (
                    ($lead["CouponIssueDate"] != "1971-01-01 00:00:00" || !empty($leads["CouponIssueDate"])) // &&
                    // ($lead["CouponRedeemDate"] == "1971-01-01 00:00:00" || empty($leads["CouponRedeemDate"]))
                ) {
                    $lead_id_list[]    = $lead["id"];
                }
            }

            // Get: lead activities
            $lead_activities    =   [];
            $parameters = [];
            foreach ($lead_id_list as $leads_id) {
                $parameters = ["Lead_id" => $leads_id];
                // $lead_activities = array_merge($this->app_model->set("leads_activities_get_list", $parameters)->list(), $lead_activities);
                $api_leads_activities   = $this->app_model->set("leads_activities_get_list", $parameters);
                if ( $api_leads_activities->get_http_response_code() == 200 ) {
                    $lead_activities = array_merge($api_leads_activities->list(), $lead_activities);
                }
            }

            // Get: lead activities redeem or issued
            foreach ($lead_activities as $index => $lead_activity) {
                if ( $lead_activity["ActivityType"] != "RedeemCoupon" && $lead_activity["ActivityType"] != "CouponIssue" ) {
                    unset($lead_activities[$index]);
                }
            }
                        
            $counter = 0;
            foreach ($lead_activities as $lead_activity) {
                $counter++;
                $data[] = [
                    $counter,
                    $lead_activity["TrackerShortCode"],
                    $coupon_code        = !empty($lead_activity["CouponCode"]) ? $lead_activity["CouponCode"] : "-",
                    date("d-m-Y H:i:s", strtotime($lead_activity["CouponIssueDate"])),
                    $redeem_date        = empty($lead_activity["CouponRedeemDate"]) || date("d-m-Y H:i:s", strtotime($lead_activity["CouponRedeemDate"])) == "01-01-1971 00:00:00" ? "-" : date("d-m-Y H:i:s", strtotime($lead_activity["CouponRedeemDate"])),
                    $laed_phone_number  = !empty($lead_activity["LeadPhoneNumber"]) ? $lead_activity["LeadPhoneNumber"] : "-"
                ];
            }
        }

        $results = ['data' => $data];
        echo json_encode($results);
    }

    public function import_coupon_code() {
        $config = [
            [
                "field" => "id",
                "rules" => "required|xss_clean|htmlspecialchars|trim",
                "label" => "Campaign id"
            ],
        ];
        $this->form_validation->set_rules($config);
        
        if ( $this->form_validation->run() ) {
            $campaign_id    = $this->input->post("id");
            
            $this->load->library('upload');
            $config['upload_path']      = './imports';
            $config['allowed_types']    = 'xlsx|xls';
            $config['max_size']         = '5120'; // 5mb
            $config['encrypt_name']     = True;
            // $file_name                  = $_FILES['coupon_code']['name'];
            // $config['file_name']        = $file_name;
            $this->upload->initialize($config);

            if ( $this->upload->do_upload('coupon_code') ) {
                $data               = [];
                $header             = [ "coupon_code" ];
                $data_parsing       = $this->reports->xlsx_extract_data($this->upload->data()["file_name"], $header, 1);
                unset($data_parsing[0]);

                if ( count($data_parsing) > 100000 ) {
                    $result = [
                        'status'        => "error",
                        'type'          => 'info',
                        'icon'          => '<i class="fa fa-times-circle"></i>',
                        'btn-type'      => 'btn-success',
                        'modal-type'    => 'modal-success',
                        'message'       => "Uploaded coupon limit exceeded (max: 100,000 records)",
                        'message2'      => ''
                    ];
                    echo json_encode($result);
                    exit();
                }

                $save_data                  = [];
                $save_data["campaign_id"]   = $campaign_id;
                foreach ($data_parsing as $index => $coupon_code) {
                    $save_data["coupon_code"][] = $coupon_code["coupon_code"];
                }

                $parameters             = json_encode($save_data);
                $api_coupon_code_save   = $this->app_model->set("coupon/save", $parameters, "coupon_save");

                if ( $api_coupon_code_save->get_http_response_code() == 200 ) {
                    $result = [
                        'status'        => "success",
                        'type'          => 'info',
                        'icon'          => '<i class="fa fa-times-circle"></i>',
                        'btn-type'      => 'btn-success',
                        'modal-type'    => 'modal-success',
                        'message'       => $api_coupon_code_save->list(),
                        'message2'      => ''
                    ];
                } else {
                    $result = [
                        'status'        => "error",
                        'type'          => 'info',
                        'icon'          => '<i class="fa fa-times-circle"></i>',
                        'btn-type'      => 'btn-success',
                        'modal-type'    => 'modal-success',
                        'message'       => $api_coupon_code_save->get_error_message(),
                        'message2'      => ''
                    ];
                }
            } else {
                $result = [
                    'status'        => "error",
                    'type'          => 'info',
                    'icon'          => '<i class="fa fa-times-circle"></i>',
                    'btn-type'      => 'btn-danger',
                    'modal-type'    => 'modal-danger',
                    'message'       => $this->upload->display_errors(),
                    'message2'      => ''
                ];
            }
        } else {
            $result = [
                'status'        => "error",
                'type'          => 'info',
                'icon'          => '<i class="fa fa-times-circle"></i>',
                'btn-type'      => 'btn-danger',
                'modal-type'    => 'modal-danger',
                'message'       => validation_errors(),
                'message2'      => ''
            ];
        }
        
    
        echo json_encode($result);
    }

    public function coupon_dashboard($id) {
        $parameters             = [ "campaign_id" => (int)$id ];
        $api_coupon_code_stat   = $this->app_model->set("coupon/stat", $parameters);
        // $this->utilities->printr($api_coupon_code_stat);
        
        $coupon_code_count              = 0;
        $coupon_duplicate_value_count   = 0;
        $coupon_issued_list             = 0;

        if ( $api_coupon_code_stat->get_http_response_code() == 200 ) {
            $coupon_code_stat   = $api_coupon_code_stat->list();
            
            $coupon_code_count              = $coupon_code_stat["total_coupon"];
            $coupon_duplicate_value_count   = $coupon_code_stat["duplicates"];
            $coupon_issued_list             = $coupon_code_stat["is_issued"];
        }

        $data["coupon_code_count"]              = !empty($coupon_code_count) ? $coupon_code_count : 0;
        $data["coupon_code_duplicate_count"]    = !empty($coupon_duplicate_value_count) ? $coupon_duplicate_value_count : 0;
        $data["coupon_issued_count_"]           = !empty($coupon_issued_list) ? $coupon_issued_list : 0;

        $this->load->view("campaign/coupon_dashboard", $data);
    }

    public function coupon_code_list_datatable($id) {
        ini_set("memory_limit", "-1");

        $data               = [];
        $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
        $parameters         = [ "id" => (int)$id ];
        $api_campaign       = $this->app_model->set("campaign_get_details", $parameters);
        $leads              = $api_campaign->get("Leads");
        
        $leads_by_coupon_code   = [];
        foreach ($leads as $lead) {
            if ( !empty($lead["CouponCode"]) ) {
                $leads_by_coupon_code[$lead["CouponCode"]]  = $lead;
            }
        }
        
        $parameters         = [];
        $parameters         = [
            "campaign_id" => (int)$id,
            "datatable_variables" => json_encode($_POST)
        ];
        $api_coupon_code    = $this->app_model->set("coupon/get-list", $parameters);
        
        if ( $api_coupon_code->is_exists() ) {
            $coupon_code_list   = $api_coupon_code->list();
            $counter            = $_POST["start"];
            
            foreach ($coupon_code_list["data"] as $coupon_code) {
                $issue_date    = "-";
                if ( !empty($leads_by_coupon_code[$coupon_code[1]]) ) {
                    if ( $coupon_code[2] == 1 ) {
                        $issue_date    = date("d-m-Y H:i", strtotime($leads_by_coupon_code[$coupon_code[1]]["CouponIssueDate"]));
                    }
                }

                $counter++;
                $data[] = [
                    $counter,
                    date("d-m-Y", strtotime($coupon_code[0])),
                    $coupon_code[1],
                    // $issued = $coupon_code["IsIssued"] == 1 ? "<strong class='text-danger'> Yes </stong>" : "<strong class='text-success'> No </stong>",
                    $issue_date
                ];
            }
        }

        $results["draw"]            = $coupon_code_list["draw"];
        $results["recordsTotal"]    = $coupon_code_list["recordsTotal"];
        $results["recordsFiltered"] = $coupon_code_list["recordsFiltered"];

        $results['data'] = $data;
        echo json_encode($results);
    }

    public function coupon_code_delete($mobile_coupon_campaign_id) {
        $parameters = [ "mobile_coupon_campaign_id" => $mobile_coupon_campaign_id ];
        $api_coupon_delete  = $this->app_model->set("coupon/delete-unissued", $parameters);
        // $this->utilities->printr($api_coupon_delete);
        // exit();
        if ( $api_coupon_delete->get_http_response_code() == 200 ) {
            $result = [
                'status'    => "success",
                'type'      => 'success',
                'message'   => "Success",
                'message2'  => ''
            ];
        } else {
            $result = [
                'status'    => "error",
                'type'      => 'danger',
                'message'   => $api_coupon_delete->get_error_message(),
                'message2'  => ''
            ];
        }

        echo json_encode($result);
    }

}