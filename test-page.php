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
    /*
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
    */
    
    $result = new ContinentGateway($connection);
    $cntIDName = $result -> findByStatement(2);
    $result = new CountriesGateway($connection);
    $cntryIDName = $result -> findByStatement(2);
    $result = new CitiesGateway($connection); 
    $ctyIDName = $result -> findByStatement(2);
    
    
/*    
    $result = new ImageDetailsGateway($connection);

    $bool = True;
    $rID = "CA";
    
    $all = $result ->findall();
    $allSorted = $result ->findallsorted($bool);
    $findID = $result ->findbyID($rID);
    // $findBy1 = $result ->findByStatement('1','luisg@embraer.com.br');
    // $findBy2 = $result ->findByStatement('2', '1');
    $findBy3 = $result ->findByStatement('3', "CA");
    // $findBy2 = $result ->findByStatement('2', 'NA');
    // $findBy3 = $result ->findByStatement('3', 'CA');
    // $findBy4 = $result ->findByStatement('4', '5913490');
    // $findBy5 = $result ->findByStatement('5', '1');
    $fields = $result ->getFields();
*/    
    
    
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

function populateDropDown($records, $id){
    foreach ($records as $r) {
        $code = $r[0];
        $name = $r[1];
        echo "<option id= $id$code value = $code>$name</option>";
                            
        }
}

function opDropDownStructure($choice, $record){
    switch ($choice){
        case "continent":
            $ddName = "cnt";
            $ddID = "cntDD";
            $defOption = "Continent";
            
            break;
        case "country":
            $ddName = "cntry";
            $ddID = "cntryDD";
            $defOption = "Country";
            
            break;
        case "city":
            $ddName = "city";
            $ddID = "ctyDD";
            $defOption = "City";
            
            break;
    }
    echo "<select name = $ddName id= $ddID>";
    echo "<option value =0>$defOption</option>";
    populateDropDown($record,$ddID);
    echo "</select>";
}

?>

<!DOCTYPE html>
<html>
    <body>
        
        <div>
            <form action="test-page.php" method = GET>
                
             
                    <?php
                    opDropDownStructure("continent", $cntIDName);
                    opDropDownStructure("country", $cntryIDName);
                    opDropDownStructure("city", $ctyIDName);
                       /* foreach ($idName as $parent) {
                            
                                $code = $parent[0];
                                $name = $parent[1];
                                $id = "cntDD$code"; 
                                echo "<option id= $id value = $code>$name</option>";
                            
                        }*/
                    ?>
                    
                    
                    
                
                <input type="submit" value="Submit"/>
            </form>
            <?php
            //   print_r($idName);
            ?>
            
            
        </div>
        <?php
       // $test = "UsersLogin";
        
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
        
        
        echoString("All $test");
        insertBR();
        iterateThruStmt($all ,$fields);
        
        echoString("All $test Sorted");
        insertBR();
        iterateThruStmt($allSorted,$fields);
        
        echoString("$test By ID");
        insertBR();
        iterateSingleRecord($findID,$fields);
        
        
        echoString("$test ID by Username");
        insertBR();
        iterateThruStmt($findBy1,Array('0'));
        print_r($findBy1);
        
        echoString("$test Salt by ID");
        insertBR();
        iterateThruStmt($findBy2,Array('0'));
         print_r($findBy2);
         
        
        echoString("$test ID by Password");
        insertBR();
        iterateThruStmt($findBy3,$fields);
         print_r($findBy3);
        
        echoString("Filter $test by Continent");
        insertBR();
        iterateThruStmt($findBy2,$fields);
        
        echoString("Filter $test by Country");
        insertBR();
        iterateThruStmt($findBy3,$fields);
        
        echoString("Filter $test by City");
        insertBR();
        iterateThruStmt($findBy4,$fields);
        
        echoString("Filter $test by User");
        insertBR();
        iterateThruStmt($findBy5,$fields);*/
        
        
        ?>
    </body>
</html>