<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account_validations extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}


	public function login_validation(){
		$config = array(
			[
				"field"=>"email",
				"label"=>"Email Address",
				"rules"=>"valid_email|required|xss_clean"
			],
			[
				"field"=>"password",
				"label"=>"Password",
				"rules"=>"required|xss_clean"
			],
		);

		return $this->qcdl_val->run_input_validation($config);
	}


	public function register_validation(){

		$config = array(
			[
				"field"=>"fname",
				"label"=>"Full Name",
				"rules"=>"required|xss_clean"
			],
			[
				"field"=>"email",
				"label"=>"Email Address",
				"rules"=>"valid_email|required|xss_clean"
			],
			[
				"field"=>"phone",
				"label"=>"Mobile Number",
				"rules"=>"required|xss_clean"
			],
			[
				"field"=>"address",
				"label"=>"Address",
				"rules"=>"required|xss_clean"
			],
			[
				"field"=>"password",
				"label"=>"Password",
				"rules"=>"required|xss_clean"
			],
		);

		return $this->qcdl_val->run_input_validation($config);
	}

}

/* End of file Account_validations.php */
/* Location: ./application/models/Account_validations.php */