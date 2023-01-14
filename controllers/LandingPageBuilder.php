<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LandingPageBuilder extends CI_Controller {

	private $redirect_to_page = "login";

	public function __construct()
	{
		parent::__construct();
		// $this->authentications->login_required();

		// **
		// load model
		$this->load->model('Landing_page_builder_model','model');
		$this->load->model("Application_model", "app_model");
	}

	private function _base64_encode_url($string) {
		return str_replace(['+','/','='], ['-','_',''], base64_encode($string));
	}

	private function _base64_decode_url($string) {
		return base64_decode(str_replace(['-','_'], ['+','/'], $string));
	}

	public function index()
	{
		$data['page_title'] = "Landing page builder";
		$data['header'] = ucwords("brand landing page");

		// Get: organization
		$parameters         = [ "organization_number" => $this->session->userdata("org_id") ];
		$api_organization   = $this->credential_model->set_get("organization/get_list", $parameters);

		if ( $api_organization->http_response_code() == 200 ) {
			if ( $api_organization->is_exists() ) {
				// Set: brand url landing page
				$organization_	= json_decode($api_organization->details("organization_details"), True);
				$data["brand_url"]	= $organization_["brand_url"];
			}
		}

		$this->load->view('landing_page/landing_page_builder', $data ?? null);
	}

	function page_builder_save()
	{
		try {
			$post = $this->input->post();
			$images = $_FILES;

			if (!isset($post['save_changes'])) {
				redirect($this->redirect_to_page,'refresh');
			}

			$page_builder_save = $this->model->page_builder_save($post,$images);
			// expected return: {"status":200,"result":"Page builder config saved"}
			
			// **
			// show success notification
			$this->authentications->set_session_flashdata("Save success", "success");
			redirect("LandingPageBuilder");
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	function load_dashboard_content()
	{
		// **
		// check if it's ajax request
		if (!$this->input->is_ajax_request()) {
			redirect($this->redirect_to_page,'refresh');
		}

		// **
		// do action
		try {
			// **
			// load dashboard view file
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
					$organization_	= json_decode($api_organization->details("organization_details"), True);
					if ( !isset($organization_["brand_url"]) ) {
						$this->load->view("dashboard_page_builder_error_view");
					} else {
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
					}
				} else {
					# code: not exist
				}
			} else {
				# code: response code != 200
			}
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	function load_design_content()
	{
		// **
		// check if it's ajax request
		if (!$this->input->is_ajax_request()) {
			redirect($this->redirect_to_page,'refresh');
		}

		// **
		// do action
		try {
			// **
			// variable used in form creation
			$data['submit_url'] = "builder/submit";

			// **
			// get json page builder
			$organization_id = $this->session->userdata("org_id");
			$json_page_builder = $this->model->page_builder_get_config($organization_id);
			$data['json_page_builder'] = json_decode($json_page_builder,true);
			$data['campaign_list'] = $this->model->campaign_get_list();

			// **
			// load dashboard view file
			$view_file = "landing_page_builder__design";
			$this->load->view("landing_page/{$view_file}", $data ?? null, FALSE);
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	public function load_report_content() {
		$data		= [];

		// Get: activity
        $parameters         = [ "organization_number" => $this->session->userdata("org_id") ];
		$api_activities		= $this->app_model->set("landing-page-activity/get", $parameters);

		if ( $api_activities->get_http_response_code() != 200 ) {
			# error code here
		}

		$activities					= $api_activities->list();
		$activities_by_tracker_id	= [];

		foreach ($activities as $activity) {
			$activities_by_tracker_id[$activity["TrackerID"]][]	= $activity;
		}

		$visit_landing_page_activities	= [];	
		$custom_link_activities			= [];
		$contact_activities_			= [];
		$tracker_contact_list			= [ "contact-icon-instagram", "contact-icon-phone", "contact-icon-facebook", "contact-icon-website", "contact-icon-email" ];
		$tracker_landing_page_list		= [ "home", "about us" ];

		foreach ($activities_by_tracker_id as $tracker => $activity) {
			if ( in_array($tracker, $tracker_landing_page_list) ) $visit_landing_page_activities[$tracker]											= $activity;
			if ( !in_array($tracker, $tracker_contact_list) && !in_array($tracker, $tracker_landing_page_list) ) $custom_link_activities[$tracker]	= $activity;
			if ( in_array($tracker, $tracker_contact_list) && !in_array($tracker, $tracker_landing_page_list) ) $contact_activities_[$tracker]		= $activity;

		}

		$text_list			= [ "contact", "icon", "-"  ];
		$text_replace_list	= [ "", "", "" ];
		$contact_activities	= [];

		foreach ($contact_activities_ as $tracker => $activity) {
			$tracker	= str_replace($text_list, $text_replace_list, $tracker);
			$contact_activities[$tracker]	= $activity;
		}
		
		$data["visit_landing_page_activities"]	= $visit_landing_page_activities;
		$data["custom_link_activities"]			= $custom_link_activities;
		$data["contact_activities"]				= $contact_activities;

		// $this->utilities->printr(count($custom_link_activities["Facebook"]));
		$this->load->view("landing_page/report_view", $data);
	}

	function get_card()
	{
		if (!$this->input->is_ajax_request()) {
			redirect($this->redirect_to_page,'refresh');
		}

		$get = $this->input->get();
		if (empty($get['card_to_get'])) {
			exit;
		}

		$card = "layout_card__{$get['card_to_get']}";
		$this->load->view("landing_page/layout_cards/{$card}", $data ?? null, FALSE);
	}

	function get_custom_link_menu_item()
	{
		if (!$this->input->is_ajax_request()) {
			redirect($this->redirect_to_page,'refresh');
		}

		$card = "menu_item__custom_link";
		$data['index'] = $this->input->get('index');
		$this->load->view("landing_page/layout_cards/{$card}", $data ?? null, FALSE);
	}

	function get_whatsapp_widget_item()
	{
		if (!$this->input->is_ajax_request()) {
			redirect($this->redirect_to_page,'refresh');
		}

		$card = "item__whatsapp_widget";
		$data['index'] = $this->input->get('index');
		$data['campaign_list'] = $this->model->campaign_get_list();
		$this->load->view("landing_page/layout_cards/{$card}", $data ?? null, FALSE);
	}
}

/* End of file LandingPageBuilder.php */
/* Location: ./application/controllers/LandingPageBuilder.php */