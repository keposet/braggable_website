<?php


class UsersLoginGateway extends AbstractGateway{

public function __construct($connect) {
    parent::__construct($connect);
    $this->table = 'UsersLogin';
    $this->db = 'travel';
 }


// select statement which gives all data
protected function getSelectStatement(){
    return "SELECT UserID, UserName, Password, Salt, State, DateJoined, DateLastModified FROM UsersLogin ";
 }

// records against which to order the data
protected function getOrderFields() {
    return 'UserName';
 }
 
 // find the primary key of the table
protected function getPrimaryKeyName() {
    return "UserID";
 }
 
protected function getIDByUserName(){
    // WORKS return "SELECT UserID FROM UsersLogin WHERE UserName = 'luisg@embraer.com.br'";
    
    return "SELECT UserID FROM UsersLogin WHERE UserName = :val";
    //^^ doesn't work. 
}

protected function getSaltByID(){
    return "SELECT Salt FROM UsersLogin WHERE UserID = :val";
}

protected function getIDByPass(){
    return "SELECT UserID FROM UsersLogin WHERE Password = :val";
}

public function findByStatement($choice, $value){
    switch ($choice) {
        case '1':
            $sql = $this->getIDByUserName();
            // echo $sql;
            // echo "<br>";
            break;
        case '2':
            $sql = $this->getSaltByID();
            break;
        case '3':
            $sql = $this->getIDByPass();
            break;
        
        default:
            $sql = $this->getSelectStatement();
            break;
    }
      if ($value == null) {
        $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
        echo "null value";
    }else{
        // echo $sql;
        //     echo "<br>";
            $parameters = array(':val' => $value);
            // print_r($parameters); this works
        $statement = DatabaseHelper::runQuery($this->connection, $sql, $parameters);
    }
    return $statement->fetchAll();
}

}
?>