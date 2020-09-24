<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	public $data;

	public function __construct()
	{
		parent::__construct();

		$this->qcdl->load_validation(["Account"=>"acctval"]);
		$this->qcdl->load_actions(["Account"=>"acct"]);

		$this->uid = $this->session->userdata('uid');

		$this->data["user"] = $this->usr->fetch_users();
	}

	public function index()
	{
		$this->login();
	}

	public function register()
	{	

		$this->myfnx->is_logged_in("places");

		if(!empty($_POST)):

			$this->data["form"] = "register";

			$inputs = $this->acctval->register_validation();
			if(!isset($inputs["error_msgs"])):
				$return = $this->acct->register_user($inputs);
			else:
                // qcdl validator fetch_validator errors to be displayed on page
                $return = $this->qcdl_val->fetch_validator_error($inputs);
            endif;
            // structure return variables as organized array
            $structured_return_val = $this->qcdl_fnc->return_val($return);
            $this->data['alert']   = json_decode($structured_return_val);

		endif;

		$this->load->view("user/register", $this->data);
	}

	public function login(){

		$this->myfnx->is_logged_in("places");

		if(!empty($_POST)):

			$this->data["form"] = "login";

			$inputs = $this->acctval->login_validation();
			if(!isset($inputs["error_msgs"])):
				$return = $this->acct->login_user($inputs);
			else:
                // qcdl validator fetch_validator errors to be displayed on page
                $return = $this->qcdl_val->fetch_validator_error($inputs);
            endif;
            // structure return variables as organized array
            $structured_return_val = $this->qcdl_fnc->return_val($return);
            $this->data['alert']   = json_decode($structured_return_val);

		endif;

		$this->load->view("user/login", $this->data);
	}

	public function logout(){

		$this->session->unset_userdata("uid");
		redirect('account/login','refresh');
	}

}

/* End of file Account.php */
/* Location: ./application/controllers/Account.php */