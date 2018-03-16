<?php

class ContinentGateway extends TableDataGateway{

public function __construct($connect) {
    parent::__construct($connect);
 }


// select statement which gives all data
protected function getSelectStatement(){
    return "SELECT ContinentCode, ContinentName, GeoNameId FROM Continents ";
 }

// records against which to order the data
protected function getOrderFields() {
    return 'ContinentName';
 }
 
 // find the primary key of the table
protected function getPrimaryKeyName() {
    return "ContinentCode";
 }
} 

?>