<?php

class AdminModel
{
    private $db;
    private $prefix;

    public function __construct()
    {
        $this->db = new Database();
        $this->prefix = 'ymc_';
    }

    public function admin_login()
    {

        $this->db->query("SELECT * FROM {$this->prefix}user WHERE email = :email");

        $this->db->bind(':email', 'admin');

        $result = $this->db->resultSet();

        if ($result == null || empty($result)) {
            return false;
        } else {
            return $result;
        }
    }

    public function get_form_table()
    {
        $this->db->query('SELECT * FROM form WHERE status = 1 ORDER BY created_at DESC');

        $result = $this->db->resultSet();

        return $result;
    }

    public function get_name($id)
    {
        $this->db->query("SELECT firstname FROM {$this->prefix}user WHERE user_id = :id");

        $this->db->bind(':id', $id);

        $result = $this->db->single();

        return $result;
    }

    public function change_pw($id, $password)
    {
        $this->db->query("UPDATE {$this->prefix}user SET password = :password WHERE user_id = :id");

        $this->db->bind(':password', $password);
        $this->db->bind(':id', $id);

        $result = $this->db->execute();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delete_form($id)
    {
        $this->db->query('UPDATE form SET status = 0 WHERE id = :id');

        $this->db->bind(":id", $id);

        $result = $this->db->execute();

        return $result;
    }

    public function user_lists(){
        $this->db->query("SELECT * FROM {$this->prefix}user WHERE email != 'admin'");

        return $this->db->resultSet();
    }
}