<?php
class Rep extends Public_Controller {

	function __construct() {
        	parent::Public_Controller();
                //load model 
        	$this->load->model('rep_m');
    	}


	function index(){

			
			echo $this->agent->referrer();
	
	}

	//
	// Rep Access Gateway
	//	
	function gw(){
			$ua = $this->input->user_agent();	
			$ip = $this->input->ip_address();
			$ref_site = $this->agent->referrer();
			$rep_id = $this->uri->segment(3);
			
			echo $rep_id;
	}
	
		
	
}	
/*End rep.php */	