<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends CI_Controller {
	function __construct(){
				parent::__construct();
						
				
				
		}
		
	public function index()
	{
		
		$this->template->load('temp_home','v_error');
	}
	
	
	
	
	
	
	
	
	
	
	
	
}
