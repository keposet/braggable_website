<?php


class UsersLoginGateway extends TableDataGateway{

public function __construct($connect) {
    parent::__construct($connect);
    $this->table = 'UsersLogin';
    $this->db = 'travel';
 }


// select statement which gives all data
protected function getSelectStatement(){
    return "SELECT UserID, UserName, Password, Salt, State, DateJoined, DateLastModified FROM UsersLogin ";
 }

// records against which to order the data
protected function getOrderFields() {
    return 'UserName';
 }
 
 // find the primary key of the table
protected function getPrimaryKeyName() {
    return "UserID";
 }
}

?>