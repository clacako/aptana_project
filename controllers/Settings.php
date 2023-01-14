<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->authentications->login_required();
        $this->load->model("Application_model", "app_model");
    }

    public function index() {
        $data   = [
            "page_title"    => "Lovvit - Settings",
            "header"        => "Settings"
        ];

        $this->load->view("settings/setting_view", $data);
    }


    public function member_modal_invitation($member_number) {
        $details = [];

        // Get: organization name
        $organization_name  = "";
        $parameters         = [ "organization_number" => $this->session->userdata("org_id") ];
        $api_organization   = $this->credential_model->set_get("organization/get_list", $parameters);
        if ( $api_organization->http_response_code() == 200 ) {
            if ( $api_organization->is_exists() ) {
                $organization_name  = $api_organization->details("name");
            }
        } else {
            $results = [
                'status'        => "error",
                'type'          => 'info',
                'icon'          => '<i class="fa fa-times-circle"></i>',
                'btn-type'      => 'btn-danger',
                'modal-type'    => 'modal-danger',
                'message'       => $api_organization->get_error_message(),
                'message2'      => ''
            ];
        }


        // Get: member
        $parameters = [ "application_identification" => $this->config->item("app_id") ];
        $api_member = $this->credential_model->set_get("member/get_list", []);
        if ( $api_member->http_response_code() == 200 ) {
            if ( $api_member->is_exists() ) {
                $member_by_organization_id  = [];
                foreach ( $api_member->list() as $member ) {
                    foreach ( $member["membership"] as $organization ) {
                        if ( $member["member_number"] == $member_number && $member["is_suspended"] == 0 && $organization["organization_name"] == $organization_name ) $member_by_organization_id = $member;
                    }
                }

                if ( !empty($member_by_organization_id) ) {
                    $details    = $member_by_organization_id;
                } else {
                    $results = [
                        'status'        => "error",
                        'type'          => 'info',
                        'icon'          => '<i class="fa fa-times-circle"></i>',
                        'btn-type'      => 'btn-danger',
                        'modal-type'    => 'modal-danger',
                        'message'       => "Member not found",
                        'message2'      => ''
                    ];
                }
            } else {
                $results = [
                    'status'        => "error",
                    'type'          => 'info',
                    'icon'          => '<i class="fa fa-times-circle"></i>',
                    'btn-type'      => 'btn-danger',
                    'modal-type'    => 'modal-danger',
                    'message'       => "Member not found",
                    'message2'      => ''
                ];
            }
        } else {
            $results = [
                'status'        => "error",
                'type'          => 'info',
                'icon'          => '<i class="fa fa-times-circle"></i>',
                'btn-type'      => 'btn-danger',
                'modal-type'    => 'modal-danger',
                'message'       => $api_organization->get_error_message(),
                'message2'      => ''
            ];
        }

        $data = [
            "modal_heading" => $modal_heading = !empty($details) ? "Edit user" : "Invite new user",
            "role_list"     => $this->credential_model->application_get_role_list(),
            "details"       => $details
        ];

        $this->load->view("settings/modal_user_invitation_view", $data);
    }

    public function member_send_invitation() {
        $config         = [
            [
                "field"     => "name",
                "rules"     => "required|xss_clean|htmlspecialchars|trim",
                "labels"    => "Name"
            ],
            [
                "field"     => "email",
                "rules"     => "required|xss_clean|htmlspecialchars|trim",
                "labels"    => "Email"
            ],
            [
                "field"     => "access",
                "rules"     => "required|xss_clean|htmlspecialchars|trim",
                "labels"    => "Access"
            ],
        ];
        $this->form_validation->set_rules($config);
        
        $data   = [];
        if ($this->form_validation->run() == TRUE) {
            $name   = $this->input->post("name");
            $email  = $this->input->post("email");
            $access = $this->input->post("access");
            
            
            $organization_id        = $this->authentications->encrypt($this->session->userdata("org_id"));
            $api_user_role_list     = $this->credential_model->application_get_role_list();

            // $this->utilities->printr($organization_id);
            // exit();
            
            // Get: application role name
            $application_role_name  = "";
            foreach ( $api_user_role_list as $index => $user_role ) {
                if ( $access == $index ) $application_role_name = $user_role; 
            }

            // Get: url invitation
            $parameters         = [ "application_identification" => $this->config->item("app_id") ];
            $api_application    = $this->credential_model->set_get("application/get", $parameters);
            if ( $api_application->http_response_code() == 200 ) {
                if ( $api_application->is_exists() ) {
                    $application    = $api_application->list();
                    $url            = $application["invitation_page_url"];
                }
            } else {
                $results = [
                    'status'        => "error",
                    'type'          => 'info',
                    'icon'          => '<i class="fa fa-times-circle"></i>',
                    'btn-type'      => 'btn-danger',
                    'modal-type'    => 'modal-danger',
                    'message'       => $api_application->get_error_message(),
                    'message2'      => ''
                ];
                echo json_encode($results);
                return False;
            }

            // Prepare: send invitation by email
            $host           = "https://" . $url;
            $query_string   = "?org=". $organization_id ."&approle=". $application_role_name; 
            $url            = $host.$query_string;
            $message        = "Your email registered by Lovvit as a/an ". $application_role_name .", complete your registration here " . $url;

            // Get: member
            $parameters = [];
            $parameters = [ "email_address" => $email ];
            $api_member = $this->credential_model->set_get("member/get_list", $parameters);
            if ( $api_member->http_response_code() == 200 ) {
                if ( $api_member->is_exists() ) {
                    $results = [
                        'status'        => "error",
                        'type'          => 'info',
                        'icon'          => '<i class="fa fa-times-circle"></i>',
                        'btn-type'      => 'btn-danger',
                        'modal-type'    => 'modal-danger',
                        'message'       => "Email has been registered",
                        'message2'      => ''
                    ];
                } else {
                    // Prepare: save member
                    $username   = substr(str_shuffle($this->config->item("encryption_key")), 0, 6);
                    $save_data  = [
                        "full_name"             => $name,
                        "username"              => substr(str_shuffle($this->config->item("encryption_key")), 0, 6),
                        "email_address"         => $email,
                        "phone_number"          => 628,
                        "application_role_name" => "manager",
                        "organization_number"   => $this->session->userdata("org_id")
                    ];
                    // Action: save member
                    $api_save   = $this->credential_model->set_post("member/register", $save_data);
                    
                    // $this->utilities->printr($save_data);
                    // exit();

                    // Action: send invitation by email
                    if ( $api_save->http_response_code() == 200 ) {
                        $from = $this->config->item('smtp_user');
                        $this->email->set_newline("\r\n");
                        $this->email->from($from);
                        $this->email->to($email);
                        $this->email->subject("lovvit invitation");
                        $this->email->message("$message");
    
                        if ($this->email->send()) {
                            $results = [
                                'status'        => "success",
                                'type'          => 'info',
                                'icon'          => '<i class="fa fa-times-circle"></i>',
                                'btn-type'      => 'btn-danger',
                                'modal-type'    => 'modal-danger',
                                'message'       => "Your Email has successfully been sent",
                                'message2'      => ''
                            ];
                        } else {
                            $results = [
                                'status'        => "error",
                                'type'          => 'info',
                                'icon'          => '<i class="fa fa-times-circle"></i>',
                                'btn-type'      => 'btn-danger',
                                'modal-type'    => 'modal-danger',
                                'message'       => show_error($this->email->print_debugger()),
                                'message2'      => ''
                            ];
                        }
                    } else {
                        $results = [
                            'status'        => "error",
                            'type'          => 'info',
                            'icon'          => '<i class="fa fa-times-circle"></i>',
                            'btn-type'      => 'btn-danger',
                            'modal-type'    => 'modal-danger',
                            'message'       => $api_save->get_error_message(),
                            'message2'      => ''
                        ];
                    }
                }
            } else {
                $results = [
                    'status'        => "error",
                    'type'          => 'info',
                    'icon'          => '<i class="fa fa-times-circle"></i>',
                    'btn-type'      => 'btn-danger',
                    'modal-type'    => 'modal-danger',
                    'message'       => $api_application->get_error_message(),
                    'message2'      => ''
                ];
            }
        } else {
            $results = [
                'status'        => "error",
                'type'          => 'info',
                'icon'          => '<i class="fa fa-times-circle"></i>',
                'btn-type'      => 'btn-danger',
                'modal-type'    => 'modal-danger',
                'message'       => validation_errors(),
                'message2'      => ''
            ];
        }

        echo json_encode($results);
    }

    public function member_save() {
        $config         = [
            [
                "field"     => "member_number",
                "rules"     => "required|xss_clean|htmlspecialchars|trim",
                "labels"    => "Member number"
            ],
            [
                "field"     => "access",
                "rules"     => "required|xss_clean|htmlspecialchars|trim",
                "labels"    => "Access"
            ],
        ];
        
        $this->form_validation->set_rules($config);
        
        if ($this->form_validation->run() == TRUE) {
            $member_number  = $this->input->post("member_number");
            $access         = $this->input->post("access");
            
            // Get: organization name
            $organization_name      = "";
            $organization_number    = "";
            $parameters             = [ "organization_number" => $this->session->userdata("org_id") ];
            $api_organization       = $this->credential_model->set_get("organization/get_list", $parameters);
            if ( $api_organization->http_response_code() == 200 ) {
                if ( $api_organization->is_exists() ) {
                    $organization_name      = $api_organization->details("name");
                    $organization_number    = $api_organization->details("organization_number");
                }
            } else {
                $results = [
                    'status'        => "error",
                    'type'          => 'info',
                    'icon'          => '<i class="fa fa-times-circle"></i>',
                    'btn-type'      => 'btn-danger',
                    'modal-type'    => 'modal-danger',
                    'message'       => $api_organization->get_error_message(),
                    'message2'      => ''
                ];
            }


            // Get: member
            $parameters = [ "application_identification" => $this->config->item("app_id") ];
            $api_member = $this->credential_model->set_get("member/get_list", []);
            if ( $api_member->http_response_code() == 200 ) {
                if ( $api_member->is_exists() ) {
                    $member_by_organization_id  = [];
                    foreach ( $api_member->list() as $member ) {
                        foreach ( $member["membership"] as $organization ) {
                            if ( $member["member_number"] == $member_number && $member["is_suspended"] == 0 && $organization["organization_name"] == $organization_name ) $member_by_organization_id = $member;
                        }
                    }

                    if ( !empty($member_by_organization_id) ) {
                        // Get: application role name
                        $api_user_role_list     = $this->credential_model->application_get_role_list();
                        $application_role_name  = "";
                        foreach ( $api_user_role_list as $index => $user_role ) {
                            if ( $access == $index ) $application_role_name = $user_role;
                        }

                        $remove_data    = [ 
                            "member_number"         => $member_by_organization_id["member_number"],
                            "organization_number"   => $organization_number,
                            "role"                  => $member_by_organization_id["membership"][0]["application_role_name"]
                        ];
                        $api_remove = $this->credential_model->set_post("member/remove_membership", $remove_data);
                        
                        if ( $api_remove->http_response_code() == 200 ) {
                            $save_data  = [
                                "member_number"         => $member_by_organization_id["member_number"],
                                "organization_number"   => $organization_number,
                                "role"                  => $application_role_name
                            ];
                            $api_save   = $this->credential_model->set_post("member/apply_membership", $save_data);

                            if ( $api_save->http_response_code() == 200 ) {
                                $results = [
                                    'status'        => "success",
                                    'type'          => 'info',
                                    'icon'          => '<i class="fa fa-times-circle"></i>',
                                    'btn-type'      => 'btn-danger',
                                    'modal-type'    => 'modal-danger',
                                    'message'       => "Updated member",
                                    'message2'      => ''
                                ];
                            }
                        } else {
                            $results = [
                                'status'        => "error",
                                'type'          => 'info',
                                'icon'          => '<i class="fa fa-times-circle"></i>',
                                'btn-type'      => 'btn-danger',
                                'modal-type'    => 'modal-danger',
                                'message'       => $api_remove->get_error_message(),
                                'message2'      => ''
                            ];
                        }
                    } else {
                        $results = [
                            'status'        => "error",
                            'type'          => 'info',
                            'icon'          => '<i class="fa fa-times-circle"></i>',
                            'btn-type'      => 'btn-danger',
                            'modal-type'    => 'modal-danger',
                            'message'       => "Member not found",
                            'message2'      => ''
                        ];
                    }
                } else {
                    $results = [
                        'status'        => "error",
                        'type'          => 'info',
                        'icon'          => '<i class="fa fa-times-circle"></i>',
                        'btn-type'      => 'btn-danger',
                        'modal-type'    => 'modal-danger',
                        'message'       => "Member not found",
                        'message2'      => ''
                    ];
                }
            } else {
                $results = [
                    'status'        => "error",
                    'type'          => 'info',
                    'icon'          => '<i class="fa fa-times-circle"></i>',
                    'btn-type'      => 'btn-danger',
                    'modal-type'    => 'modal-danger',
                    'message'       => $api_member->get_error_message(),
                    'message2'      => ''
                ];
            }
        } else {
            $results = [
                'status'        => "error",
                'type'          => 'info',
                'icon'          => '<i class="fa fa-times-circle"></i>',
                'btn-type'      => 'btn-danger',
                'modal-type'    => 'modal-danger',
                'message'       => validation_errors(),
                'message2'      => ''
            ];
        }

        echo json_encode($results);
    }

    public function member_list_datatable() {
        $data       = [];

        // Get: organization name
        $organization_name  = "";
        $parameters         = [ "organization_number" => $this->session->userdata("org_id") ];
        $api_organization   = $this->credential_model->set_get("organization/get_list", $parameters);
        if ( $api_organization->http_response_code() == 200 ) {
            if ( $api_organization->is_exists() ) {
                $organization_name  = $api_organization->details("name");
            }
        } else {
            $results    = [ "data" => $data ];
        }

        $parameters = [ " application_identification" => $this->config->item("app_id") ];
        $api_member = $this->credential_model->set_get("member/get_list", []);
        if ( $api_member->http_response_code() == 200 ) {
            if ( $api_member->is_exists() ) {
                $member_by_organization_id_list  = [];
                foreach ( $api_member->list() as $member ) {
                    foreach ( $member["membership"] as $organization ) {
                        if ( $member["is_suspended"] == 0 && $organization["organization_name"] == $organization_name ) $member_by_organization_id_list[] = $member;
                    }
                }

                if ( !empty($member_by_organization_id_list) ) {
                    $counter        = 0;
                    foreach ( $member_by_organization_id_list as $member_by_organization_id ) {
                        $delete_button  = "";
                        $update_button  = "";
                        if ( $member_by_organization_id["membership"][0]["application_role_name"] != "owner" ) {
                            $delete_button  =  "<a href='javascript:void(0)' class='btn btn-block btn-light waves-effect waves-light text-danger btn-user-delete' data-member_number='". $member_by_organization_id["member_number"] ."'>Delete</a>";
                            $update_button  = "<a href='javascript:void(0)' class='btn btn-block btn-light waves-effect waves-light text-info' id='btn-user-invitation' data-member_number='". $member_by_organization_id["member_number"] ."'>Edit</a>";
                        }

                        $counter++;
                        // $this->utilities->printr($member_by_organization_id);
                        $data[] = [
                            $counter,
                            ucwords($member_by_organization_id["full_name"]),
                            $member_by_organization_id["email_address"],
                            $member_by_organization_id["is_active"] == 1 ? "<a href='javascript:void(0)' class='text-success'>ACTIVE</a>" : "<a href='javascript:void(0)' class='text-danger'>INACTIVE</a>",
                            ucwords($member_by_organization_id["membership"][0]["application_role_name"]),
                            $update_button,
                            $delete_button
                        ];
                    }
                    $results    = [ "data" => $data ];
                } else {
                    $results    = [ "data" => $data ];
                }
            } else {
                $results    = [ "data" => $data ];
            }
        } else {

        }

        echo json_encode($results);
    }

    public function member_delete($member_number) {
        // Get: organization name
        $parameters             = [ "organization_number" => $this->session->userdata("org_id") ];
        $api_organization       = $this->credential_model->set_get("organization/get_list", $parameters);
        
        $organization_name      = "";
        $organization_number    = "";
        if ( $api_organization->http_response_code() == 200 ) {
            if ( $api_organization->is_exists() ) {
                $organization_name      = $api_organization->details("name");
                $organization_number    = $api_organization->Details("organization_number"); 
            }
        } else {
            $results = [
                'status'        => "error",
                'type'          => 'info',
                'icon'          => '<i class="fa fa-times-circle"></i>',
                'btn-type'      => 'btn-danger',
                'modal-type'    => 'modal-danger',
                'message'       => $api_organization->get_error_message(),
                'message2'      => ''
            ];
        }

        // Get: member
        $parameters = [ "application_identification" => $this->config->item("app_id") ];
        $api_member = $this->credential_model->set_get("member/get_list", []);
        if ( $api_member->http_response_code() == 200 ) {
            if ( $api_member->is_exists() ) {
                $member_by_organization_id  = [];
                foreach ( $api_member->list() as $member ) {
                    foreach ( $member["membership"] as $organization ) {
                        if ( $member["member_number"] == $member_number && $member["is_suspended"] == 0 && $organization["organization_name"] == $organization_name ) $member_by_organization_id = $member;
                    }
                }

                if ( !empty($member_by_organization_id) ) {
                    $save_data  = [
                        "member_number"         => $member_by_organization_id["member_number"],
                        "organization_number"   => $organization_number,
                        "role"                  => $member_by_organization_id["membership"][0]["application_role_name"]
                    ];
                    $api_remove_membership = $this->credential_model->set_post("member/remove_membership", $save_data);
                    
                    if ( $api_remove_membership->http_response_code() == 200 ) {
                        $results = [
                            'status'        => "success",
                            'type'          => 'info',
                            'icon'          => '<i class="fa fa-times-circle"></i>',
                            'btn-type'      => 'btn-danger',
                            'modal-type'    => 'modal-danger',
                            'message'       => "Member deleted",
                            'message2'      => ''
                        ];
                    } else {
                        $results = [
                            'status'        => "error",
                            'type'          => 'info',
                            'icon'          => '<i class="fa fa-times-circle"></i>',
                            'btn-type'      => 'btn-danger',
                            'modal-type'    => 'modal-danger',
                            'message'       => $api_remove_membership->get_error_message(),
                            'message2'      => ''
                        ];
                    }
                } else {
                    $results = [
                        'status'        => "error",
                        'type'          => 'info',
                        'icon'          => '<i class="fa fa-times-circle"></i>',
                        'btn-type'      => 'btn-danger',
                        'modal-type'    => 'modal-danger',
                        'message'       => "Member not found",
                        'message2'      => ''
                    ];
                }
            }
        } else {
            $results = [
                'status'        => "error",
                'type'          => 'info',
                'icon'          => '<i class="fa fa-times-circle"></i>',
                'btn-type'      => 'btn-danger',
                'modal-type'    => 'modal-danger',
                'message'       => $api_organization->get_error_message(),
                'message2'      => ''
            ];
        }

        echo json_encode($results);
    }

    public function member_update() {
        $save_data  = [
            "member_number" => "M-0017",
            "email_address" => "test3@lovvit.id"
            // "full_name"     => "Claudio Canigia",
            // ""
        ];

        $api_save   = $this->credential_model->set_post("member/save", $save_data);
    }

    // public function send_email() {
    //     $from = $this->config->item('smtp_user');
    //     $this->email->set_newline("\r\n");
    //     $this->email->from($from);
    //     $this->email->to("hyclay@gmail.com");
    //     $this->email->subject("test");
    //     $this->email->message("hello!");

    //     if ($this->email->send()) {
    //         echo 'Your Email has successfully been sent.';
    //     } else {
    //         show_error($this->email->print_debugger());
    //     }
    // }
}