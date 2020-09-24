<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Feedback_actions extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

    public function add_feed($inputs)
    {
        $query = array(
            "table" => "feedbacks",
            "data"  => [
                "comment"  => $inputs["comment"],
                "reg_date" => date('M d, Y'),
                "reg_time" => date('h:i a'),
                 "uid"     => $this->uid
            ],
        );

        $store_feed = $this->qcdl_db->insert($query);
        if ($store_feed):
            return $this->lang->line('record_stored');
        else:
            return $this->lang->line('global_error');
        endif;
    }

    public function delete_feeds($id)
    {
        $query = array(
            "tables" => "feedbacks",
            "arg"    => ["id" => $id],
        );

        $del_feeds = $this->qcdl_db->delete($query);
        if ($del_feeds):
            return $this->lang->line('record_deleted');
        else:
            return $this->lang->line('global_error');
        endif;
    }

    public function fetch_feeds($arg = false, $single = false)
    {
        $arg = !is_bool($arg) ? $arg : "id > 0";

        $query = array(
            "table" => "feedbacks",
            "arg"   => $arg,
        );

        $fetch_feeds = $this->qcdl_db->get_where($query);
        if ($fetch_feeds):
            if ($single): return $fetch_feeds->row();
            else:return $fetch_feeds->result();
            endif;
        else:
            return false;
        endif;
    }

}

/* End of file Feedback_actions.php */
/* Location: ./application/models/Feedback_actions.php */
