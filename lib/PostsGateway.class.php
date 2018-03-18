<?php

class PostsGateway extends AbstractGateway{

public function __construct($connect) {
    parent::__construct($connect);
    $this->table = 'Posts';
    $this->db = 'travel';
 }


// select statement which gives all data
protected function getSelectStatement(){
    return "SELECT PostID, UserID, MainPostImage, Title, Message, PostTime FROM Posts ";
 }
 
// select statement which returns the user id for a post ID
// not sure this is necessary 
protected function getUserIDStatement($postID){
    return "SELECT UserID FROM Posts WHERE PostID = :val ";
} 

// records against which to order the data
protected function getOrderFields() {
    return 'Title, PostTime';
 }
 
 // find the primary key of the table
protected function getPrimaryKeyName() {
    return "PostID";
 }
 
 
 public function findByStatement($choice, $value){
    switch ($choice) {
        case '1':
            $sql = $this-> getUserIDStatement();
            break;
        default:
            $sql =$this->getSelectStatement();
            break;
    }
     if ($value == null) {
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
    }else{
        echo $sql;
        $statement = DatabaseHelper::runQuery($this->connection, $sql, Array(':val' => $value));
    }
    // $statement = DatabaseHelper::runQuery($this->$connection, $sql, Array(':value' => $value));
    return $statement->fetchAll();
 }


}

?>