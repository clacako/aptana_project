<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Reports {
    private $_report;

    public function __construct() {
        $this->_report =& get_instance();
        $this->_report->load->library('Phpexcel');
        $this->_report->load->library('PHPExcel/iofactory');
        $this->_report->load->library("Utilities");
    }

    function xlsx_extract_data($file_name, $header_file = [], $skip_counter_data_header = 0, $start_row = 1) {
        $path   = "./imports/".$file_name;
        
        //  Read your Excel workbook
        try {
            $input_file_type    = $this->_report->iofactory->identify($path);
            $objReader          = $this->_report->iofactory->createReader($input_file_type);
            $objPHPExcel        = $objReader->load($path);
        } catch(Exception $e) {
            die('Error loading file "' . pathinfo($file_name, PATHINFO_BASENAME) . '" : ' . $e->getMessage());
        }

        //  Get worksheet dimensions
        $sheet          = $objPHPExcel->getSheet(0);
        $highest_row    = $sheet->getHighestRow();
        $highest_column = $sheet->getHighestColumn();

        //  Loop through each row of the worksheet in turn
        for ($row=$start_row; $row <= $highest_row; $row++) { 
            //  Read a row of data into an array
            $row_data   = $sheet->rangeToArray('A' . $row . ':' . $highest_column . $row, NULL, TRUE, FALSE);
            $pre_data   = [];            
            if ( !empty($row_data[0]) ) {
                $capture_row    = $row_data[0];
                $row_data[0]    = [];
                for ($n = 0; $n < count($capture_row); $n++) {
                    if ( $n < count($header_file) ) {
                        $row_data[0][] = $capture_row[$n];
                    }       
                }
            }
            
            if ( count($row_data[0]) != count($header_file) && $skip_counter_data_header == 0 ) {
                return false;
            }
            
            for ($i=0; $i < count($row_data[0]); $i++) {
                $pre_data[$header_file[$i]] = $this->_report->utilities->cleaned_data($row_data[0][$i]);
            }            
            $data[] = $pre_data;
        }

        return $data;
    }

}