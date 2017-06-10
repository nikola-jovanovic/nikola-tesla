<?php
// NOTE: Previous comments in this file have been ommitted - so all the comments are new
// Please refer to the skeleton above for more comments on exactly what is happening

	class User{

		private	$userName;
		private	$institution;
		private	$firstName;
		private	$lastName;
		private	$eMail;
		private	$password;
		private	$site;
		private	$logo;
		private	$priviliges;
		private	$membership;
		private	$address;
		private	$city;
		private	$phoneNumber;
		private	$active;
		private	$c_firstName;
		private	$c_lastName;
		private	$c_phoneNumber;
		private	$c_address;
		private	$c_city;
		private	$c_eMail;
		private	$c_site;
		private	$company;
		private	$c_company;
		private	$about;
		private	$c_about;
		private	$gender;
		private	$c_gender;
		private	$registrationDate;
		private $hash;
		private $properties = array('userName', 'institution', 'firstName', 'lastName', 'eMail', 'password', 'site', 'logo', 'priviliges', 'membership', 'address', 'city', 'phoneNumber', 'active', 'c_firstName', 'c_lastName', 'c_phoneNumber', 'c_city', 'c_address', 'c_eMail', 'c_site', 'company', 'c_company', 'about', 'c_about', 'gender', 'c_gender', 'registrationDate');


		private $dbh;
		private $dbhUpis = array();
		// This is the constructor function definition - it's possible to pass
		// it values just like a normal function, but that isn't demonstrated here
		// These variables will be set for each object that is created using this class

	    public function __construct($con = null, $array = array()) {
	        if(!empty($con)){
	        	$this->dbh = $con;
	        }
	        $this->dbhUpis['cirilica'] = Database::getInstance('cirilica');
	        $this->dbhUpis['latinica'] = Database::getInstance('latinica');
	        foreach($this->properties as $key => $property){
	        	if($property == 'password'){
		        	if (array_key_exists($property, $array)) {
				    	$this->$property = base64_encode($array[$property]);
				    	continue;
					}
				}
				if (array_key_exists($property, $array)) {
				    $this->$property = $array[$property];
				}
	        }
	    }

	    public function get($elem) {
			if(in_array($elem, $this->properties)){
				return $this->$elem;
			}
			else{
				return false;
			}
		}

		public function setDBConnection(Database $con) {
			$this->dbh = $con;
		}
		
		public function checkUserNameExists() {
			$this->dbh->query(array(
				'query' => "SELECT * FROM users WHERE userName = :userName",
				'data' => array('userName' => $this->userName)
				));
			$rows = $this->dbh->rowCount();
			if($rows == 0) return false;
			else return true;
		}

		public function checkMailExists() {
			$this->dbh->query(array(
				'query' => "SELECT * FROM users WHERE eMail = :eMail",
				'data' => array('eMail' => $this->eMail)
				));
			$rows = $this->dbh->rowCount();
			if($rows == 0) return false;
			else return true;
		}

		public function checkActive() {
			if($this->active == '1') return true;
			else return false;
		}
		public function isInstitution() {
			if($this->institution == '1') return true;
			else return false;
		}

		public function setActive() {
			if($this->active == '0'){
				return $this->dbh->query(array(
				'query' => "UPDATE users SET active = '1' WHERE userName = :userName",
				'data' => array(
					'userName' => $this->userName
					)
				)
			);
			}
			else return false;
		}

		public function userToDB($t, Database $con) {
			$this->firstName=preslovljavanje($this->firstName, $t);
			$this->lastName=preslovljavanje($this->lastName, $t);
			$this->address=preslovljavanje($this->address, $t);
			$this->city=preslovljavanje($this->city, $t);
			$this->company=preslovljavanje($this->company, $t);
			$this->opis=preslovljavanje($this->opis, $t);
			return $con->query(array(
				'query' => "INSERT INTO users (userName, institution, firstName, lastName, password, eMail, priviliges, membership, address, city, phoneNumber, active, c_firstName, c_lastName, c_phoneNumber, c_address, c_city, c_eMail, company, c_company, about, c_about, gender, c_gender, registrationDate, hash) VALUES 
						(:userName, '0', :firstName, :lastName, :password, :eMail, DEFAULT , DEFAULT , :address , :city , :phoneNumber , DEFAULT , :c_firstName, :c_lastName, :c_phoneNumber, :c_address, :c_city, :c_eMail, :company, :c_company, :about, :c_about, :gender, :c_gender, DEFAULT, :hash)",
				'data' => array(
					'userName' => $this->userName,
					'firstName' => $this->firstName,
					'lastName' => $this->lastName,
					'eMail' => $this->eMail,
					'password' => $this->password,
					'address' => $this->address,
					'city' => $this->city,
					'phoneNumber' => $this->phoneNumber,
					'c_firstName' => $this->c_firstName,
					'c_lastName' => $this->c_lastName,
					'c_phoneNumber' => $this->c_phoneNumber,
					'c_address' => $this->c_address,
					'c_city' => $this->c_city,
					'c_eMail' => $this->c_eMail,
					'company' => $this->company,
					'c_company' => $this->c_company,
					'about' => $this->about,
					'c_about' => $this->c_about,
					'gender' => $this->gender,
					'c_gender' => $this->c_gender,
					'hash' => $this->hash
					)
				)
			);
		}

		public function institutionToDB($t, Database $con) {
			$this->address=preslovljavanje($this->address, $t);
			$this->city=preslovljavanje($this->city, $t);
			$this->company=preslovljavanje($this->company, $t);
			$this->opis=preslovljavanje($this->opis, $t);
			return $con->query(array(
				'query' => "INSERT INTO users (userName, institution, password, eMail, site, priviliges, membership, address, city, phoneNumber, active, c_phoneNumber, c_address, c_city, c_eMail, c_site, company, c_company, about, c_about, registrationDate, hash) VALUES 
						(:userName, '1', :password, :eMail, :site, DEFAULT , DEFAULT , :address , :city , :phoneNumber , DEFAULT , :c_phoneNumber, :c_address, :c_city, :c_eMail, :c_site, :company, :c_company, :about, :c_about, DEFAULT, :hash)",
				'data' => array(
					'userName' => $this->userName,
					'eMail' => $this->eMail,
					'password' => $this->password,
					'site' => $this->site,
					'address' => $this->address,
					'city' => $this->city,
					'phoneNumber' => $this->phoneNumber,
					'c_phoneNumber' => $this->c_phoneNumber,
					'c_address' => $this->c_address,
					'c_city' => $this->c_city,
					'c_eMail' => $this->c_eMail,
					'c_site' => $this->c_site,
					'company' => $this->company,
					'c_company' => $this->c_company,
					'about' => $this->about,
					'c_about' => $this->c_about,
					'hash' => $this->hash
					)
				)
			);
		}
		public function registerUser() {
			$this->hash = md5(uniqid(rand(), TRUE));
			if($this->userToDB('lat', $this->dbhUpis['latinica'])){
				if($this->userToDB('cir', $this->dbhUpis['cirilica'])) return true;
				else return false;
			}
			else return false;
		} // End registerUser()

		public function registerInstitution() {
			$this->hash = md5(uniqid(rand(), TRUE));
			if($this->dbh->isLatinica()) {
				if($this->institutionToDB('lat', $this->dbh)){
					$dbh = Database::getInstance('cirilica');
					if($this->institutionToDB('cir', $dbh)) return true;
					else return false;
				}
			}
			else{
				if($this->institutionToDB('cir', $this->dbh)){
					$dbh = Database::getInstance('latinica');
					if($this->institutionToDB('lat', $dbh)) return true;
					else return false;
				}
			}
		} // End registerUser()
		public function sendActivationMail() {
			$to      = $this->eMail; // Send email to our user  
			$subject = 'Signup | Verification'; // Give the email a subject   
			$message = ' 
			 
			Thanks for signing up! 
			Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below. 
			 
			------------------------ 
			Username: '.$this->userName.' 
			Password: '.$this->password.' 
			------------------------ 
			 
			Please click this link to activate your account: 
			 
			http://www.yourwebsite.com/activationProcess.php?eMail='.$this->eMail.'&hash='.$this->hash.' 
			 
			'; // Our message above including the link  
			                      
			$headers = 'From:noreply@probajnajbolje.com' . "\r\n"; // Set from headers  
			mail($to, $subject, $message, $headers); // Send our email  
		}

		public function verifyPassword($password) {
			if($password == $this->password) return true;
			else return false;
		} // End verifyPassword()

		public function changePassword($newPassword) {
			// This function assumes you've already verified that the user has
			// permission to change the password - it recieves the new password
			// as an argument, with the old password already registered in $userPassword

			// Connect to database
			$dbLink = mysql_connect($this->dbHost, $this->dbUser, $this->dbPass);
			if(!$dbLink) die("Could not connect to database. " . mysql_error());

			// Select database
			mysql_select_db($this->dbName);

			// Get data
			$query = "update $this->dbUserTable set userPassword = \"$newPassword\" where userName = \"$this->userName\"";
			$result = mysql_query($query);
			
			// Test to make sure query worked
			if(!$result) die("Query didn't work. " . mysql_error());

			// It worked, so update the password stored in the object
			$this->userPassword = $newPassword;

			// Close database connection
			mysql_close($dbLink);		
		} // End changePassword()

		public function displayUserInfo() {
			echo '<b>User ID: </b>' . $this->userID . '<br>';
			echo '<b>User Name: </b>' . $this->userName . '<br>';
			echo '<b>User Password: </b>' . $this->userPassword . '<br>';
		} // End displayUserInfo()

	} // End User class definition

?>