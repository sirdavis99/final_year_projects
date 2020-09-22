<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'library/*/Functions.php';
require_once APPPATH . 'library/*/Validator.php';
require_once APPPATH . 'library/*/Database.php';

class Loader2
{
	protected $ci;
	// QCDL Methods library 
	public $fnc, $val, $db; 

	public function __construct()
	{
        $this->ci =& get_instance();

        $this->fnc = "";

	    
	}

	public function autoload(){
		// $this->qcdl->fnc->	
	}




	

}

/* End of file Loader2.php */
/* Location: ./application/libraries/quick_ci_dev/Loader2.php */
