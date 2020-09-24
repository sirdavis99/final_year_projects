<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Places extends CI_Controller {

	public $data, $uid;

	public function __construct()
	{
		parent::__construct();
		$this->qcdl->load_validation(["Places"=>"place_val"]);
		$this->qcdl->load_actions(["Places"=>"place_act"]);

		$this->uid = $this->session->userdata('uid');

		$this->data["user"] = $this->usr->fetch_users(["uid"=>$this->uid], true);

		$this->myfnx->is_logged_in(false, "account/login");
		$this->myfnx->is_admin($this->data["user"], "places");
	}

	public function index()
	{
		$this->add();
	}

	public function add(){

		if(!empty($_POST)):

			$this->data["form"] = "add";

			$inputs = $this->place_val->places_validation();

			if(!isset($inputs["error_msgs"])):
				$return = $this->place_act->add_place($inputs);
			else:
                // qcdl validator fetch_validator errors to be displayed on page
                $return = $this->qcdl_val->fetch_validator_error($inputs);
            endif;
            // structure return variables as organized array
            $structured_return_val = $this->qcdl_fnc->return_val($return);
            $this->data['alert']   = json_decode($structured_return_val);

		endif;

		$this->data["places"] = $this->place_act->fetch_places();

		$this->load->view("admin/places", $this->data);
	}

	public function edit(int $id){

		$this->data["place"] = $this->place_act->fetch_places(["id"=>$id], true);

		if(!empty($_POST)):

			$this->data["form"] = "edit";

			$inputs = $this->place_val->places_validation();

			if(!isset($inputs["error_msgs"])):
				$return = $this->place_act->update_place($inputs, $id);
				if($return === true):
					redirect('admin/places/','refresh');;
				endif;
			else:
                // qcdl validator fetch_validator errors to be displayed on page
                $return = $this->qcdl_val->fetch_validator_error($inputs);
            endif;
            // structure return variables as organized array
            $structured_return_val = $this->qcdl_fnc->return_val($return);
            $this->data['alert']   = json_decode($structured_return_val);

		endif;

		$this->load->view("admin/update_places", $this->data);
	}

	public function delete(int $id){

		$thisplace = $this->place_act->fetch_places(["id"=>$id], true);
		$this->data["places"] = $this->place_act->fetch_places();
		
		if($thisplace):

			$return = $this->place_act->delete_place($id);
		else:
            // qcdl validator fetch_validator errors to be displayed on page
            $return = $this->lang->line('global_error');
        endif;
        // structure return variables as organized array
        $structured_return_val = $this->qcdl_fnc->return_val($return);
        $this->data['alert']   = json_decode($structured_return_val);


		$this->load->view("admin/places", $this->data);
	}



}

/* End of file Places.php */
/* Location: ./application/controllers/Places.php */