<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	public $data, $uid;

	public function __construct()
	{
		parent::__construct();

		$this->qcdl->load_actions(["Places"=>"place_act"]);

		$this->uid = $this->session->userdata('uid');

		$this->data["user"] = $this->usr->fetch_users(["uid"=>$this->uid], true);
	}

	public function index()
	{
		$this->data["places"] = $this->place_act->fetch_places();

		$this->load->view('user/places', $this->data);
	}
}
