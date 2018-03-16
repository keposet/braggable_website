<?php

class PostsGateway extends TableDataGateway{

public function __construct($connect) {
    parent::__construct($connect);
 }


// select statement which gives all data
protected function getSelectStatement(){
    return "SELECT PostID, UserID, MainPostImage, Title, Message, PostTime FROM Posts ";
 }

// records against which to order the data
protected function getOrderFields() {
    return 'Title, PostTime';
 }
 
 // find the primary key of the table
protected function getPrimaryKeyName() {
    return "PostID,UserID";
 } 
}

?>