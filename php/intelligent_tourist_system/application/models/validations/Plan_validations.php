<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan_validations extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function add_plan_validation()
	{
		$config = array(
			[
				"field"=>"area",
				"label"=>"Area",
				"rules"=>"required|xss_clean"
			]
		);

		for($i=1; $i<4; $i++):

			$xtra = [
				"field"=>"planplaces$i",
				"label"=>"Day $i Plan",
				"rules"=>"required|xss_clean"
			];

			array_push($config, $xtra);

		endfor;
		
		return $this->qcdl_val->run_input_validation($config);
		
	}

}

/* End of file Plan_validations.php */
/* Location: ./application/models/Plan_validations.php */