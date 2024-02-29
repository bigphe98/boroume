<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;
use CodeIgniter\Validation\ValidationInterface;

class UserModel extends Model
{
    protected $person1;

    protected $table ;
    protected $primaryKey ;
    protected $allowedFields;
    public function __construct()
    {
        parent::__construct();
        $this->table = 'people';
        $this->primaryKey = 'peopleId';
        $this->allowedFields = ['peopleEmailAddress', 'peoplePassword' , 'peopleTelephoneNumber', 'peopleFirstName', 'peopleLastName','peopleLocation'];


    }

    public function getTableName(){
        return $this->table;
    }

}