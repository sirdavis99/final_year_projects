<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Custom extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

    public function is_logged_in($forward = false, $backward = false)
    {
        $uid = $this->session->userdata('uid');
        if ($uid):
            if ($forward): 
                redirect($forward, 'refresh');
            else:
                return true;
            endif;
        else:
            if ($backward): 
                redirect($backward, 'refresh');
            else:
                return false;
            endif;
        endif;
    }

    public function is_admin($user, $backward = false)
    {
        // print_r($user); return;
        if ($user && isset($user->role) && $user->role === "admin"):
            return true;
        else:
            if ($backward): 
                redirect($backward, 'refresh');
            else:
                return false;
            endif;
        endif;
    }

}

/* End of file Custom.php */
/* Location: ./application/models/Custom.php */
