<?php

namespace App\Models;

class Database_Model
{
    private $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function make_account($email, $password, $firstName, $lastName){
        $query_text = 'CALL add_account(?, ?, ?, ?);'; // this procedure in the db only adds account if the email is not already taken

        $query = $this->db->query($query_text, array($email,$password,$firstName,$lastName));
        return $query->getRow()->result;
    }
}