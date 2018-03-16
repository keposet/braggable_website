<?php
class CountriesGateway extends AbstractGateway{

public function __construct($connect) {
    parent::__construct($connect);
    $this->table = 'Countries';
    $this->db = 'travel';
 }


// select statement which gives all data
//used by findall and findbyID
protected function getSelectStatement(){
    return "SELECT ISO, ISONumeric, CountryName, Capital, CityCode, Area, Population, Continent, TopLevelDomain, CurrencyCode, CurrencyName, PhoneCountryCode, Languages, Neighbours, CountryDescription FROM Countries ";
 }
 
protected function getIDCountryNameStatement(){
    return "SELECT ISO, CountryName FROM Countries ";
} 

protected function getIDCountryNameWithPicturesStatement(){
    return $this->getIDCountryNameStatement()."INNER JOIN ImageDetails ON Countries.ISO = ImageDetails.CountryCodeISO GROUP BY ".$this->getOrderFields();
}

// records against which to order the data
protected function getOrderFields() {
    return 'CountryName';
 }
 
 // find the primary key of the table
protected function getPrimaryKeyName() {
    return "ISO";
 }
 
public function findByStatement($choice){
    switch ($choice) {
        case '1':
            $sql = $this-> getIDCountryNameStatement();
            break;
        case '2':
            $sql =$this->getIDCountryNameWithPicturesStatement();
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