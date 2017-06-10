<?php
	class News extends Article{

			protected $projectID;

			public function __construct($con = null, $array = array()) {
		        if(!empty($con)){
		        	$this->dbh = $con;
		        }
		        foreach($array as $property => $value){
		        	$this->$property = $value;
		        }
		    }

		    public function isPublished(){
		    	if($this->published == '1') return true;
		    	else return false;
		    }

			public function isFinished(){
				if($this->finished == '1') return true;
		    	else return false;
			}
			
			public function get($elem) {
				return $this->$elem;
			}
			
			public function insert(){}
			public function update(){}
			public function delete(){}			
	}
?>