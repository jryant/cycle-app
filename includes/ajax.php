<?php
	$action = $_POST['a'];
	switch ($action){
		case 'sort_log':
			// mysql_connect("jrappdb.db.4982551.hostedresource.com","jrappdb","jR@pP2O!2") or die("Could not connect to MySQL server: ".mysql_error());
			// mysql_select_db("jrappdb") or die("Could not connect to MySQL database: ".mysql_error());
			// 		
			// $order = $_POST['order'];
			// $query = "SELECT * FROM `cycle_data` ORDER BY $order DESC";
			// $result = mysql_query($query) or die(mysql_error());
			// if (mysql_num_rows($result)>1){
			// 	table_head();
			// 	while ($entry = mysql_fetch_array($result)){
			// 		$date = strftime("%a, %b %e",strtotime($entry['date']));
			// 		echo "<tr>\n\t";
			// 		echo "<td>".$date."</td>\n\t";
			// 		echo "<td>".$entry['km']." km</td>\n\t";
			// 		echo "<td>".format_time($entry['time'])."</td>\n";
			// 		echo ($entry['notes']) ? "<td><i class=\"icon-list-alt info\" rel=\"popover\" data-content=\"".$entry['notes']."\" data-original-title=\"Ride Notes\"></i></td>\n\t" : "<td>&nbsp;</td>\n\t" ;
			// 		echo "</tr>";
			// 	}
			// 	echo "\t</tbody>\n</table>";
			// }
			break;
		case 'insert':
			mysql_connect("jrappdb.db.4982551.hostedresource.com","jrappdb","jR@pP2O!2") or die("Could not connect to MySQL server: ".mysql_error());
			mysql_select_db("jrappdb") or die("Could not connect to MySQL database: ".mysql_error());

			$date = $_POST['date'];
			$km = $_POST['km'];
			$time = $_POST['time'];
			$notes = $_POST['notes'];

			$query = "INSERT INTO `jrappdb`.`cycle_data` (date,km,time,notes) VALUES ('$date','$km','$time','$notes')";
			$result = mysql_query($query) or die(mysql_error());

			echo $result;
			break;
	}
?>