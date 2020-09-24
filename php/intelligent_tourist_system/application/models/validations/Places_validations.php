<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Places_validations extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function places_validation()
	{
		$config = array(
			[
				"field"=>"name",
				"label"=>"Name of Place",
				"rules"=>"required|xss_clean"
			],
			[
				"field"=>"description",
				"label"=>"Description",
				"rules"=>"required|xss_clean"
			],
			[
				"field"=>"area",
				"label"=>"Area",
				"rules"=>"required|xss_clean"
			],
			[
				"field"=>"tags",
				"label"=>"Tags",
				"rules"=>"required|xss_clean"
			],
			[
				"field"=>"address",
				"label"=>"Address",
				"rules"=>"required|xss_clean"
			],
			[
				"field"=>"gps",
				"label"=>"GPS Coordinates",
				"rules"=>"required|xss_clean"
			],
		);

		$file_config = array(
            [
                'files' => 'places',
                'folder' => './uploads/places/',
                'allowed_types' => 'gif|jpg|jpeg|png|heic|heif|heics|avci',
                'max_height'=>'2000',
                'max_width'=>'2000'
            ]
        );
		if(isset($_FILES["places"])):
			return $this->qcdl_val->run_input_validation($config, $file_config);
		else:
			return $this->qcdl_val->run_input_validation($config);
		endif;
	}

}

/* End of file Places_validations.php */
/* Location: ./application/models/Places_validations.php */