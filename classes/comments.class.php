<?php
	class Comments{

			private $comID;
			private $id;
			private $userName;
			private $date;
			private $content;
			private $pluses;
			private $minuses;
			private $dbh;
			private $dbhUpis = array();

			public function __construct($con = null, $array = array()) {
		        if(!empty($con)){
		        	$this->dbh[] = $con;
		        }
		        $this->dbhUpis['cirilica'] = Database::getInstance('cirilica');
		        $this->dbhUpis['latinica'] = Database::getInstance('latinica');
		        foreach($array as $property => $value){
		        	$this->$property = $value;
		        }
		    }
			
			public function get($elem) {
				return $this->$elem;
			}
			
			public function plusesUp() {
				$this->pluses++;
			}

			public function minusesUp() {
				$this->minuses++;
			}

			public function insert() {
				if($this->dbhUpis['latinica']->query(array('query' => 'INSERT INTO comments (id, userName, date, content, pluses, minuses) VALUES (:id, :userName, DEFAULT, :content, DEFAULT, DEFAULT)', 'data' => array( 'id' => $this->id, 'userName' => $this->userName, 'content' => $this->content)))){
					if($this->dbhUpis['cirilica']->query(array('query' => 'INSERT INTO comments (id, userName, date, content, pluses, minuses) VALUES (:id, :userName, DEFAULT, :content, DEFAULT, DEFAULT)','data' => array( 'id' => $this->id, 'userName' => $this->userName, 'content' => $this->content)))) return true;
						else return false;
				}
			}

			public function update() {
				if($this->dbhUpis['latinica']->query(array('query' => 'UPDATE comments SET date = DEFAULT, conntent= :content WHERE comID= :comID', 'data' => array( 'content' => $this->content)))){
					if($this->dbhUpis['cirilica']->query(array('query' => 'UPDATE comments SET date = DEFAULT, conntent= :content WHERE comID= :comID', 'data' => array( 'content' => $this->content)))) return true;
						else return false;
				}
			}

			public function updatePluses() {
				if($this->dbhUpis['latinica']->query(array('query' => 'UPDATE comments SET pluses = :pluses WHERE comID = :comID','data' => array( 'pluses' => $this->pluses, 'comId' => $this->comID)))){
					if($this->dbhUpis['cirilica']->query(array('query' => 'UPDATE comments SET pluses = :pluses WHERE comID = :comID','data' => array( 'pluses' => $this->pluses, 'comId' => $this->comID)))) return true;
						else return false;
				}
			}

			public function updateMinuses() {
				if($this->dbhUpis['latinica']->query(array('query' => 'UPDATE comments SET minuses = :minuses WHERE comID = :comID','data' => array( 'minuses' => $this->minuses, 'comId' => $this->comID)))){
					if($this->dbhUpis['cirilica']->query(array('query' => 'UPDATE comments SET minuses = :minuses WHERE comID = :comID','data' => array( 'minuses' => $this->minuses, 'comId' => $this->comID)))) return true;
						else return false;
				}
			}
	}
?>