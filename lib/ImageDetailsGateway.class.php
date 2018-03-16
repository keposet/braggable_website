<?php

class ImageDetailsGateway extends AbstractGateway{

public function __construct($connect) {
    parent::__construct($connect);
    $this->table = 'ImageDetails';
    $this->db = 'travel';
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

//used for retrieving specific data, if a value is not needed supply null 
// 1 is ID and Path, 2 is Filter by Continent, 3 is Filter by Country
//4 is filter by City 5 is filter by User
public function findByStatement($choice, $value){
    switch ($choice) {
        case '1':
            $sql = $this-> getIDPathStatement();
            break;
        case '2':
            $sql =$this-> getAllByContinent($value);
            break;
        case '3':
            $sql =$this-> getAllByCountry($value);
            break;
        case '4':
            $sql =$this-> getAllByCity($value);
            break;
        case '5':
            $sql =$this-> getAllByUser($value);
            break;
        default:
            $sql =$this->getSelectStatement();
            break;
    }
    if ($value == null) {
        $statement = DatabaseHelper::runQuery($this->$connection, $sql, null);
    }else{
        $statement = DatabaseHelper::runQuery($this->$connection, $sql, Array(':val' => $value));
    }
    return $statement->fetchAll();
 }


}

?>