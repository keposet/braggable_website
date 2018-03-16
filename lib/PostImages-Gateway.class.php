<?php

class PostImagesGateway extends TableDataGateway{

public function __construct($connect) {
    parent::__construct($connect);
 }


// select statement which gives all data
protected function getSelectStatement(){
    return "SELECT ImageID, PostID FROM PostImages ";
 }
 
protected function getAssociatedImagesStatement($post){
    return "SELECT ImageID FROM PostImages WHERE PostID = $post ";
} 

// records against which to order the data
protected function getOrderFields() {
    return 'PostID, ImageID';
 }
 
 // find the primary key of the table
protected function getPrimaryKeyName() {
    return "PostID, ImageID";
 }
} 


?>