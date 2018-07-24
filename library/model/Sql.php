<?php
 
class Sql {
    protected $dbh;
    private $error;
    protected $result;
 
    /** Connects to database **/
 
    function connect($host, $user, $password, $database, $options = []) {
        $dsn = "mysql:host=" . $host . ";dbname=" . $database . ";charset=utf8mb4";
        try {
            $this->dbh = new PDO($dsn, $user, $password, $options);
        }
        // Catch any errors
        catch(PDOException $e) {
            $this->error = $e->getMessage();
        }
    }
 
    /** Disconnects from database **/
 
    function disconnect() {
        $this->dbh = null;
    }
     
    function all() {
        $query = "SELECT * FROM " . $this->table;
        return $this->dbh->query($query)->fetchAll(PDO::FETCH_CLASS);
    }
     
    function find($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id=:id";
        $stmt = $this->dbh->prepare($query);
        $stmt->execute([":id" => $id]);
        return $stmt->fetchAll(PDO::FETCH_CLASS);;    
    }

    function saveBla($values) {
        $ak = array_keys($values);
        $newOne = [];
        foreach ($values as $key => $value) {
            $newOne[":".$key] = $value;
        }
        try {
            $stmt = $this->dbh->prepare("INSERT INTO " . $this->table . "(" . implode(',', $ak) . ") VALUES(". implode(',', array_keys($newOne)) .")");
            $stmt->execute($newOne);
        }
        // Catch any errors
        catch(PDOException $e) {
            $this->error = $e->getMessage();
        }

        return $stmt->rowCount();
    }

    /** Custom SQL Query **/
 
    function query($query, $singleResult = 0) {
 
        // $this->_result = mysql_query($query, $this->_dbHandle);
 
        // if (preg_match("/select/i",$query)) {
        // $result = array();
        // $table = array();
        // $field = array();
        // $tempResults = array();
        // $numOfFields = mysql_num_fields($this->_result);
        // for ($i = 0; $i < $numOfFields; ++$i) {
        //     array_push($table,mysql_field_table($this->_result, $i));
        //     array_push($field,mysql_field_name($this->_result, $i));
        // }
 
         
        //     while ($row = mysql_fetch_row($this->_result)) {
        //         for ($i = 0;$i < $numOfFields; ++$i) {
        //             $table[$i] = trim(ucfirst($table[$i]),"s");
        //             $tempResults[$table[$i][$field[$i] = $row[$i];
        //         }
        //         if ($singleResult == 1) {
        //             mysql_free_result($this->_result);
        //             return $tempResults;
        //         }
        //         array_push($result,$tempResults);
        //     }
        //     mysql_free_result($this->_result);
        //     return($result);
        // }
         
 
    }
 
    /** Get number of rows **/
    function getNumRows() {
        return mysql_num_rows($this->_result);
    }
 
    /** Free resources allocated by a query **/
 
    function freeResult() {
        mysql_free_result($this->_result);
    }
 
    /** Get error string **/
 
    function getError() {
        return mysql_error($this->_dbHandle);
    }
}