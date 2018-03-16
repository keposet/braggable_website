<?php

class ImageDetailsGateway extends TableDataGateway{

public function __construct($connect) {
    parent::__construct($connect);
 }


// select statement which gives all data
protected function getSelectStatement(){
    return "SELECT ImageID, UserID, Title, Description, Latitude, Longitude, CityCode, CountryCodeISO, ContinentCode, Path FROM ImageDetails ";
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