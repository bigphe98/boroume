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

    public function make_temp_account($email, $password, $firstName, $lastName, $telephone, $location, $residentOf, $AFM, $DOY, $medicalInstitute, $endTerm){
        $query_text = 'CALL add_account(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);'; // this procedure in the db only adds account if the email is not already taken

        $query = $this->db->query($query_text, array($email,$password,$firstName,$lastName, $telephone, $location, $residentOf, $AFM, $DOY, $medicalInstitute, $endTerm));
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

    public function link_parent_to_account($peopleId, $parentFirstName, $parentLastName){
        $query_text = 'CALL link_parent(?, ?, ?);';

        $query = $this->db->query($query_text, array($peopleId, $parentFirstName, $parentLastName));
        return $query->getResult();
    }

    public function get_all_farmers_markets(){
        $query_text = 'SELECT idfarmersMarkets, name, nameGreek, charityName,charityNameGreek, actionDay, timeStart, timeEnd, meetingPoint, superMarketLocation, superMarketLocationGreek,  superMarketMapsLink, spotsTaken, spotsTotal  FROM a23PhaedonLomis.spotsTakenPerMarket';
        $query = $this->db->query($query_text);
        return $query->getResult();
    }

    public function add_new_farmers_market($name, $greekName, $charityName, $greekCharityName, $actionDay, $timeStart, $timeEnd, $meetingPoint, $superMarketLocation, $superMarketLocationGreek, $superMarketMapsLink, $spotsTotal){
        $query_text = 'CALL add_market(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);';

        $query = $this->db->query($query_text, array($name, $greekName, $charityName, $greekCharityName, $actionDay, $timeStart, $timeEnd, $meetingPoint, $superMarketLocation, $superMarketLocationGreek, $superMarketMapsLink, $spotsTotal));
        return $query->getResult();
    }

    public function pickSpotForAt($userID, $marketID, $date){
        $query_text = 'INSERT INTO peopleReservedSpot (idPeople, idFarmersMarket, actionDate) VALUES (?, ?, STR_TO_DATE(?, "%Y-%m-%d"))';
        $query = $this->db->query($query_text, array($userID, $marketID, $date));

        // Check if the INSERT operation was successful
        return $this->db->affectedRows() > 0;
    }

    public function addSpotTaken($marketID){
        $query_text = 'UPDATE farmersMarketsAthens SET spotsTaken = spotsTaken + 1 WHERE idfarmersMarkets = ?';
        $this->db->query($query_text, array($marketID));

        // Check if the UPDATE operation was successful
        return $this->db->affectedRows() > 0;
    }


    public function checkIfSpotsOver($marketID){
        $query = $this->db->query("SELECT areSpotsOver(?) AS result", [$marketID]);
        $row = $query->getRow();
        return $row->result;
    }

    public function getSelectedFarmersMarket($farmersMarketID){
        $query_text = 'SELECT idFarmersMarket, name, nameGreek, charityName, charityNameGreek, actionDate, timeStart, timeEnd, meetingPoint, superMarketLocation, superMarketLocationGreek, superMarketMapsLink FROM farmersMarketsAthens WHERE idFarmersMarkets = ?';
        $query = $this->db->query($query_text, array($farmersMarketID));
        return $query->getResult();
    }


    public function getMySpotsTaken($userID){
        $query_text = 'SELECT idFarmersMarket, actionDate FROM a23PhaedonLomis.peopleReservedSpot where idPeople = ? and actionDate >= curdate();';
        $query = $this->db->query($query_text, array($userID));
        return $query->getResult();
    }

    public function removeMySpot($userID, $marketID, $date){
        $query_text = 'DELETE FROM a23PhaedonLomis.peopleReservedSpot WHERE (idPeople = ? and idFarmersMarket = ? and actionDate = ?)';
        $query = $this->db->query($query_text, array($userID, $marketID, $date));
        return $query->getResult();
    }



}