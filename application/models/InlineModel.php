<?php

class InlineModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('security');
        $this->load->database();

    }

    function addOrUpdate($table, $pk, $name, $value, $deleteKey)
    {
        $this->db->trans_start();
        $database = $this->db->database;
        if (!isset($table)) {
            throw new Exception('Table name is missing');
        } else if (!isset($pk)) {
            throw new Exception('Primary Key is missing in table ' . $table);
        } else if (!isset($name)) {
            throw new Exception('Column name to update is missing in table ' . $table);
        }
        $primary_key = $this->db->query("select column_name from information_schema.columns where table_schema = '$database' and table_name = '$table' and column_key = 'pri'")->result();
        if (count($primary_key) == 1) {
            $key = $primary_key[0]->column_name;
            $count = $this->db->query("select * from $table where $key = '$pk'")->num_rows();
            if ($count == 0) {
                $this->db->insert($table, array($key => $pk, $name => $value));
            } else {
                $this->db->where($key, $pk);
                $this->db->update($table, array($name => $value));
            }
        } else {
            if ($deleteKey) {
                $this->db->where($deleteKey, $this->security->xss_clean($pk[$deleteKey]));
                $this->db->delete($table);
            }
            if ($this->db->get_where($table, $pk)->num_rows() > 0) {
                if (is_array($value)) {
                    foreach ($value as $val) {
                        $this->db->where($pk);
                        $this->db->update($table, array($name => $val));
                    }
                } else {
                    $this->db->where($pk);
                    $pk[$name] = $value;
                    $this->db->update($table, $pk);
                }
            } else {
                if (is_array($value)) {
                    foreach ($value as $val) {
                        $pk[$name] = $val;
                        $this->db->insert($table, $pk);
                    }
                } else {
                    if ($value) {
                        $pk[$name] = $value;
                        $this->db->insert($table, $pk);
                    }
                }
            }
        }
        $this->db->trans_complete();
    }
}
