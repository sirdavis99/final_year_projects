<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_actions extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function fetch_users($arg = false, $single = false)
    {
        $arg = !is_bool($arg) ? $arg : "id > 0";

        $query = array(
            "table" => "users",
            "arg"   => $arg,
        );

        $fetch_users = $this->qcdl_db->get_where($query);
        if ($fetch_users):
            if ($single): return $fetch_users->row();
            else:return $fetch_users->result();
            endif;
        else:
            return false;
        endif;
    }

    public function fetch_users_info($arg = false, $single = false)
    {
        $arg = !is_bool($arg) ? $arg : "id > 0";

        $query = array(
            "table" => "users_info",
            "arg"   => $arg,
        );

        $fetch_info = $this->qcdl_db->get_where($query);
        if ($fetch_info):
            if ($single): return $fetch_info->row();
            else:return $fetch_info->result();
            endif;
        else:
            return false;
        endif;
    }

    public function delete_user($uid)
    {
        $query = array(
            "tables" => ["users", "users_info"],
            "arg"   => ["uid" => $uid],
        );

        $delete_user = $this->qcdl_db->delete($query);
        if ($delete_user):
            return true;
        else:
            return $this->lang->line('global_error');
        endif;
    }

}

/* End of file User_actions.php */
/* Location: ./application/models/User_actions.php */