<?php

class HomeModel
{
    private $db;
    private $prefix;

    public function __construct()
    {
        $this->db = new Database();
        $this->prefix = 'ymc_';
    }

    public function checkUser($email)
    {
        $this->db->query("SELECT * FROM {$this->prefix}user WHERE email = :email");

        $this->db->bind("email", $email);

        $result = $this->db->resultSet();

        if (empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    public function insertUser($data)
    {
        $this->db->query("INSERT INTO {$this->prefix}user (email, password, firstname, lastname) VALUES (:email, :password, :firstname, :lastname)");

        $this->db->bind('email', $data['email']);
        $this->db->bind('password', $data['password']);
        $this->db->bind('firstname', $data['firstname']);
        $this->db->bind('lastname', $data['lastname']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function retriveUser($email)
    {
        $this->db->query("SELECT * FROM {$this->prefix}user WHERE email = :email");

        $this->db->bind("email", $email);

        $result = $this->db->resultSet();

        if (!empty($result)) {
            return $result[0];
        } else {
            return false;
        }
    }

    public function getUser(){

        $this->db->query("SELECT * FROM {$this->prefix}user WHERE user_id = :id");

        $this->db->bind("id", $_SESSION['user_id']);

        return $this->db->resultSet()[0];
    }
}