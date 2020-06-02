<?php

class DbModel
{
    private $db;
    private $prefix;

    public function __construct()
    {
        $this->db = new Database();
        $this->prefix = 'ymc_';

    }

    public function getPrimaryKey($table_name)
    {
        $primary_key = $this->db->query("SHOW KEYS FROM {$table_name} WHERE Key_name = 'PRIMARY'");

        return $this->db->single();
    }

    public function select($column, $table, $where = null, $additional = null)
    {

        if($where == null && $additional == null){
            $this->db->query("SELECT {$column} FROM {$this->prefix}{$table}");
        }else{
            $this->db->query("SELECT {$column} FROM {$this->prefix}{$table} WHERE {$where} = '{$additional}'");
        }

        $result = $this->db->resultSet();
        return $result;
    }

    public function insert($array, $table)
    {
        $sql_field = implode(', ', array_keys($array));
        $sql_value = ':' . implode(', :', array_keys($array));

        $this->db->query("INSERT INTO {$this->prefix}{$table} ({$sql_field}) VALUES ({$sql_value})");

        foreach ($array as $k => $v) {
            $this->db->bind($k, $v);
        }

        return $this->db->execute();
    }

    public function update($array, $table, $where = '')
    {
        $data = '';
        foreach ($array as $k => $v) {
            $data .= $k . ' = :' . $k . ', ';
        }
        $data = rtrim($data, ', ');

        $this->db->query("UPDATE {$this->prefix}{$table} SET {$data} WHERE {$where}");

        foreach ($array as $k => $v) {
            $this->db->bind($k, $v);
        }

        return $this->db->execute();
    }

    public function delete($id, $table)
    {
        $primary_key = $this->getPrimaryKey($this->prefix . $table);
        $primary_column = $primary_key->Column_name;

        $this->db->query("DELETE FROM {$this->prefix}{$table} WHERE {$primary_column} = :id");

        $this->db->bind('id', $id);

        $this->db->execute();
    }
}
