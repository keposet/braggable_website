<?php

class ContinentGateway extends TableDataGateway{

public function __construct($connect) {
    parent::__construct($connect);
 }


// select statement which gives all data
protected function getSelectStatement(){
    return "SELECT ContinentCode, ContinentName, GeoNameId FROM Continents ";
 }

protected function getIDNameStatement(){
    return "SELECT ContinentCode, ContinentName FROM Continents ";
}

protected function getIDNameWithPicturesStatement(){
    return $this->getIDNameStatement(). "INNER JOIN ImageDetails ON Continents.ContinentCode = ImageDetails.ContinentCode GROUP BY ".$this->getOrderFields();
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