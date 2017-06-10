<?php
	$id=$_GET['id'];
	$tip=$_GET['tip'];
	$comment = $dbh->getCommentById($id);

	if($tip=="plus"){
		$comment->plusesUp();
		$comment->updatePluses();
	}

	else if ($tip=="minus"){
		$comment->minusesUp();
		$comment->updateMinuses();
	}
?>