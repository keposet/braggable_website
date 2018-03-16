<?php
class CitiesGateway extends TableDataGateway{

public function __construct($connect) {
    parent::__construct($connect);
 }


// select statement which gives all data
protected function getSelectStatement(){
    return "SELECT CityCode, AsciiName, CountryCodeISO, Latitude, Longitude, Population, Elevation, TimeZone  FROM Cities ";
 }

// records against which to order the data
protected function getOrderFields() {
    return 'AsciiName';
 }
 
 // find the primary key of the table
protected function getPrimaryKeyName() {
    return "CityCode";
 }

}

?>