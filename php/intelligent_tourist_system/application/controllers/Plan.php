<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plan extends CI_Controller {

	public $data, $uid;

	public function __construct()
	{
		parent::__construct();

		$this->qcdl->load_validation(["Plan"=>"plan_val"]);
		$this->qcdl->load_actions(["Plan"=>"plan_act", "Places"=>"place_act"]);

		$this->uid = $this->session->userdata('uid');

		$this->data["user"] = $this->usr->fetch_users(["uid"=>$this->uid], true);

		$this->myfnx->is_logged_in(false, "account/login");
	}

	public function index()
	{

		if(!empty($_POST)):

			$this->data["form"] = "add";

			$inputs = $this->plan_val->add_plan_validation();

			// print_r($inputs);

			if(!isset($inputs["error_msgs"])):
				$return = $this->plan_act->add_plans($inputs);
			else:
                // qcdl validator fetch_validator errors to be displayed on page
                $return = $this->qcdl_val->fetch_validator_error($inputs);
            endif;
            // structure return variables as organized array
            $structured_return_val = $this->qcdl_fnc->return_val($return);
            $this->data['alert']   = json_decode($structured_return_val);

		endif;

		$this->data["places"] = $this->place_act->fetch_places();
		$this->data["plans"] = $this->plan_act->fetch_plans();

		$this->load->view("user/plan", $this->data);
	}


	public function view(int $id)
	{
		$this->data["plan"] = $this->plan_act->fetch_plans(["id"=>$id], true);
		
		$this->load->view("user/view_plan", $this->data);
	}

	public function fetch_places($area){
		$places = $this->place_act->fetch_places("area LIKE '%".$area."%' ");

		if($places):
			$return = '<div class="form-row py-3">';

			for($i=1; $i<4; $i++):

				$return.='
					<div class="col-md-4">
						<div class="mb-2"><b>Day '.$i.'</b></div>
				';

				foreach ($places as $place) :
					$return.= '
						<div class="custom-control custom-radio">
						  <input type="radio" class="custom-control-input" id="checkplan'.$i.$place->id.'" name="planplaces'.$i.'" value="'.$place->id.'">
						  <label class="custom-control-label" for="checkplan'.$i.$place->id.'">
						  	'.$place->name.'
						  </label>
						</div>
					';
				endforeach;

				$return.= '</div>';

			endfor;

			$return.= '</div>';

			echo json_encode(["status"=>true, "data"=>$return]);

		else:

			echo json_encode(["status"=>false]);

		endif;
	}

}

/* End of file Places.php */
/* Location: ./application/controllers/Places.php */