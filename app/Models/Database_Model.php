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

    public function make_temp_account($email, $password, $firstName, $lastName, $telephone, $location, $residentOf, $AFM, $DOY, $medicalInstitute){
        $query_text = 'CALL add_account(?, ?, ?, ?, ?, ?, ?, ?, ?, ?);'; // this procedure in the db only adds account if the email is not already taken

        $query = $this->db->query($query_text, array($email,$password,$firstName,$lastName, $telephone, $location, $residentOf, $AFM, $DOY, $medicalInstitute));
        return $query->getRow()->result;
    }


    public function addToProgram($peopleId, $selectedOptions)
    {
        $query = NULL;
        foreach ($selectedOptions as $option) {
            $query_text = 'CALL add_to_program(?,?);';
            $query = $this->db->query($query_text, array($peopleId, $option));
        }
        return $query->getResult();
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

    public function update_password($password, $email ){
        $query_text = 'UPDATE a23PhaedonLomis.people SET peoplePassword = ? WHERE peopleEmailAddress = ?;';
        $this->db->query($query_text, array($password,$email));
        return $this->db->affectedRows();
    }
}