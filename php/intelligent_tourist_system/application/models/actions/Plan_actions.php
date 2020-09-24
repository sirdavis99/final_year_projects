<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Plan_actions extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function add_plans($inputs)
    {
        $query = array(
            "table" => "plans",
            "data"  => [
                "area"   => $inputs["area"],
                "day1"   => $inputs["planplaces1"],
                "day2"   => $inputs["planplaces2"],
                "day3"   => $inputs["planplaces3"],
                "uid"   => $this->uid,
                "logged" => date('M d, Y H:i a'),
            ],
        );

        $store_plans = $this->qcdl_db->insert($query);
        if ($store_plans):
            return $this->lang->line('record_stored');
        else:
            return $this->lang->line('global_error');
        endif;
    }

    public function delete_place($id)
    {
        $query = array(
            "tables" => "plans",
            "arg"   => ["id" => $id],
        );

        $del_plans = $this->qcdl_db->delete($query);
        if ($del_plans):
            return $this->lang->line('record_deleted');
        else:
            return $this->lang->line('global_error');
        endif;
    }

    public function fetch_plans($arg = false, $single = false)
    {
        $arg = !is_bool($arg) ? $arg : "id > 0";

        $query = array(
            "table" => "plans",
            "arg"   => $arg,
        );

        $fetch_plans = $this->qcdl_db->get_where($query);
        if ($fetch_plans):
            if ($single): return $fetch_plans->row();
            else:return $fetch_plans->result();
            endif;
        else:
            return false;
        endif;
    }

}

/* End of file Plan_actions.php */
/* Location: ./application/models/Plan_actions.php */
