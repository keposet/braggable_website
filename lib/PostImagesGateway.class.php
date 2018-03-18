<?php

class PostImagesGateway extends AbstractGateway{

public function __construct($connect) {
    parent::__construct($connect);
    $this->table = 'PostImages';
    $this->db = 'travel';
 }


// select statement which gives all data
protected function getSelectStatement(){
    return "SELECT ImageID, PostID FROM PostImages ";
 }
 
protected function getAssociatedImagesStatement(){
    return "SELECT ImageID FROM PostImages WHERE PostID = :val ";
} 

// records against which to order the data
protected function getOrderFields() {
    return 'PostID';
 }
 
 // find the primary key of the table
protected function getPrimaryKeyName() {
    return "ImageID";
 }

//value should never be null.
 public function findByStatement($choice, $value)
 {
    switch($choice){
        case '1':
            $sql = $this->getAssociatedImagesStatement();
            break;
        default:
            $sql =$this->getSelectStatement();
            break;
    }
    
     if ($value == null) {
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
    }else{
        // echo $sql;
        $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':val' => $value));
    }
    // $statement = DatabaseHelper::runQuery($this->connection, $sql, $null);
    return $statement->fetchAll(); 
 } 

}
?>