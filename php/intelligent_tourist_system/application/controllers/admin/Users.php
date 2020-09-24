<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public $data, $uid;

	public function __construct()
	{
		parent::__construct();

		$this->uid = $this->session->userdata('uid');

		$this->data["user"] = $this->usr->fetch_users(["uid"=>$this->uid], true);

		$this->myfnx->is_logged_in(false, "account/login");
		$this->myfnx->is_admin($this->data["user"], "places");
	}

	public function index()
	{
		$this->data["usrs"] = $this->usr->fetch_users_info();

		$this->load->view("admin/users", $this->data);
	}

	public function delete(int $id){

		$thisusr = $this->usr->fetch_users(["id"=>$id], true);
		
		if($thisusr):

			$return = $this->usr->delete_user($thisusr->uid);
		else:
            // qcdl validator fetch_validator errors to be displayed on page
            $return = $this->lang->line('global_error');
        endif;
        // structure return variables as organized array
        $structured_return_val = $this->qcdl_fnc->return_val($return);
        $this->data['alert']   = json_decode($structured_return_val);


		$this->index();
	}

}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */