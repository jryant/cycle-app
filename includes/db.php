<?php
	mysql_connect("jrappdb.db.4982551.hostedresource.com","jrappdb","jR@pP2O!2") or die("Could not connect to MySQL server: ".mysql_error());
	mysql_select_db("jrappdb") or die("Could not connect to MySQL database: ".mysql_error());
	echo "<script>console.log('Connected!');</script>";
?>