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
		$this->myfnx->is_admin($this->data["user"], "places");
	}

	public function index()
	{
		$this->data["feeds"] = $this->feed_act->fetch_feeds();

		$this->load->view("admin/feedbacks", $this->data);
	}

	public function delete(int $id){

		$thisfeed = $this->feed_act->fetch_feeds(["id"=>$id], true);
		
		if($thisfeed):

			$return = $this->feed_act->delete_feeds($id);
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

/* End of file Feedbacks.php */
/* Location: ./application/controllers/Feedbacks.php */