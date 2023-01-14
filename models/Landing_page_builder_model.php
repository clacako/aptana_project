<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing_page_builder_model extends CI_Model {

	public function __construct() {
		$this->load->library("LovvitEngine");
		$this->load->model("Application_model", "app_model");
	}

	function campaign_get_list()
	{
		try {
			$data = [];
			$organization_id = base64_encode_url($this->session->userdata("org_id"));
			$parameters = [ "OrganizationID" => $organization_id ];
			$api_campaign = $this->app_model->set("campaign_get_list", $parameters);
			$campaign_list = $api_campaign->is_exists() ? $api_campaign->list() : "";
			return $campaign_list;
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	// **
	// return an array filled only with currently-evaluated-layout
	function filter_layout_list(array $layout_list, $layout)
	{
		$temp = array();
		foreach ($layout_list as $key => $value) {
			if (strpos($value, $layout) !== false) {
				array_push($temp, $value);
			}
		}
		return $temp;
	}

	function page_builder_save($post,$images)
	{
		try {
			// **
			// get organization details
			$parameters = [ "organization_number" => $this->session->userdata("org_id") ];
			$api_organization = $this->credential_model->set_get("organization/get_list", $parameters);
			$organization_information_details = json_decode($api_organization->details("organization_details"), True);
			$unique_id = $organization_information_details['mid'] ?? $organization_information_details['merchant_id'];

			// ** **//
			// preprocess post, and images
			// ** **//

			// **
			// variable to contain processed variables
			$section_list = array();

			// **
			// get layout list, and cast it to array
			$layout_list = explode(",", $post['layout_order']);

			// **
			// for every layout in layout_list, check array on $post
			foreach ($layout_list as $layout_item) {
				// **
				// get layout number
				$temp = explode("_", $layout_item);
				$index = end($temp);

				// **
				// get layout name (without index) to test array key
				$layout_index = array_pop($temp);
				$layout = implode("_", $temp);

				// **
				// temporary array container
				$temp = array();
				$temp['layout_index'] = $index;

				// **
				// upload image
				if (!empty($images)) {
					if (!empty($images[$layout."_image"]['name']) && !empty($images[$layout."_image"]['name'][$index-1])) {
						$image_index = $index-1;

						// **
						// upload settings
						$config['upload_path'] = "";
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size']  = 2500000; // in byte
						$config['max_width']  = '1020';
						$config['max_height']  = '1020';
						$config['upload_to_space'] = 1;

						// **
						// constructing new filename
						$imageFile = $config['upload_path'].basename($images[$layout."_image"]["name"][$index-1]);
						$imageFileType = strtolower(pathinfo($imageFile, PATHINFO_EXTENSION));
						$config['file_name'] = "{$layout}_{$unique_id}_{$index}.{$imageFileType}";

						$uploaded_image = $this->upload_image($images[$layout."_image"],$config,$image_index);
						if(!empty($uploaded_image)) $post[$layout.'_image'][$image_index] = $uploaded_image;
					}
				}

				// **
				// evaluate every key in array $post
				foreach ($post as $key => $value) {
					// **
					// if the key is not started with layout_name, skip it
					if (!empty(explode("${layout}_", $key)[0])) {
						continue;
					}

					// **
					// if layout currently evaluated is a 'custom_link', and there's a 'menu_item' in the key
					// check the index of the key, if it's same with index of layout, put it into $temp
					if ( ($layout == "custom_link") && (strpos($key, "menu_item_") !== false) ) {
						if (!isset($temp["menu_item"])) {
							$temp["menu_item"] = array();
							// $temp["menu_item"]["count"] = count($post[$key]);
						}
						$temp_key_menu_item = explode("_", $key);
						if (end($temp_key_menu_item) != $index) continue;
						// **
						// evaluate every value of button id to remove the space if any
						foreach ($post[$key] as &$button_id_value) {
							$button_id_value = implode("", explode(" ", $button_id_value));
						}
						$temp["menu_item"][$key] = $post[$key];
					}
					// **
					// if layout currently evaluated is a 'whatsapp_coupon_widget', and there's a 'whatsapp_coupon_widget_item_' in the key
					// check the index of the key, if it's same with index of layout, put it into $temp
					elseif ( ($layout == "whatsapp_coupon_widget") && (strpos($key, "whatsapp_coupon_widget_item_") !== false) ) {
						if (!isset($temp["widget_item"])) {
							$temp["widget_item"] = array();
							$temp["widget_item"]["count"] = count($post[$key]);
						}
						$temp_key_menu_item = explode("_", $key);
						if (end($temp_key_menu_item) != $index) continue;
						$temp["widget_item"][$key] = $post[$key];
					}
					// **
					// preprocessing for contacts_icon_platform
					// if integer quotient of key of the contacts_icon_platform by 5 + 1 is same with layout index, then insert it
					// * since there are five default platform
					elseif ( ($layout == "contacts_icon") && ($key == "contacts_icon_platform")) {
						if (!isset($temp["contacts_icon_platform"])) $temp["contacts_icon_platform"] = array();
						foreach ($value as $key => $platform) {
							$temp_index = intdiv($key, 5)+1;
							if ($temp_index != $index) continue;
							$temp["contacts_icon_platform"][] = $platform;
						}
					} 
					else {
						// **
						// if no 'menu_item' or 'contact_icon' in the key, (like custom_link_header_text, or brand_profile_show_brand_id)
						// check if it's an array. and if yes, get the value based on nth position of the layout
						$layout_nth_position = array_search("${layout}_${index}", $this->filter_layout_list($layout_list,$layout));
						if (is_array($post[$key]) && isset($value[$layout_nth_position])) {
							$temp[$key] = $value[$layout_nth_position];
							// $temp[$key] = $post[$key][$index-1];
						} else {
							// **
							// if it's not array, check the index of the key. if it's same with currently evaluated index layout, put into $temp
							$x = explode("_", $key);
							if (end($x) == $index) $temp[$key] = $value;
						}
					}
				}
				$section_list[$layout_item] = $temp;
			}
			// **
			// create array to contain all values
			$save = array();
			$save['raw_input'] = $post;
			$save['section_list'] = $section_list;

			// ** **//
			// hit api to save configuration
			// ** **//
			$data['organization_id'] = $this->session->userdata("org_id");
			$data['configuration'] = $save;
			
			$parameters = json_encode($data);
			$api_coupon_code_save = $this->app_model->set("page-builder/save", $parameters, "page_builder_config_save");
			// ** **//
			// end of hit api to save configuration //
			// ** **//

			return json_encode($save);
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	function page_builder_get_config($organization_id)
	{
		try {
			// **
			// filters
			$filters = array();
			$filters['organization_id'] = $organization_id;
			$page_builder_config = $this->app_model->set("page-builder/get", $filters);

			if ( $page_builder_config->get_http_response_code() == 200 ) {
				$page_builder_config   = $page_builder_config->list();
				return $page_builder_config;
			}
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

	function upload_image($file, array $UserConfig, $image_index = null)
	{
		$config = array();
		$config = $UserConfig;
		$config['allowed_types'] = explode("|", $UserConfig['allowed_types']);

		try {
			// **
			// Check if image file is a actual image or fake image
			$file["tmp_name"] = !is_null($image_index) ? $file["tmp_name"][$image_index] : $file["tmp_name"];
			$check = getimagesize($file["tmp_name"]);
			if (!$check) {
				throw new Exception('File is not an image');
			}

			// // **
			// // if file exists delete any files related to id
			// if (file_exists($imageFile)) {
			//  array_map('unlink', glob("{$upload_path}/{$file_name}*"));
			// }

			// **
			// Check file size
			$file["size"] = !is_null($image_index) ? $file["size"][$image_index] : $file["size"];
			if ($file["size"] > $config['max_size']) {
				throw new Exception('File image is too big');
			}

			// **
			// Allow certain file formats
			$file["name"] = !is_null($image_index) ? $file["name"][$image_index] : $file["name"];
			$imageFileType = strtolower(pathinfo(basename($file["name"]), PATHINFO_EXTENSION));
			if (!in_array($imageFileType, $config['allowed_types'])) {
				throw new Exception('Only jpg, jpeg, png, and gif files are allowed');
			}

			// **
			// check dimension
			$temp = getimagesize($file["tmp_name"]);
			$actualwidth = $temp[0];
			$actualheight = $temp[1];

			// if($actualwidth > $config['max_width'] || $actualheight > $config['max_height']){
			// 	throw new Exception("Image size is not met. {$actualwidth}x{$actualheight}. should be {$config['max_width']}x{$config['max_height']}");
			// }

			// **
			// move files to server
			// either local server, or Space; depends on config
			if (!empty($config['upload_to_space'])) {
				$file["type"] = !is_null($image_index) ? $file["type"][$image_index] : $file["type"];
				// $image = 'path/to/image.jpg';
				// $image_mime = image_type_to_mime_type(exif_imagetype($image));
				
				// **
				// upload to Space
				$space_connect = new Space();
				$result = $space_connect->space->UploadFile($file['tmp_name'], "public", $config['file_name'], $file['type']);
				if ($result['@metadata']['statusCode'] == 200) {
					return $result['@metadata']['effectiveUri'];
				} else {
					throw new Exception('Error uploading your image');
				}
			} else {
				if (!move_uploaded_file($file["tmp_name"], $config['upload_path'].$config['file_name'])) {
					throw new Exception('Error uploading your image');
				}
				return $config['upload_path'].$config['file_name'];
			}
		} catch (Exception $e) {
			throw new Exception($e->getMessage());
		}
	}

}

/* End of file Landing_page_builder_model.php */
/* Location: ./application/models/Landing_page_builder_model.php */