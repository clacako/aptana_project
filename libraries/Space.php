<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
include_once APPPATH.'/third_party/spaces/spaces.php';
 
class Space {

    public $space;
 
    public function __construct()
    {
        $key = "5QX7CUT5CXQYZXMGV6EU";
        $secret = "3K4IdSUFogF4VRDp6PDDfHAw6MuiYh/WjKQ7U0QSMjo";
        $space_name = "lovvit";
        $region = "sgp1";
        
        $this->space = new SpacesConnect($key, $secret, $space_name, $region); 
    }
}

