<?php

class PostsGateway extends TableDataGateway{

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
    return "SELECT UserID FROM Posts WHERE PostID = $postID ";
} 

// records against which to order the data
protected function getOrderFields() {
    return 'Title, PostTime';
 }
 
 // find the primary key of the table
protected function getPrimaryKeyName() {
    return "PostID, UserID";
 }
 
 public function findByStatement($choice, $value){
    switch ($choice) {
        case '1':
            $sql = $this-> getIDNameStatement($value);
            break;
        default:
            $sql =$this->getSelectStatement();
            break;
    }
    
    $statement = DatabaseHelper::runQuery($this->$connection, $sql, Array(':value' => $value));
    return $statement->fetchAll();
 }


}

?>