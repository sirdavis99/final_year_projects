<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback_validations extends CI_Model {


	public function __construct()
	{
		parent::__construct();
		
	}

	public function feed_validation()
	{
		
		$config = array(
			[
				"field"=>"comment",
				"label"=>"Comment",
				"rules"=>"required|xss_clean"
			]
		);

		return $this->qcdl_val->run_input_validation($config);
	}

}

/* End of file Feedback_validations.php */
/* Location: ./application/models/Feedback_validations.php */