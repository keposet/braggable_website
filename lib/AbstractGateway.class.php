<?php
/*
  Encapsulates common functionality needed by all table gateway objects.
 
 */
 
abstract class AbstractGateway
{
   // contains connection
   protected $connection;
   protected $table;
   protected $db;
   
   /*
      Constructor is passed a database adapter (example of dependency injection)
   */
   public function __construct($connect) 
   {
      if (is_null($connect) )
         throw new Exception("Connection is null");
         
      $this->connection = $connect;
   }
   
   // ***********************************************************
   // ABSTRACT METHODS
   
   /*
     The name of the table in the database
   */    
   abstract protected function getSelectStatement(); 

   /*
     A list of fields that define the sort order
   */   
   abstract protected function getOrderFields();
   
   /*
     The name of the primary keys in the database ... this can be overridden by subclasses
   */    
   abstract protected function getPrimaryKeyName();
   
   
   // ***********************************************************
   // PUBLIC FINDERS 
   //
   // All of these finders return either a single or array of the appropriate DomainObject subclasses
   //
   
   /*
      Returns all the records in the table
   */
   public function findAll($sortFields=null)
   {
    $sql = $this->getSelectStatement();
    // add sort order if required
    if (! is_null($sortFields)) {
    $sql .= ' ORDER BY ' . $sortFields;
    }
    $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
    return $statement->fetchAll();
   } 
 
   
   /*
      Returns all the records in the table sorted by the specified sort order
   */
   public function findAllSorted($ascending)
   {
    $sql = $this->getSelectStatement() . ' ORDER BY ' .
    $this->getOrderFields();
    if (! $ascending) {
    $sql .= " DESC";
    }
    $statement = DatabaseHelper::runQuery($this->connection, $sql, null);
    return $statement->fetchAll();
   } 

   
   /*
      Returns a record for the specificed ID
   */
  public function findById($id)
{
    $sql = $this->getSelectStatement() . ' WHERE ' .
    $this->getPrimaryKeyName() . '=:id';
   
    $statement = DatabaseHelper::runQuery($this->connection, $sql,
    Array(':id' => $id));
    return $statement->fetch();
} 

public function getFields(){
    $table = $this->table;
    $db = $this ->db;
    $sql = "SELECT column_name FROM information_schema.columns WHERE table_name = '$table' AND table_schema = '$db' ";
    $fields =  DatabaseHelper::runQuery($this->connection, $sql, null);
    $fields = $fields->fetchAll();
    $ret = array();
    foreach($fields as $f){
        array_push($ret, $f[0]); 
    }
    // echo print_r($ret);
 return $ret;   
}
 

}

?>