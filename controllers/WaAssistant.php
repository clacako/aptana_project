<?php defined('BASEPATH') OR exit('No direct script access allowed');

class WaAssistant extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // $this->authentications->login_requiered();
        $this->load->model("Application_model", "app_model");
    }

    private function _base64_encode_url($string) {
		return str_replace(['+','/','='], ['-','_',''], base64_encode($string));
	}

	private function _base64_decode_url($string) {
		return base64_decode(str_replace(['-','_'], ['+','/'], $string));
	}

    public function index() {
        $data = [];
        $data["page_title"] = "Lovvit - Wa Assistant";
        $data["header"] = "Wa assistant";

        $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
        $parameters         = [ "OrganizationID" => $organization_id ];
        $api_wa_assistant = $this->app_model->set("wa-assistant/list", $parameters);

        $wa_assistants = [];
        if ( $api_wa_assistant->is_exists() ) {
            $wa_assistants = $api_wa_assistant->list();
            if ( !empty($wa_assistants) ) {
                $parameters = [];
                $status_bot = "";
                foreach ($wa_assistants as $index => $wa_assistant) {
                    $parameters = [
                        "botID" => $wa_assistant["BotID"],
                        "botKey" => $wa_assistant["BotKey"]
                    ];
        
                    $api_wa_bot = $this->app_model->wa_bot_api("botCoreStatus", $parameters);
                    if ($api_wa_bot->http_response_code() == 200 ) {
                        $wa_assistants[$index]["status"] = $api_wa_bot->bot_status();
                    }
                }
                
            }
        }
        
        $data["wa_assistants"] = $wa_assistants;
        $this->load->view("wa_assistant/wa_assistant_view", $data);

    }

    public function details($bot_id, $id) {
        $data = [];
        $data["page_title"] = "Lovvit - Wa Assistant";
        
        $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
        $parameters         = [ "OrganizationID" => $organization_id ];
        $api_wa_assistant = $this->app_model->set("wa-assistant/list", $parameters);
        
        $wa_assistant = [];
        if ( $api_wa_assistant->is_exists() ) {
            foreach ($api_wa_assistant->list() as $details) {
                if ( $details["BotID"] == $bot_id ) $wa_assistant = $details;
            }

            if ( !empty($wa_assistant) ) {
                $parameters = [];
                $parameters = [
                    "botID" => $wa_assistant["BotID"],
                    "botKey" => $wa_assistant["BotKey"]
                ];
    
                $api_wa_bot = $this->app_model->wa_bot_api("botCoreStatus", $parameters);
                $wa_assistant["status"] = $api_wa_bot->http_response_code() == 200 ? $api_wa_bot->bot_status() : $api_wa_bot->results("message");
                // $wa_assistant["qr_code_url"] = "bWVudGFyaV8x";
                // $this->utilities->printr($api_wa_bot->results("rData"));
                // exit();

                $data["header"] = !empty($wa_assistant["BotID"]) ? $wa_assistant["BotID"] : "";
                $data["wa_assistant"] = $wa_assistant;
                
                $this->load->view("wa_assistant/details", $data);
            } else {
                $data["header"] = "";
                $this->load->view("wa_assistant/details_no_data_found_view", $data);    
            }
        } else {
            $data["header"] = "";
            $this->load->view("wa_assistant/details_no_data_found_view", $data);    
        }
    }

    public function campaign_auto_reply_datatable($bot_id) {
        $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
        $parameters         = [ "OrganizationID" => $organization_id ];
        $api_wa_assistant   = $this->app_model->set("wa-assistant/list", $parameters);
        
        $data = [];
        if ( $api_wa_assistant->is_exists() ) {
            $wa_assistants = $api_wa_assistant->list();

            $wa_assistant = [];
            foreach ($wa_assistants as $details) {
                if ( $details["BotID"] == $bot_id ) $wa_assistant = $details;
            }
            
            if ( !empty($wa_assistant) ) {
                $parameters = [];
                $parameters = [
                    "BotID" => $wa_assistant["BotID"],
                    "BotKey" => $wa_assistant["BotKey"],
                    "type" => 2
                ];
                
                $api_campaign_auto_reply = $this->app_model->set("wa-assistant/rules-list", $parameters);
               
                if ( $api_campaign_auto_reply->is_exists() ) {
                    $campaign_auto_reply_list = $api_campaign_auto_reply->list();
                    // $this->utilities->printr($campaign_auto_reply_list);
                    // exit();
                    
                    $counter = 0;
                    foreach ($campaign_auto_reply_list as $campaign_auto_reply) {
                        // Campaign status
                        $today = date("Y-m-d");
                        $campaign_start_date = !empty($campaign_auto_reply["CampaignStartDate"]) ? date("Y-m-d", strtotime($campaign_auto_reply["CampaignStartDate"])) : "0000-00-00";
                        $campaign_end_date = !empty($campaign_auto_reply["CampaignEndDate"]) ? date("Y-m-d", strtotime($campaign_auto_reply["CampaignEndDate"])) : "0000-00-00";
                        $campaign_is_active = !empty($campaign_auto_reply["CampaignStatus"]) ? $campaign_auto_reply["CampaignStatus"] : "";
                        if ( ( !empty($campaign_is_active) ) && ($today >= $campaign_start_date && $today <= $campaign_end_date) ) {
                            $font_class = "text-success";
                            $status = "RUNNING";
                        } elseif ( ( !empty($campaign_is_active) ) && ($today <= $campaign_start_date) ) {
                            $font_class = "text-warning";
                            $status= "SCHEDULED";
                        } elseif ( ( !empty($campaign_is_active) ) && ($today >= $campaign_end_date) ) {
                            $font_class = "text-info";
                            $status = "COMPLETED";
                        } else {
                            $font_class = "text-danger";
                            $status = "INACTIVE";
                        }
        
                        // Button
                        $button = $status == "COMPLETED" || $status == "INACTIVE"  ? "<a href='javascript:void(0)' class='btn btn-block btn-light waves-effect waves-light text-danger btn-campaign-auto-reply-delete' data-bot_id='". $bot_id ."' data-id='". $campaign_auto_reply["Id"] ."'> Delete</i></a>" : "";
        
        
                        $counter++;
                        $data[] = [
                            $campaign_auto_reply["IncomingMsg"],
                            $campaign_auto_reply["case_sensitive"],
                            $campaign_auto_reply["rule_pattern"],
                            !empty($campaign_auto_reply["CampaignTitle"]) ? $campaign_auto_reply["CampaignTitle"] : "-",
                            // !empty($campaign_auto_reply["ActionText"]) ? $campaign_auto_reply["ActionText"] : " - ",
                            // !empty($campaign_auto_reply["Parameters"]) ? $campaign_auto_reply["Parameters"] : " - ",
                            // array_key_exists("CampaignStatus", $campaign_auto_reply) ? $campaign_auto_reply["CampaignStatus"] : " - ",
                            "<a href='javascript:void(0)' class='${font_class}'>${status}</a>",
                            $button,
                        ];
                    }
        
                    $results = [ 'data' => $data ];
                } else {
                    $results = [ "data" => $data ];
                }

            } else {
                $results = ['data' => $data];
            }
        } else {
            $results = [ "data" => $data ];
        }

        echo json_encode($results);
    }

    public function text_auto_reply_datatable($bot_id) {
        $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
        $parameters         = [ "OrganizationID" => $organization_id ];
        $api_wa_assistant   = $this->app_model->set("wa-assistant/list", $parameters);

        $data = [];
        if ( $api_wa_assistant->is_exists() ) {
            $wa_assistants = $api_wa_assistant->list();
            
            $wa_assistant = [];
            foreach ($wa_assistants as $details) {
                if ( $details["BotID"] == $bot_id ) $wa_assistant = $details;
            }
            
            $data = [];
            if ( !empty($wa_assistant) ) {
                $parameters = [];
                $parameters = [
                    "BotID" => $wa_assistant["BotID"],
                    "BotKey" => $wa_assistant["BotKey"],
                    "type" => 1
                ];
                $api_text_auto_reply = $this->app_model->set("wa-assistant/rules-list", $parameters);
                $text_auto_reply_list = $api_text_auto_reply->list();
    
                $counter = 0;
                foreach ($text_auto_reply_list as $text_auto_reply) {
                    $counter++;
                    $data[] = [
                        $text_auto_reply["IncomingMsg"],
                        ucwords($text_auto_reply["case_sensitive"]),
                        $text_auto_reply["PaternText"],
                        $text_auto_reply["ReturnMsg"],
                        "<a href='javascript:void(0)' class='btn btn-block btn-light waves-effect waves-light text-info' id='btn-text-auto-reply' data-bot_id='". $bot_id ."' data-id='". $text_auto_reply["Id"] ."'>
                            Edit
                         </a>",
                        "<a href='javascript:void(0)' class='btn btn-block btn-light waves-effect waves-light text-danger btn-text-auto-reply-delete' data-bot_id='". $bot_id ."'  data-id='". $text_auto_reply["Id"] ."'>
                            Delete
                         </a>"
                    ];
                }
    
                $results = ['data' => $data];
            } else {
                $results = ['data' => $data];
            }
        } else {
            $results = [ "data" => $data ];
        }

        echo json_encode($results);
    }

    public function qr_code($bot_id) {
        $data = [];
        $data["page_title"] = "Lovvit - Wa Assistant";
        $data["header"]     = "Wa assistant";
        $data["message"]    = "";

        $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
        $parameters         = [ "OrganizationID" => $organization_id ];
        $api_wa_assistant = $this->app_model->set("wa-assistant/list", $parameters);

        $wa_assistants = [];
        if ( $api_wa_assistant->is_exists() ) {
            $wa_assistants = $api_wa_assistant->list();
            if ( !empty($wa_assistants) ) {
                $parameters     = [];
                $wa_assistant   = [];
                foreach ($wa_assistants as $index => $details) {
                    if ( $details["BotID"] ) $wa_assistant = $details;
                }

                $parameters = [    
                    "botID" => $wa_assistant["BotID"],
                    "botKey" => $wa_assistant["BotKey"]
                ];
                $api_wa_bot = $this->app_model->wa_bot_api("botCoreStatus", $parameters);

                if ( $api_wa_bot->http_response_code() == 200 ) {
                    if ( $api_wa_bot->bot_status() == "Online" ) {
                        $qrcode_str = $api_wa_bot->results("rData")["qrString"];
                        $file_name          = md5($qrcode_str);
                        $params['data']     = $qrcode_str;
                        $params['level']    = 'H';
                        $params['size']     = 6;
                        $params['savename'] = FCPATH.'qr_code/'. $file_name .'.png';
                        $this->ciqrcode->generate($params);
                        $data["bot_status"] = $api_wa_bot->bot_status();
                        $data["qr_str"]     = $qrcode_str;
                        $data["file_name"]  = $file_name;
                    }

                    if ( $api_wa_bot->bot_status() == "Offline" ) {
                        $data["bot_status"] = $api_wa_bot->bot_status();
                        $data["message"]    = "The bot is offline";
                        // $this->load->view("wa_assistant/modal_qr_code", $data);
                    } 
        
                    if ( $api_wa_bot->bot_status() == "Connected" ) {
                        $data["bot_status"] = $api_wa_bot->bot_status();
                        $data["message"]   = "Connected";
                        
                        // $this->load->view("wa_assistant/modal_qr_code", $data);
                    }
                    // $this->utilities->printr($data);
                }
            } else {
                $data   = [ "message" => "No data found" ];
                // $this->load->view("wa_assistant/modal_qr_code_offline", $data);
            }
        } else {
            $data   = [ "message" => "No data found" ];
        }
       
        $this->load->view("wa_assistant/modal_qr_code", $data);
    }
    

    public function qr_code_debug() {
        $url = "http://178.128.217.224:3033/scan/qr/bWVrdGFyaV8x";

        $parameters = [
            "botID" => $wa_assistant["BotID"],
            "botKey" => $wa_assistant["BotKey"]
        ];

        $api_wa_bot = $this->app_model->wa_bot_api("botCoreStatus", $parameters);
    }

    public function bot_turn_on($bot_id) {
        $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
        $parameters         = [ "OrganizationID" => $organization_id ];
        $api_wa_assistant = $this->app_model->set("wa-assistant/list", $parameters);
        
        
        if ($api_wa_assistant->is_exists()) {
            $wa_assistants = $api_wa_assistant->list();
            
            $wa_assistant = [];
            foreach ($wa_assistants as $details) {
                if ( $details["BotID"] == $bot_id ) $wa_assistant = $details;
            }
            
            if ( !empty($wa_assistant) ) {
                $parameters = [];
                $parameters = [
                    "botID" => $wa_assistant["BotID"],
                    "botKey" => $wa_assistant["BotKey"]
                ];
                // $this->utilities->printr($parameters);
                // exit();

                $api_wa_bot = $this->app_model->wa_bot_api("activateBot", $parameters);

                if ( $api_wa_bot->http_response_code() == 200 ) {
                    $result = [
                        'status' => "success",
                        'type' => 'success',
                        'message' => $api_wa_bot->results("message") . ", this page will reload",
                        'message2' => ""
                    ];
                } else {
                    $result = [
                        'status' => "error",
                        'type' => 'danger',
                        'message' => $api_wa_bot->results("message"),
                        'message2' => ""
                    ];
                }
            } else {
                $result = [
                    'status' => "error",
                    'type' => 'danger',
                    'message' => "Data not found",
                    'message2' => ""
                ];
            }
        } else {
            $result = [
                'status' => "error",
                'type' => 'danger',
                'message' => "Data not found",
                'message2' => ""
            ];
        }

        echo json_encode($result);
    }

    public function bot_turn_off($bot_id) {
        $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
        $parameters         = [ "OrganizationID" => $organization_id ];
        $api_wa_assistant = $this->app_model->set("wa-assistant/list", $parameters);
        
        if ($api_wa_assistant->is_exists()) {
            $wa_assistants = $api_wa_assistant->list();
            
            $wa_assistant = [];
            foreach ($wa_assistants as $details) {
                if ( $details["BotID"] == $bot_id ) $wa_assistant = $details;
            }
            
            if ( !empty($wa_assistant) ) {
                $parameters = [];
                $parameters = [
                    "botID" => $wa_assistant["BotID"],
                    "botKey" => $wa_assistant["BotKey"]
                ];
                // $this->utilities->printr($parameters);
                // exit();

                $api_wa_bot = $this->app_model->wa_bot_api("turnOffBot", $parameters);

                if ( $api_wa_bot->http_response_code() == 200 ) {
                    $result = [
                        'status' => "success",
                        'type' => 'success',
                        'message' => $api_wa_bot->results("message") . ", this page will reload",
                        'message2' => ""
                    ];
                } else {
                    $result = [
                        'status' => "error",
                        'type' => 'danger',
                        'message' => $api_wa_bot->results("message"),
                        'message2' => ""
                    ];
                }
            } else {
                $result = [
                    'status' => "error",
                    'type' => 'danger',
                    'message' => "Data not found",
                    'message2' => ""
                ];
            }
        } else {
            $result = [
                'status' => "error",
                'type' => 'danger',
                'message' => "Data not found",
                'message2' => ""
            ];
        }

        echo json_encode($result);
    }

    public function modal_text_auto_reply($bot_id, $id=0) {
        $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
        $parameters         = [ "OrganizationID" => $organization_id ];
        $api_wa_assistant = $this->app_model->set("wa-assistant/list", $parameters);

        $patterns = [
            1   => "Exactly",
            2   => "Include",
            3   => "Start Of",
            4   => "End Of",
            5   => "Include OR",
            6   => "Include AND"
        ];

        $data               = [];
        $data["id"]         = (int)$id;
        $data["bot_id"]     = $bot_id;
        $data["patterns"]   = $patterns;
        
        if ( $api_wa_assistant->is_exists() ) {
            $wa_assistants = $api_wa_assistant->list();
            
            $wa_assistant = [];
            foreach ($wa_assistants as $details) {
                if ( $details["BotID"] == $bot_id ) $wa_assistant = $details;
            }

            if ( !empty($wa_assistant) ) {
                $parameters = [];
                $parameters = [
                    "BotID"     => $wa_assistant["BotID"],
                    "BotKey"    => $wa_assistant["BotKey"],
                    "type"      => 1,
                ];
                $api_text_auto_reply = $this->app_model->set("wa-assistant/rules-list", $parameters);
                $text_auto_reply_list = $api_text_auto_reply->list();

                $details = [];
                foreach ( $text_auto_reply_list as $text_auto_reply ) {
                    if ( $text_auto_reply["Id"] == $id ) $details = $text_auto_reply;
                }
            
                $data["text_auto_reply"] = $details;
                // $this->utilities->printr($details);
                // exit();
            }
        }

        $this->load->view("wa_assistant/modal_text_auto_reply", $data); 
    }

    public function text_auto_reply_save() {
         $config = [
            [
                "field" => "bot_id",
                "rules" => "required|xss_clean|htmlspecialchars|trim",
                "label" => "Bot ID"
            ],
            [
                "field" => "keyword_trigger",
                "rules" => "required|xss_clean|htmlspecialchars|trim",
                "label" => "Keyword trigger"
            ],
            [
                "field" => "pattern",
                "rules" => "required|xss_clean|htmlspecialchars|trim",
                "label" => "Pattern"
            ],
            [
                "field" => "reply_text",
                "rules" => "required|xss_clean|htmlspecialchars|trim",
                "label" => "Reply text"
            ],
        ];
        $this->form_validation->set_rules($config);
        
        if ( $this->form_validation->run() == TRUE ) {
            $bot_id                 = $this->input->post("bot_id");
            $type                   = $this->input->post("type");
            $keyword_trigger        = $this->input->post("keyword_trigger");
            $case_sensitive         = $this->input->post("case_sensitive");
            $pattern                = $this->input->post("pattern");
            $reply_text             = $this->input->post("reply_text");
            
            $case_sensitive_rule    = !empty($case_sensitive) && $case_sensitive == "on" ? 1 : 2;
            // $this->utilities->printr($pattern);
            // exit();

            $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
            $parameters         = [ "OrganizationID" => $organization_id ];
            $api_wa_assistant   = $this->app_model->set("wa-assistant/list", $parameters);

            if ($api_wa_assistant->is_exists()) {
                $wa_assistants = $api_wa_assistant->list();
                
                $wa_assistant = [];
                foreach ($wa_assistants as $details) {
                    if ( $details["BotID"] == $bot_id ) $wa_assistant = $details;
                }

                if ( !empty($wa_assistant) ) {
                    $parameters = [];
                    $parameters = [
                        "id_bot"                => $wa_assistant["id"],
                        "case_sensitive"        => $case_sensitive_rule,
                        "pattern"               => $pattern,
                        "keyword_trigger"       => $keyword_trigger,
                        "reply_message"         => $reply_text,
                        "organization_number"   => $this->session->userdata("org_id")
                        // ruleType is predefined in HQ API
                    ];
                    // // **
                    // // parameters to hit WA Bot (Text Auto Reply versi lama. sebelum Mei 2021)
                    // $parameters = [
                    //     "botID"             => $wa_assistant["BotID"],
                    //     "botKey"            => $wa_assistant["BotKey"],
                    //     "ruleType"          => 1,
                    //     "incomingMsg"       => $keyword_trigger,
                    //     "isCaseSensitive"   => $case_sensitive_rule,
                    //     "rulePatern"        => $pattern,
                    //     "replayMsg"         => $reply_text
                    // ];
                    
                    // **
                    // hit api Lovvit HQ to save TextAutoReply
                    $api_wa_bot = $this->app_model->set("wa-assistant/text-auto-reply/save", $parameters);
                    
                    // **
                    // hit api wa bot
                    // $api_wa_bot = $this->app_model->wa_bot_api("createRules", $parameters);

                    if ( $api_wa_bot->http_response_code() == 200 ) {
                        $result = [
                            'status' => "success",
                            'type' => 'success',
                            'message' => $api_wa_bot->results("message"),
                            'message2' => ""
                        ];
                    } else {
                        $result = [
                            'status' => "error",
                            'type' => 'danger',
                            'message' => $api_wa_bot->results("message"),
                            'message2' => ""
                        ];
                    }
                } else {
                    $result = [
                        'status' => "error",
                        'type' => 'danger',
                        'message' => "Data not found",
                        'message2' => ""
                    ];
                }
            } else {
                $result = [
                    'status' => "error",
                    'type' => 'danger',
                    'message' => "Data not found",
                    'message2' => ""
                ];
            }
        } else {
            $result = [
                'status' => "error",
                'type' => 'danger',
                'message' => validation_errors(),
                'message2' => ""
            ];
        }

        echo json_encode($result);
    }

    public function text_auto_reply_update() {
        $config = [
            [
                "field" => "id",
                "rules" => "required|xss_clean|htmlspecialchars|trim",
                "label" => "ID"
            ],
            [
                "field" => "bot_id",
                "rules" => "required|xss_clean|htmlspecialchars|trim",
                "label" => "Bot ID"
            ],
            [
                "field" => "keyword_trigger",
                "rules" => "required|xss_clean|htmlspecialchars|trim",
                "label" => "Keyword trigger"
            ],
            [
                "field" => "pattern",
                "rules" => "required|xss_clean|htmlspecialchars|trim",
                "label" => "Pattern"
            ],
            [
                "field" => "reply_text",
                "rules" => "required|xss_clean|htmlspecialchars|trim",
                "label" => "Reply text"
            ],
        ];
        $this->form_validation->set_rules($config);
        
        if ( $this->form_validation->run() == TRUE ) {
            $id                     = $this->input->post("id");
            $bot_id                 = $this->input->post("bot_id");
            $type                   = $this->input->post("type");
            $keyword_trigger        = $this->input->post("keyword_trigger");
            $case_sensitive         = $this->input->post("case_sensitive");
            $pattern                = $this->input->post("pattern");
            $reply_text             = $this->input->post("reply_text");
            
            $case_sensitive_rule    = !empty($case_sensitive) && $case_sensitive == "on" ? 1 : 2;
            // $this->utilities->printr($pattern);
            // exit();
            
            $rule_type  = 0;
            if ( $type == "Text" ) $rule_type = 1;
            if ( $type == "Api" ) $rule_type = 2;

            $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
            $parameters         = [ "OrganizationID" => $organization_id ];
            $api_wa_assistant   = $this->app_model->set("wa-assistant/list", $parameters);

            if ($api_wa_assistant->is_exists()) {
                $wa_assistants = $api_wa_assistant->list();
                
                $wa_assistant = [];
                foreach ($wa_assistants as $details) {
                    if ( $details["BotID"] == $bot_id ) $wa_assistant = $details;
                }
               

                if ( !empty($wa_assistant) ) {
                    $parameters = [];
                    $parameters = [
                        "BotID" => $wa_assistant["BotID"],
                        "BotKey" => $wa_assistant["BotKey"],
                        "type" => 1
                    ];
                    $api_text_auto_reply        = $this->app_model->set("wa-assistant/rules-list", $parameters);
                    $api_text_auto_reply_list   = $api_text_auto_reply->list();

                    $details = [];
                    foreach ( $api_text_auto_reply_list as $api_text_auto_reply ) {
                        if ( $api_text_auto_reply["Id"] == (int)$id ) $details = $api_text_auto_reply;
                    }
                    // $this->utilities->printr($details);
                    // exit();

                    $parameters = [];
                    $parameters = [
                        "botID"             => $wa_assistant["BotID"],
                        "botKey"            => $wa_assistant["BotKey"],
                        "ruleID"            => $details["Id"],
                        "ruleType"          => 1,
                        "incomingMsg"       => $keyword_trigger,
                        "isCaseSensitive"   => $case_sensitive_rule,
                        "rulePatern"        => $pattern,
                        "replayMsg"         => $reply_text
                    ];
                    
                    $api_wa_bot = $this->app_model->wa_bot_api("updateRules", $parameters);

                    if ( $api_wa_bot->http_response_code() == 200 ) {
                        $result = [
                            'status' => "success",
                            'type' => 'success',
                            'message' => $api_wa_bot->results("message"),
                            'message2' => ""
                        ];
                    } else {
                        $result = [
                            'status' => "error",
                            'type' => 'danger',
                            'message' => $api_wa_bot->results("message"),
                            'message2' => ""
                        ];
                    }
                } else {
                    $result = [
                        'status' => "error",
                        'type' => 'danger',
                        'message' => "Data not found",
                        'message2' => ""
                    ];
                }
            } else {
                $result = [
                    'status' => "error",
                    'type' => 'danger',
                    'message' => "Data not found",
                    'message2' => ""
                ];
            }
        } else {
            $result = [
                'status' => "error",
                'type' => 'danger',
                'message' => validation_errors(),
                'message2' => ""
            ];
        }

        echo json_encode($result);
    }

    public function campaign_auto_reply_delete($bot_id, $id) {
        $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
        $parameters         = [ "OrganizationID" => $organization_id ];
        $api_wa_assistant   = $this->app_model->set("wa-assistant/list", $parameters);

        if ($api_wa_assistant->is_exists()) {
            $wa_assistants = $api_wa_assistant->list();
            
            $wa_assistant = [];
            foreach ($wa_assistants as $details) {
                if ( $details["BotID"] == $bot_id ) $wa_assistant = $details;
            }

            if ( !empty($wa_assistant) ) {
                $parameters = [];
                $parameters = [
                    "botID"     => $wa_assistant["BotID"],
                    "botKey"    => $wa_assistant["BotKey"],
                    "ruleID"    => (int)$id,
                    "type"      => 2
                ];
                $api_campaign_auto_reply = $this->app_model->set("wa-assistant/rules-delete", $parameters);
                // $this->utilities->printr($api_campaign_auto_reply);
                // exit();

                if ( $api_campaign_auto_reply ) {
                    $result = [
                        'status' => "success",
                        'type' => 'success',
                        'message' => "",
                        'message2' => ""
                    ];
                } else {
                    $result = [
                        'status' => "error",
                        'type' => 'danger',
                        'message' => "Error",
                        'message2' => ""
                    ];
                }

                // if ( $api_campaign_auto_reply->get_http_response_code() == 200 ) {
                //     $result = [
                //         'status' => "success",
                //         'type' => 'success',
                //         'message' => "",
                //         'message2' => ""
                //     ];
                // } else {
                //     $result = [
                //         'status' => "error",
                //         'type' => 'danger',
                //         'message' => $api_campaign_auto_reply->get_error_message(),
                //         'message2' => ""
                //     ];
                // }
            } else {
                $result = [
                    'status' => "error",
                    'type' => 'danger',
                    'message' => "Data not found",
                    'message2' => ""
                ];
            }
        } else {
            $result = [
                'status' => "error",
                'type' => 'danger',
                'message' => "Data not found",
                'message2' => ""
            ];
        }

        echo json_encode($result);
    }

    public function text_auto_reply_delete($bot_id, $id) {
        $organization_id    = $this->_base64_encode_url($this->session->userdata("org_id"));
        $parameters         = [ "OrganizationID" => $organization_id ];
        $api_wa_assistant = $this->app_model->set("wa-assistant/list", $parameters);

        if ($api_wa_assistant->is_exists()) {
            $wa_assistants = $api_wa_assistant->list();
            
            $wa_assistant = [];
            foreach ($wa_assistants as $details) {
                if ( $details["BotID"] == $bot_id ) $wa_assistant = $details;
            }

            if ( !empty($wa_assistant) ) {
                $parameters = [];
                $parameters = [
                    "botID"     => $wa_assistant["BotID"],
                    "botKey"    => $wa_assistant["BotKey"],
                    "ruleID"    => (int)$id,
                    "type"      => 1
                ];
                $api_text_auto_reply = $this->app_model->set("wa-assistant/rules-delete", $parameters);

                if ( $api_text_auto_reply->get_http_response_code() == 200 ) {
                    $result = [
                        'status' => "success",
                        'type' => 'success',
                        'message' => "",
                        'message2' => ""
                    ];
                } else {
                    $result = [
                        'status' => "error",
                        'type' => 'danger',
                        'message' => $api_text_auto_reply->get_error_message(),
                        'message2' => ""
                    ];
                }
            } else {
                $result = [
                    'status' => "error",
                    'type' => 'danger',
                    'message' => "Data not found",
                    'message2' => ""
                ];
            }
        } else {
            $result = [
                'status' => "error",
                'type' => 'danger',
                'message' => "Data not found",
                'message2' => ""
            ];
        }

        echo json_encode($result);
    }

}