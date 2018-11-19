<?php
  require_once("DBvars.php5");

  class MainDB extends DBvars{

    private static $connectlink;    //Database Connection Link
    private $resultlink;    //Database Result Recordset link
    private $rows;        //Stores the rows for the resultset
    private static $mainDataStore;


    public function __construct(){
       try {
           //self::$connectlink = new PDO("sqlsrv:Server=MUNISH-HP\SQLEXPRESS;Database=ezae", 'sa', 'password');
           self::$connectlink = new PDO("mysql:dbname=" . $this->database . ";host=" . $this->hostname ,$this->username,$this->password);
       } catch (PDOException $e) {
            die("Database Connection Failed: " . $e->getMessage());
       }
    }

     public static function getInstance()
        {
            if (!self::$mainDataStore)
            {
                self::$mainDataStore = new MainDB();
                return self::$mainDataStore;
            }
            return self::$mainDataStore;
     }

     public static function getConnection(){
         return self::$connectlink;
     }

     public function getLastInsertedId(){
        return self::$connectlink->lastInsertId();
     }
     public function executeQuery($sql,$parms){
          $sth = self::$connectlink->prepare($sql);
          $arrObj = new ArrayObject($parms);
          $it = $arrObj->getIterator();
          while( $it->valid() )
          {
            $sth->bindValue($it->key(), $it->current());
            $it->next();
          }
          $sth->execute();
          $error = $sth->errorInfo();
          if($error[2] <> ""){
              throw new Exception($error[2]);
          }
          $row = $sth->fetchAll();
          return $row;
      }


  }
?>
