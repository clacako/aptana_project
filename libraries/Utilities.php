<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Utilities {

    public function printr($data) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
    
    public function cleaned_data($string) {
        $string = trim($string);
        // $string = filter_var(mysql_real_escape_string($string), FILTER_SANITIZE_SPECIAL_CHARS);
        return $string;
    }
    
    public function array_to_hash($array = [], $key) {
        $hashing_array  = [];
        foreach ($array as $array_value) {
            $hashing_array[$array_value[$key]]  = $array_value;
        }
    
        return $hashing_array;
    }
    
    public function array_to_hash_object($array = [], $key) {
        $hashing_array  = [];
        foreach ($array as $array_value) {
            $hashing_array[$array_value->$key]  = $array_value;
        }
    
        return $hashing_array;
    }

}