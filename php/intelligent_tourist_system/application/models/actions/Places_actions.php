<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Places_actions extends CI_Model
{

    public $variable;

    public function __construct()
    {
        parent::__construct();

    }

    public function add_place($inputs)
    {
        $query = array(
            "table" => "places",
            "data"  => [
                "name"        => $inputs["name"],
                "description" => $inputs["description"],
                "area"        => $inputs["area"],
                "tag"         => $inputs["tags"],
                "address"     => $inputs["address"],
                "gps"         => $inputs["gps"],
                "image"       => $inputs["places"],
                "logged"      => date('YmdHis'),
            ],
        );

        $store_places = $this->qcdl_db->insert($query);
        if ($store_places):
            return $this->lang->line('places_stored');
        else:
            return $this->lang->line('global_error');
        endif;
    }

    public function update_place($inputs, $id)
    {
        $query = array(
            "table" => "places",
            "data"  => [
                "name"        => $inputs["name"],
                "description" => $inputs["description"],
                "area"        => $inputs["area"],
                "tag"         => $inputs["tags"],
                "address"     => $inputs["address"],
                "gps"         => $inputs["gps"],
                "logged"      => date('YmdHis'),
            ],
            "arg"   => ["id" => $id],
        );

        if(isset($inputs["places"])):
        	$query["data"]["image"] = $inputs["places"];
        endif;

        $update_places = $this->qcdl_db->update($query);
        if ($update_places):
            return true;
        else:
            return $this->lang->line('global_error');
        endif;
    }

    public function delete_place($id)
    {
        $query = array(
            "tables" => "places",
            "arg"   => ["id" => $id],
        );

        $del_places = $this->qcdl_db->delete($query);
        if ($del_places):
            return $this->lang->line('record_deleted');
        else:
            return $this->lang->line('global_error');
        endif;
    }

    public function fetch_places($arg = false, $single = false)
    {
        $arg = !is_bool($arg) ? $arg : "id > 0";

        $query = array(
            "table" => "places",
            "arg"   => $arg,
        );

        $fetch_places = $this->qcdl_db->get_where($query);
        if ($fetch_places):
            if ($single): return $fetch_places->row();
            else:return $fetch_places->result();
            endif;
        else:
            return false;
        endif;
    }

}

/* End of file Places_actions.php */
/* Location: ./application/models/Places_actions.php */
