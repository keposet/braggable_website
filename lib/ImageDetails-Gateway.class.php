<?php

class ImageDetailsGateway extends TableDataGateway{

public function __construct($connect) {
    parent::__construct($connect);
 }


// select statement which gives all data
protected function getSelectStatement(){
    return "SELECT ImageID, UserID, Title, Description, Latitude, Longitude, CityCode, CountryCodeISO, ContinentCode, Path FROM ImageDetails ";
 }
 
// what do i need? mostly just path and ID 
protected function getIDPathStatement(){
    return "SELECT ImageID, Path FROM ImageDetails ";
}

protected function getAllByContinent($continent){
    return $this->getSelectStatement()."WHERE ContinentCode = $continent";
}

protected function getAllByCountry($country){
    return $this->getSelectStatement()."WHERE CountryCodeISO = $country";
}

protected function getAllByCity($city){
    return $this->getSelectStatement()."WHERE CityCode = $city";
}

protected function getAllByUser($user){
    return $this->getSelectStatement()."WHERE UserID = $user";
}

// records against which to order the data
protected function getOrderFields() {
    return 'Title, CityCode, CountryCodeISO, ContinentCode';
 }
 
 // find the primary key of the table
protected function getPrimaryKeyName() {
    return "ImageID";
 }
}

?>