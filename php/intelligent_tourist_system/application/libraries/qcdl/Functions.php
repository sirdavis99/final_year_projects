<?php defined('BASEPATH') or exit('No direct script access allowed');

class Functions
{

    public $CI; #using codeigniters global variable

    public function __construct()
    {
        // get the super global CI within QDL
        $this->CI = &get_instance();
        // $this->CI->load->library([
        //   "form_validation"
        // ]);
    }

    public function check_device($encrypted_string = false, $encrypt = false)
    {
        // using the codigniter "user_agent" library
        $this->CI->load->library('user_agent');
        // fetch device full agent list
        $device = $this->CI->agent->agent_string() . "|" . $_SERVER['REMOTE_ADDR'];

        if ($encrypted_string && password_verify($device, $encrypted_string)):
            //
            return $device;

        elseif (!$encrypted_string && $encrypt):
            //
            return password_hash($device, PASSWORD_DEFAULT);
            //
        elseif (!$encrypted_string && !$encrypt):
            //
            return $device;
        else:
            //
            return false;

        endif;

    }

    public function return_val($data)
    {
        $values = array(
            "msg"    => isset($data['msg']) ? $data['msg'] : "An <b>Error</b> occured ... please try again",
            "cat"    => isset($data['cat']) ? $data['cat'] : "info",
            "icon"   => isset($data['icon']) ? $data['icon'] : "travel_info",
            "goto"   => isset($data['goto']) ? $data['goto'] : "null",
            "field"  => isset($data['field']) ? $data['field'] : "null",
            "reload" => isset($data['reload']) ? $data['reload'] : "null",
        );
        $msg = json_encode($values);
        return $msg;
    }

    public function encrypt($msg, $ch = true, $hb = "bin2hex")
    {
        $this->CI->load->library("encryption");
        // create key
        // echo bin2hex($this->CI->encryption->create_key(16));

        if ($ch):
            if ($hb === "bin2hex"):
                $result = bin2hex($this->CI->encryption->encrypt($msg));
            else:
                $result = $this->CI->encryption->encrypt($msg);
            endif;
        else:
            if ($hb === "hex2bin"):
                $convert_to_bin = hex2bin($msg);
                $result         = $this->CI->encryption->decrypt($convert_to_bin);
            else:
                return false;
            endif;
        endif;

        return $result;
    }

    public function json_encrypt($array, $encrypt = true)
    {
        if ($encrypt):
            $convert_array_2_json = json_encode($array);
            return $this->encrypt($convert_array_2_json);
//            returns encrypted string of the json data
        elseif (is_string($array) && !$encrypt):
            $decrypted = $this->encrypt($array, false, "hex2bin");
            return json_decode($decrypted, true);
        else:
            return false;
        endif;
    }

    public function set_form_defaults(array $form_defaults)
    {

        $default = array();
        foreach ($form_defaults as $field => $defval) {
            if (!empty(set_value($field))) {
                $default[$field] = set_value($field);
            } else {
                $default[$field] = $defval;
            }
        }

        return $default;
    }

    public function format_date($time, $passed = false, $length = 4)
    {
        $time_split   = str_split($time);
        $reverse_time = array_reverse($time_split);

        $reformat = array("years" => [], "months" => [], "days" => [], "hours" => [], "mins" => [], "sec" => []);
        for ($i = 0; $i < count($reverse_time); $i++) {
            if ($i < 2):
                array_push($reformat["sec"], $reverse_time[$i]);
            elseif ($i < 4):
                array_push($reformat["mins"], $reverse_time[$i]);
            elseif ($i < 6):
                array_push($reformat["hours"], $reverse_time[$i]);
            elseif ($i < 8):
                array_push($reformat["days"], $reverse_time[$i]);
            elseif ($i < 10):
                array_push($reformat["months"], $reverse_time[$i]);
            elseif ($i < 14):
                array_push($reformat["years"], $reverse_time[$i]);
            endif;
        }
        $formatted = [];
        foreach ($reformat as $key => $value):
            if (!empty($value)):
                if (!$passed):
                    $str_format = join("", array_reverse($value));
                else:
                    $str_format = join("", array_reverse($value)) . " " . $key;
                endif;

                array_push($formatted, $str_format);
            endif;
        endforeach;

        return array_slice($formatted, 0, $length);
    }

    public function date_format_create($value, $from = 'Y-m-d', $to = 'D m Y')
    {
        $string = !is_array($value) ? $value : join("-", $value);
        $format = DateTime::createFromFormat($from, $string)->format($to);
        # code...
        return $format;
    }

    // public function str2num($string)
    // {
    //     $num_array = str_split("0123456789")
    //     $char_array = array(str_split("abcdefghi"), )
    //     $sep_str = str_split($string);
    // }
}
