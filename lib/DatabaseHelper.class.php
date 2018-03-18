<?php
/*
   Adapter class for the PDO API. This version is quite simple, in that it doesn't make
   use of an interface
*/
class DatabaseHelper {
	
 // Create the connection to the database
 public static function createConnectionInfo($values=array()) {
 // pass in the connection string, username, and password as array
    $connString = $values[0];
    $user = $values[1];
    $password = $values[2];
    $pdo = new PDO($connString,$user,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
 }
 
 // run an SQL query and return the cursor to the database
 // sql can be used without protection because it will come from a gateway class
 // protection must be used whenever a user can input query data
        //IE all "single-item" pages
 public static function runQuery($connection, $sql, $parameters=array()) {
    //  print_r($parameters);
    //  echo "line 25";
    //  echo '<br>';
 // Ensure parameters are in an array
     if (!is_array($parameters)) {
        $parameters = array($parameters);
        // print_r($parameters);
     }
     
    //  print_r($parameters);
    //  echo "line 33";
    //  echo '<br>';
     $statement = null;
     if (count($parameters) > 0) {
     // Use a prepared statement if parameters
        $statement = $connection->prepare($sql);
        print_r($statement);
        print_r($parameters);
        $statement->execute($parameters);
        
        $executedOk = $statement->execute($parameters);
         if (! $executedOk) {
            throw new PDOException;
            }
     } else {
     // Execute a normal query
     $statement = $connection->query($sql);
     if (!$statement) {
        throw new PDOException;
        }
     }
        return $statement;
     }
}

?>
