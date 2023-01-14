<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LovvitValidations {
    private $_lovvit;
    private $__files;
    private $_message;

    public function __construct() {
        $this->_lovvit   =& get_instance();
        $this->_lovvit->load->library("Utilities");
    }

    public function upload($data) {
        $this->__files  = $data;
        return $this;
    } 

    public function allowed() {
        $allowed_type   = [ "application/pdf", "image/png", "image/jpg", "image/jpeg" ];
        $size           = "";

        if ( !in_array($this->__files["type"], $allowed_type) ) {
            $this->_message = "Only pdf files and images in png, jpg, jpeg formats can be uploaded";
            return False;
        }

        // if ( $this->__files["size"] > $size ) {
        //     $this->_message = "File size is more than 5 mb";
        // }

        return true;
    }

    public function get_data() {
        return $this->__files;
    }

    public function get_error_message() {
        return $this->_message;
    }



}