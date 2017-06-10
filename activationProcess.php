<?php
    error_reporting(0);
    // Include database class
    include 'classes/database.class.php';
    include 'classes/user.class.php';

    if(isset($_GET['eMail']) && !empty($_GET['eMail']) AND isset($_GET['hash']) && !empty($_GET['hash'])){ 
    	$eMail = isset($_GET['eMail']) ? $_GET['eMail'] : '';
        $hash = isset($_GET['hash']) ? $_GET['hash'] : '';
        $dbh = Database::getInstance();
	    $dbh->query(array(
                'query' => "select * from users where eMail = :eMail AND hash = :hash",
                'data' => array(
                    'eMail' => $eMail,
                    'hash' => $hash
                    )
                )
        );
        if($dbh->rowCount() == 1){
        	$user = $dbh->fetchOne('class', 'User');
        	if($user->checkActive()){
        		header('Location: naslovna?activation=true1');
        	}
        	else{
        		// $user->setdbConnection($dbh);
        		if($user->setActive()) header('Location: index.php?activation=true');
        	}
        }
        else{
        	header('Location: index.php?activation=false');
        }
	}
?>