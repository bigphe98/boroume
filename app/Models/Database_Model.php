<?php

namespace App\Models;

class Database_Model
{
    private $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function approve_temp_account($peopleId){
        $query_text = 'UPDATE people SET peopleIsVolunteer = 1 WHERE (peopleId = ?);'; // this procedure in the db only adds account if the email is not already taken

        $query = $this->db->query($query_text, array($peopleId));
        return $query->getRow()->result;
    }

    public function make_temp_account($email, $password, $firstName, $lastName, $telephone, $location){
        $query_text = 'CALL add_account(?, ?, ?, ?, ?, ?);'; // this procedure in the db only adds account if the email is not already taken

        $query = $this->db->query($query_text, array($email,$password,$firstName,$lastName, $telephone, $location));
        return $query->getRow()->result;
    }

    public function delete_temp_account($email, $password, $firstName, $lastName){
        $query_text = 'CALL delete_temp_account(?, ?, ?, ?);'; // this procedure in the db only adds account if the email is not already taken

        $query = $this->db->query($query_text, array($email,$password,$firstName,$lastName));
        return $query->getRow()->result;
    }


    public function get_people_unregistered(){
        $query_text = 'SELECT * FROM a23PhaedonLomis.people WHERE peopleIsVolunteer = 0';
        $query = $this->db->query($query_text);
        return $query->getResult();
    }

    public function get_people_registered(){
        $query_text = 'SELECT * FROM a23PhaedonLomis.people WHERE peopleIsVolunteer = 1';
        $query = $this->db->query($query_text);
        return $query->getResult();
    }
}