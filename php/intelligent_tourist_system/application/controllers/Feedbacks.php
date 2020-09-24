<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedbacks extends CI_Controller {

	public $data, $uid;

	public function __construct()
	{
		parent::__construct();

		$this->qcdl->load_validation(["Feedback"=>"feed_val"]);
		$this->qcdl->load_actions(["Feedback"=>"feed_act"]);

		$this->uid = $this->session->userdata('uid');

		$this->data["user"] = $this->usr->fetch_users(["uid"=>$this->uid], true);

		$this->myfnx->is_logged_in(false, "account/login");
	}

	public function index()
	{
		if(!empty($_POST)):

			$this->data["form"] = "add";

			$inputs = $this->feed_val->feed_validation();

			if(!isset($inputs["error_msgs"])):
				$return = $this->feed_act->add_feed($inputs);
			else:
                // qcdl validator fetch_validator errors to be displayed on page
                $return = $this->qcdl_val->fetch_validator_error($inputs);
            endif;
            // structure return variables as organized array
            $structured_return_val = $this->qcdl_fnc->return_val($return);
            $this->data['alert']   = json_decode($structured_return_val);

		endif;

		$this->load->view('user/feedback', $this->data);
	}

}

/* End of file Feedbacks.php */
/* Location: ./application/controllers/Feedbacks.php */