<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminModel extends CI_Model
{

    protected $cpn_phrase = 'uiyiouoi^&*^&*23';
    protected $dob_phrase = 'asdf@#$%@#$%23452345';
    protected $ssn_phrase = ';lk;@!#$!@#$!@#$234';
    protected $password_phrase = 'LUKU%^*^&*^*&34';


    public function __construct()
    {
        parent::__construct();
    }

    function editable($data, $value, $text)
    {
        $editable = array();
        foreach ($data as $pair) {
            $editable[] = '{' . 'value: ' . $pair->$value . ',' . ' text: ' . '\'' . $pair->$text . '\'' . '}';
        }
        return str_replace("\"", "", json_encode($editable));
    }

    function calendar($data)
    {
        $editable = array();
        foreach ($data as $pair) {
            $editable[] = '{' . '"id"' . ':"' . $pair->id . '"' . ',' . '"title"' . ':"' . $pair->title . '"' . ',' . '"start"' . ':"' . $pair->start . '"' . ',' . '"end"' . ':"' . $pair->end . '"' . ',' . '"backgroundColor"' . ':"' . $pair->bgColor . '"' . ',' . '"borderColor"' . ':"' . $pair->bColor. '"' . ',' . '"allDay"' . ':' . '"false"' . '}';
        }
        return str_replace(array("\\", "\"{", "}\""), array("", "{", "}"), json_encode($editable));
    }

    function select2($data, $id, $text)
    {
        $editable = array();
        foreach ($data as $pair) {
            $editable[] = '{' . 'id: ' . $pair->$id . ',' . ' text: ' . '\'' . $pair->$text . '\'' . '}';
        }
        return str_replace("\"", "", json_encode($editable));
    }

    function select($data, $id, $text)
    {
        $editable = array();
        foreach ($data as $pair) {
            $editable[] = '{' . 'value: ' . $pair->$id . ',' . ' text: ' . '\'' . $pair->$text . '\'' . '}';
//            $editable[] = '{' . 'value: ' . '\'' . $pair->$id . '\'' . ',' . ' text: ' . '\'' . $pair->$text . '\'' . '}';
        }
        return str_replace("\"", "", json_encode($editable));
    }

    function formatDate($stringDate)
    {
        $date = null;
        $userFormat = DateTime::createFromFormat('m-d-Y', $stringDate);
        if (!$userFormat) {
            $userFormat = DateTime::createFromFormat('m/d/Y', $stringDate);
        }
        if ($stringDate) {
            $date = $userFormat->format('Y-m-d');
        }
        return $date;
    }

    function data($string)
    {
        $data = array();
        if (is_array($string)) {
            foreach ($string as $key => $value) {
                if ($value) {
                    $data[$key] = $value;
                }
            }
        }
        return $this->security->xss_clean($data);
    }

    function implodeIndexed($array, $columnName)
    {
        $str = '';
        foreach ($array as $key => $val) {
            $str .= $val[$columnName] . ",";
        }
        return $str;
    }

    function implodeHelper($array)
    {
        return implode(',', array_map($array));
    }

    public function widget($widget, $result, $key, $value, $placeholder)
    {
//        $return = array('' => 'Choose a ' . $placeholder);
        $return = array();
        switch ($widget) {
            case SELECT:
                foreach ($result as $r) {
                    $return[$r->$key] = $r->$value;
                }
                break;
            case SELECTX:
                return $this->select($result, $key, $value);
                break;
            case CHECK;
                foreach ($result as $r) {
                    $return[$r->$key] = $r->$value;
                }
                break;
            case SELECTXKEYS:
                $temp = array();
                foreach ($result as $r) {
                    $temp[] = $r->$key;
                }
                $return = implode(', ', $temp);
                break;
            case JSON:
                echo json_encode($result);
                break;
            default:
                $return = $result;
                break;
        }
        return $return;
    }

    public function getStatuses($widget)
    {
        $result = $this->db->query("SELECT s.id, s.value FROM status s")->result();
        return $this->widget($widget, $result, 'id', 'value', 'Select a Status');
    }


    function getGUID()
    {
        if (function_exists('com_create_guid')) {
            return com_create_guid();
        } else {
            mt_srand((double)microtime() * 10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = chr(123)// "{"
                . substr($charid, 0, 8) . $hyphen
                . substr($charid, 8, 4) . $hyphen
                . substr($charid, 12, 4) . $hyphen
                . substr($charid, 16, 4) . $hyphen
                . substr($charid, 20, 12)
                . chr(125);// "}"
            return $uuid;
        }
    }

}
