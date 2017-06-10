<?php
	abstract class Article{

			protected $id;
			protected $type;
			protected $title;
			protected $date;
			protected $userName;
			protected $published;
			protected $finished;
			protected $summary;
			protected $content;
			protected $pictures;
			protected $picturesTitle;
			protected $subtittle;
			protected $pluses;
			protected $minuses;
			protected $source;
			protected $updating;
			protected $dbh;

			abstract public function isPublished();
			abstract public function isFinished();
			abstract public function insert();
			abstract public function update();
			abstract public function delete();

	}
?>