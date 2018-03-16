<?php
class CitiesGateway extends AbstractGateway{

public function __construct($connect) {
    parent::__construct($connect);
    $this->table = 'Cities';
    $this->db = 'travel';
 }

// select statement which gives all data
protected function getSelectStatement(){
    return "SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone  FROM Cities ";
 }
 
protected function getIDNameStatement(){
    return "SELECT CityCode, AsciiName FROM Cities "; 
}

protected function getIDNameWithPicturesStatement(){
    $sqlStart = "SELECT Cities.CityCode, AsciiName FROM Cities "; 
    $sql = $sqlStart."INNER JOIN ImageDetails ON ImageDetails.CityCode = Cities.CityCode GROUP BY Cities.".$this->getOrderFields();
    //return $this->getIDNameStatement()."INNER JOIN ImageDetails ON ImageDetails.CityCode = Cities.CityCode GROUP BY Cities.".$this->getOrderFields();
    return $sql;
}

// records against which to order the data
protected function getOrderFields() {
    return 'AsciiName';
 }
 
 // find the primary key of the table
protected function getPrimaryKeyName() {
    return "CityCode";
 }
 
 public function findByStatement($choice)
{
    switch($choice){
        case '1':
            $sql = $this->getIDNameStatement();
            break;
        case '2':
            $sql = $this->getIDNameWithPicturesStatement();
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