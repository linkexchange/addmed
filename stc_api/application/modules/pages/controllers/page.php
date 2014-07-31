<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of page
 *
 * @author comp14
 */
class Page extends MX_Controller {
    //put your code here
    public function __construct()
    {
    	parent::__construct();
        $this->layout->setLayout("layout/normal");
    }
    
    public function privacy_policy(){
        $this->layout->view('privacy_policy','');
    }
        
}

?>
