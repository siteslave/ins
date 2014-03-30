<?php

class Errors extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
    }
    
    public function access_denied(){
        $this->load->view('errors/access_denied_view');
    }
    
    public function mypdf(){
        $this->load->library('pdf');

        // set document information
        $this->pdf->SetSubject('TCPDF Tutorial');
        $this->pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        
        // set font
        $this->pdf->SetFont('times', 'BI', 16);
        
        // add a page
        $this->pdf->AddPage();
        
        // print a line using Cell()
        $this->pdf->Cell(0, 12, 'Example 001 - sfsdfdsfdff', 1, 1, 'C');
        
        //Close and output PDF document
        $this->pdf->Output('example_001.pdf', 'I'); 
    }
}
