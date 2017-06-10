<?php

	class Database {

	    private $host = DB_HOST;
	    private $user = DB_USER;
	    private $pass = DB_PASS;
	    private $cookieDBName = CUR_DB_NAME;
	    private $dbname = array('latinica' => DB_NAME_LAT, 'cirilica' => DB_NAME_CIR);
	    private $curDBName;
	    private $dbh; // databases handler
	    private $stmt; // statement handler
	    private $error; // error handler
	    public static $instance = array();
	 
		// construct method	 
	    private function __construct($dbname = null) {
	    	if(!empty($dbname)){
	    		if($dbname == 'other'){
	    			foreach($this->dbname as $key => $value){
	    				if($this->cookieDBName == $key) continue;
	    				$this->curDBName = $value;
	    			}
	    		}
	    		else{
	    			$this->curDBName = $this->dbname[$dbname];
	    		}
	    		
	    	}
	    	else{
		    	$this->curDBName = $this->dbname[$this->cookieDBName];
			}
			// Set DSN
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->curDBName;
			// Set options
			$options = array(
				PDO::ATTR_PERSISTENT => true,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
			);
			// Create a new PDO instanace
			try {
			    $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
			}
			// Catch any errors
			catch(PDOException $e) {
			    $this->error = $e->getMessage();
			}
	    }

	    static function getInstance($dbname){
            if(!isset(self::$instance[$dbname])){
                self::$instance[$dbname] = new self($dbname);
            }
            return self::$instance[$dbname];
        }

	    // query method
	    public function query( $array = array()) {
	    	if (array_key_exists('query', $array)) {
			    $query = $array['query'];
			}
	    	else {
	    		return false;
	    	}
	    	if (array_key_exists('data', $array)) {
			    $data = $array['data'];
			    $this->stmt = $this->dbh->prepare($query);
		    	return $this->stmt->execute($data);
			}
	    	else {
	    		return $this->stmt = $this->dbh->query($query);
	    	}
		}

		// returns a single record from the database
		public function fetchOne($param, $class = null) {
			switch ($param) {
			    case 'assoc':
			      $type = PDO::FETCH_ASSOC;
			      break;
			    case 'both':
			      $type = PDO::FETCH_BOTH;
			      break;
			    case 'class':
			      $type = PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE;
			      break;
			      case 'obj':
			      $type = PDO::FETCH_OBJ;
			      break;
			    default:
			      $type = PDO::FETCH_ASSOC;
			}
			if (!is_null($class)) {
				$this->stmt->setFetchMode($type, $class);
		    	return $this->stmt->fetch();
		    }
		    else {
		    	$this->stmt->setFetchMode($type);
				return $this->stmt->fetch();
			}
		}

		// returns an array of the result set rows
		public function fetchAll($param, $class = null) {
			switch ($param) {
			    case 'assoc':
			      $type = PDO::FETCH_ASSOC;
			      break;
			    case 'both':
			      $type = PDO::FETCH_BOTH;
			      break;
			    case 'class':
			      $type = PDO::FETCH_CLASS;
			      break;
			      case 'obj':
			      $type = PDO::FETCH_OBJ;
			      break;
			    default:
			      $type = PDO::FETCH_ASSOC;
			  }
		    if (!is_null($class)) {
		    	return $this->stmt->fetchAll($type, $class);
			}
			else {
				return $this->stmt->fetchAll($type);
			}
		}

		// bind method
		public function bind($param, $value, $type = null) {
			if (is_null($type)) {
			  	switch (true) {
				    case is_int($value):
				      $type = PDO::PARAM_INT;
				      break;
				    case is_bool($value):
				      $type = PDO::PARAM_BOOL;
				      break;
				    case is_null($value):
				      $type = PDO::PARAM_NULL;
				      break;
				    default:
				      $type = PDO::PARAM_STR;
			  	}
			}
			$this->stmt->bindValue($param, $value, $type);
		}

		// executes the prepared statement
		public function execute($type = null) {
			if (is_null($type)) {
		    	return $this->stmt->execute();
		    }
		    else {
		    	return $this->stmt->execute($type);
		    }
		}

		public function getUser($userName) {
			if($this->query(array('query' => "SELECT * FROM users WHERE userName= :username", 'data' => array('username' => $userName)))) {
				return $this->fetchOne('class', 'User');
			}
			else return false;
		}

		public function getCommentByID($id) {
			$isInt = filter_var($id, FILTER_VALIDATE_INT, array('options' => array('min_range' => 0)));
			if($isInt == false){
				echo 'nije broj';
				return false;
			} 
			else{
				if($this->query(array('query' => "SELECT * FROM comments WHERE comID = :id", 'data' => array('id' => $id)))) {
					return $this->fetchOne('class', 'Comments');
				}
				else return false;
			}
			
		}

		public function getByID($id) {
			$isInt = filter_var($id, FILTER_VALIDATE_INT, array('options' => array('min_range' => 0)));
			if($isInt == false){
				echo 'nije broj';
				return false;
			} 
			else{
				if($this->query(array('query' => "SELECT type FROM articles WHERE articles.id = :id ", 'data' => array('id' => $id)))) {
					$type = $this->fetchOne('both');
					$this->query(array(
						'query' => "SELECT * FROM $type[0], articles WHERE articles.id = $type[0].id AND $type[0].id = $id ORDER BY date DESC"
					));
					return $this->fetchOne('class', ucwords($type[0]));
				}
				else return false;
			}
			
		}

		public function getAllComments($id, $sort1) {
			$isInt = filter_var($id, FILTER_VALIDATE_INT, array('options' => array('min_range' => 0)));
			if($isInt == false){
				echo 'nije broj';
				return false;
			} 
			else{
				if($this->query(array('query' => "SELECT * FROM comments WHERE id = :id ORDER BY :sort", 'data' => array('id' => $id, 'sort' => $sort1)))) {
					$results['comments'] = $this->fetchAll('class', 'Comments');
					$results['number'] = count($results['comments']);
					return $results;
				}
				else return false;
			}
			
		}

		public function getList($param = array()) {
			if (array_key_exists('type', $param)) {
			    $type = $param['type'];
			}
			else {
				return false;
			}
			if(array_key_exists('offset', $param) && array_key_exists('amount', $param)){
				$offset = $param['offset'];
				$amount = $param['amount'];
				$isIntOffset = filter_var($offset, FILTER_VALIDATE_INT);
				$isIntAmount = filter_var($amount, FILTER_VALIDATE_INT);
				if($isIntOffset == false && $isIntAmount == false){
					echo 'nije broj';
					return false;
				} 
				else{
					if(array_key_exists('published', $param)){
						if($param['published'] == true){
							if($this->query(array('query' => "SELECT * FROM $type, articles WHERE articles.id = $type.id AND published = '1' ORDER BY date DESC LIMIT $offset, $amount"))){
								$results[$type] = $this->fetchAll('class', ucwords($type));
								$results['number'] = count($results[$type]);
								return $results;
							}
							else return false;
						}
						elseif($param['published'] == false){
							if($this->query(array('query' => "SELECT * FROM $type, articles WHERE articles.id = $type.id ORDER BY creationDate DESC LIMIT $offset, $amount"))){
								$results[$type] = $this->fetchAll('class', ucwords($type));
								$results['number'] = count($results[$type]);
								return $results;
							}
							else return false;
						}
					}
					else{
						if($this->query(array('query' => "SELECT * FROM $type, articles WHERE articles.id = $type.id ORDER BY creationDate DESC LIMIT $offset, $amount"))){
							$results[$type] = $this->fetchAll('class', ucwords($type));
							$results['number'] = count($results[$type]);
							return $results;
						}
						else return false;
					}
				}
			}
			else {
				if(array_key_exists('published', $param)){
						if($param['published'] == true){
							if($this->query(array('query' => "SELECT * FROM $type, articles WHERE articles.id = $type.id AND published = '1' ORDER BY date DESC"))){
								$results[$type] = $this->fetchAll('class', ucwords($type));
								$results['number'] = count($results[$type]);
								return $results;
							}
							else return false;
						}
						elseif($param['published'] == false){
							if($this->query(array('query' => "SELECT * FROM $type, articles WHERE articles.id = $type.id ORDER BY date DESC"))){
								$results[$type] = $this->fetchAll('class', ucwords($type));
								$results['number'] = count($results[$type]);
								return $results;
							}
							else return false;
						}
					}
					else{
						if($this->query(array('query' => "SELECT * FROM $type, articles WHERE articles.id = $type.id ORDER BY date DESC"))){
							$results[$type] = $this->fetchAll('class', ucwords($type));
							$results['number'] = count($results[$type]);
							return $results;
						}
						else return false;
					}
			}
		}

		// executes statement and returns number of affected rows
		public function exec($query) {
			return $this->dbh->exec($query);
		}

		// returns the number of effected rows from the previous delete, update or insert statement
		public function rowCount() {
		    return $this->stmt->rowCount();
		}

		// returns the last inserted Id as a string
		public function lastInsertId() {
		    return $this->dbh->lastInsertId();
		}

		//
		public function beginTransaction() {
		    return $this->dbh->beginTransaction();
		}

		//
		public function endTransaction() {
		    return $this->dbh->commit();
		}

		//
		public function cancelTransaction() {
		    return $this->dbh->rollBack();
		}

		// dumps the information that was contained in the Prepared Statement
		public function debugDumpParams() {
		    return $this->stmt->debugDumpParams();
		}

		// closing connection with database
		public function close() {
		    return $this->dbh = NULL;
		}

		public function curDBName(){
		    return $this->curDBName;
		}

		public function isLatinica(){
		    if($this->curDBName == 'nikolatesla_lat') return true;
		    else return false;
		}

		public function isCirilica(){
		    if($this->curDBName == 'nikolatesla_cir') return true;
		    else return false;
		}


















	    // query method
	 //    public function query($query){
		//     $this->stmt = $this->dbh->prepare($query);
		// }

		// private function tableExists($tableName){
		//     $results = $this->dbh->query("SHOW TABLES LIKE '$tableName';");
		//     if(!$results) {
		//         return false;
		//     }
		//     if($results->rowCount()>0){return true;}
		// }

	 //    public function select($rows = '*', $table, $where = null, $order = null) {  
	 //        $q = 'SELECT '.$rows.' FROM '.$table;  
	 //        if($where != null){  
	 //            $q .= ' WHERE '.$where;
	 //        }
	 //        if($order != null){
	 //            $q .= ' ORDER BY '.$order;
	 //        }
	 //        if($this->tableExists($table)){  
		//        	$this->stmt = $this->dbh->prepare($q);
		//        	$this->stmt->execute();
		//         return $result = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	 //        }
	 //        else echo '<p>Ne postoji ta tabela</p>';
	 //    } 

	 //    public function insert($table,$rows = null, $values)  {  
	 //        if($this->tableExists($table))  
	 //        {  
	 //            $insert = 'INSERT INTO '.$table;  
	 //            if($rows != null)  
	 //            {  
	 //                $insert .= ' ('.$rows.')';   
	 //            }  
	  
	 //            for($i = 0; $i < count($values); $i++)  
	 //            {  
	 //                if(is_string($values[$i]))  
	 //                    $values[$i] = '"'.$values[$i].'"';  
	 //            }  
	 //            $values = implode(',',$values);  
	 //            $insert .= ' VALUES ('.$values.')';  
	 //            $this->stmt = $this->dbh->prepare($insert);         
	 //            if($this->stmt->execute())  
	 //            {  
	 //                return true;   
	 //            }  
	 //            else  
	 //            {  
	 //                return false;   
	 //            }  
	 //        }  
	 //    }  
		// public function emptystm(){
		//     $this->stmt = null;
		// }

		//
		

		

		
	}
?>