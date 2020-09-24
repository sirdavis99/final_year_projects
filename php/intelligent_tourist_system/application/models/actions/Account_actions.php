<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Account_actions extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

    public function register_user($inputs)
    {

        $uid = password_hash($inputs["email"], PASSWORD_DEFAULT);

        $query = array(
            "user" => [
                "table" => "users",
                "data"  => [
                    "password" => password_hash($inputs["password"], PASSWORD_DEFAULT),
                    "role"     => "user", "uid" => $uid, "logged" => date('YmdHis'),
                ],
            ],
            "info" => [
                "table" => "users_info",
                "data"  => [
                    "name"  => $inputs["fname"], "email"   => $inputs["email"],
                    "phone" => $inputs["phone"], "address" => $inputs["address"],
                    "uid"   => $uid, "logged"              => date('YmdHis'),
                ],
            ],
        );

        $store_user = $this->qcdl_db->insert($query["user"]);
        if ($store_user):
            if ($this->qcdl_db->insert($query["info"])):
                $this->session->set_userdata([
                    "uid" => $uid,
                ]);

                redirect('places', 'refresh');
            else:
                return $this->lang->line('global_error');
            endif;
        else:
            return $this->lang->line('global_error');
        endif;
    }

    public function login_user($inputs)
    {

        $query = array(
            "info" => [
                "table" => "users_info",
                "arg"   => ["email" => $inputs["email"]],
            ],
            "user" => [
                "table" => "users",
            ],
        );

        $fetch_info = $this->qcdl_db->get_where($query["info"]);

        if ($fetch_info):
            $info                 = $fetch_info->row();
            $query["user"]["arg"] = ["uid" => $info->uid];
            $fetch_user           = $this->qcdl_db->get_where($query["user"]);

            if ($fetch_user):
                $user = $fetch_user->row();
                if (password_verify($inputs["password"], $user->password)):
                	// store user session
                    $this->session->set_userdata([
                        "uid" => $user->uid,
                    ]);
                    if($user->role === "admin"):
                    	redirect('admin/places/add', 'refresh');
                    else:
                    	redirect('places', 'refresh');
                    endif;
                else:
                    return $this->lang->line('wrong_pass');
                endif;
            else:
                return $this->lang->line('global_error');
            endif;
        else:
            return $this->lang->line('user_not_registered');
        endif;
    }

}

/* End of file Account_actions.php */
/* Location: ./application/models/Account_actions.php */
