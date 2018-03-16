<?php

class ContinentGateway extends AbstractGateway{

public function __construct($connect) {
    parent::__construct($connect);
    $this->table = 'Continents';
    $this->db = 'travel';
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
 
public function findByStatement($choice){
    switch ($choice) {
        case '1':
            $sql = $this-> getIDNameStatement();
            break;
        case '2':
            $sql =$this->getIDNameWithPicturesStatement();
            break;
        
        default:
            $sql =$this->getSelectStatement();
            break;
    }
    
    $statement = DatabaseHelper::runQuery($this->$connection, $sql, null);
    return $statement->fetchAll();
} 

} 

?>