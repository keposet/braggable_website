<?php
require 'includes/travel-dbConfig.inc.php'; 
// database helper sets up connection to the database and returns a connection
//travel-dbConfig creates a new connection which can be accessed via $connection
// each class has findall, findallsorted, and findbyID
// specific classes use different methods as well

// to use i put connection into the constructor 
// finder methods use the constructor. get methods just return the select statements 
// therefore i need a way to run the custom gets to the DB


try {
    $cities = new CitiesGateway($connection);
    $allCities = $cities->findall();
    $bool = True;
    $allCitiesSorted = $cities->findAllSorted($bool);
    $cID = 251833;
    $cityIDName = $cities->findByStatement('1');
    $cityIDNamePic = $cities->findByStatement('2');
    $cityFields = $cities-> getFields();
    
    $countries = new CountriesGateway($connection);
    $all = $countries ->findall();
    $cID = "AD";
    $allSorted = $countries ->findallsorted($bool);
    $findID = $countries ->findbyID("AD");
    $allIDName = $countries ->findByStatement('1');
    $allIDNamePic = $countries ->findByStatement('2');
    $fields = $countries ->getFields();
    
    
    
    
} catch (Exception $e ) {
    die($e ->getMessage()); 
} finally{
    $connection = null;
}


function insertBR(){
    echo "</br>";
}

function echoString($text){
    echo $text; 
}

function iterateThruStmt($record, $fields){
    
     foreach ($record as $v) {
            foreach ($fields as $f) {
                echo $v[$f]." ";
                
            }
        insertBR();
        }
}
function iterateSingleRecord($record, $fields){
    foreach($fields as $f){
        echo $record[$f]." ";
    }
    insertBR();
}






?>

<!DOCTYPE html>
<html>
    <body>
        <?php
        /*
        echoString("Cities Find All");
        insertBR();
        insertBR();
        insertBR();
        insertBR();
        iterateThruStmt($allCities, $cityFields);
        
        
        echoString("Cities Find All Sorted");
        insertBR();
        insertBR();
        insertBR();
        insertBR();
        iterateThruStmt($allCitiesSorted, $cityFields);
        
        
       
        echoString("Cities findByStatement 1");
        insertBR();
        iterateThruStmt($cityIDName, Array('0','1'));
        
        
        
        echoString("Cities findByStatement 2");
        insertBR();
        iterateThruStmt($cityIDNamePic, Array('0','1'));
        */
        /*
        echoString("All Countries");
        insertBR();
        iterateThruStmt($all ,$fields);
        */
        /*
        echoString("All Sorted");
        insertBR();
        iterateThruStmt($allSorted,$fields);
        */
        /*
        echoString("By ID");
        insertBR();
        iterateSingleRecord($findID,$fields);
        */
        
        echoString("ID and Name");
        insertBR();
        iterateThruStmt($allIDName,Array('0','1'));
        
        
        echoString("Filter by Pics");
        insertBR();
        insertBR();
        insertBR();
        insertBR();
        insertBR();
        insertBR();
        iterateThruStmt($allIDNamePic,Array('0','1'));
        
        
        ?>
    </body>
</html>