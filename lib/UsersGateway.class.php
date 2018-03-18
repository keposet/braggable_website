<?php

class UsersGateway extends AbstractGateway{

public function __construct($connect) {
    parent::__construct($connect);
    $this->table = 'Users';
    $this->db = 'travel';
 }


// select statement which gives all data
protected function getSelectStatement(){
    return "SELECT UserID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy FROM Users ";
 }

// records against which to order the data
protected function getOrderFields() {
    return 'FirstName, LastName';
 }
 
protected function getIDFullNameStatement(){
    return "SELECT UserID, FirstName, LastName FROM Users ";
}
 
 // find the primary key of the table
protected function getPrimaryKeyName() {
    return "UserID";
 }
 
 public function findByStatement($choice){
    switch ($choice) {
        case '1':
            $sql = $this-> getIDFullNameStatement();
            break;
        default:
            $sql =$this->getSelectStatement();
            break;
    }
    $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
    return $statement->fetchAll();
 } 
 
}

?>