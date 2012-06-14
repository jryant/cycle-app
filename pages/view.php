<?php

	function format_time($input){
		$time = intval($input);
		$hrs = ($time >= 60) ? floor($time / 60) : 0 ;
		$min = ($time - ($hrs * 60));
		return $hrs.":".$min;
	}

	function table_head(){
		echo "<table id=\"log\" class=\"table table-striped table-bordered\">\n\t<thead>\n\t\t<tr>
			<!-- <th>#</th> -->
			<th>Date</a> <i class=\"icon-chevron-down\"></th>
			<th>Distance</th>
			<th>Time</th>
			<th>Notes</th>
		</tr>\n\t</thead>\n<tbody>\n";
		// <a href=\"#\" onClick=\"sort_log('km');return false;\">
	}
	
	function get_log(){
		$query = "SELECT * FROM cycle_data ORDER BY date DESC";
		$result = mysql_query($query) or die(mysql_error());
		if (mysql_num_rows($result)>0){
			table_head();
			while ($entry = mysql_fetch_array($result)){
				$date = strftime("%a, %b %e",strtotime($entry['date']));
				echo "<tr>\n\t";
				echo "<td>".$date."</td>\n\t";
				echo "<td>".$entry['km']." km</td>\n\t";
				echo "<td>".format_time($entry['time'])."</td>\n";
				// echo ($entry['notes']) ? "<td><i class=\"icon-list-alt info\" rel=\"popover\" data-content=\"".$entry['notes']."\" data-original-title=\"Ride Notes\"></i></td>\n\t" : "<td>&nbsp;</td>\n\t" ;
				echo ($entry['notes']) ? "<td><i class=\"icon-list-alt info\" rel=\"tooltip\" title=\"".$entry['notes']."\"></i></td>\n\t" : "<td>&nbsp;</td>\n\t" ;

				echo "</tr>";
			}
			echo "\t</tbody>\n</table>";
		}
		else {
			echo "<div class=\"alert alert-info\">No records found.</div>";
		}
	}
	
	function get_longest_ride($type,$display){
		$query = "SELECT * FROM cycle_data WHERE $type=(SELECT MAX(`$type`) FROM cycle_data LIMIT 1)";
		$result = mysql_query($query) or die(mysql_error());
		switch ($display){
			case 'table':
				table_head();
				$entry = mysql_fetch_array($result);
				$date = strftime("%a, %b %e",strtotime($entry['date']));
				echo "<tr>\n\t";
				echo "<td>".$date."</td>\n\t";
				echo "<td>".$entry['km']." km</td>\n\t";
				echo "<td>".format_time($entry['time'])."</td>\n";
				echo "<td>".$entry['notes']."</td>\n\t";
				echo "</tr>\n\t</tbody>\n</table>";
				break;
			case 'number':
				$entry = mysql_fetch_array($result);
				echo ($type=="km") ? $entry[$type] : format_time($entry[$type]);
				echo ($type=="km") ? " km" : "" ;
				break;
		}
	}
	
	function count_entries(){
		$query = "SELECT * FROM cycle_data";
		$result = mysql_query($query) or die(mysql_error());
		echo mysql_num_rows($result);
	}

	function get_long_km($km){
		$query = "SELECT * FROM cycle_data";
		$result = mysql_query($query) or die(mysql_error());
		// echo mysql_num_rows($result);
	}
		
?>
<h1>View Logs</h1>

<br/>

<h3>Stats</h3>
<ul>
	<li>Total rides logged: <strong><?php count_entries(); ?></strong></li>
	<li>Longest ride distance: <strong><?php get_longest_ride("km","number"); ?></strong></li>
	<li>Longest ride time: <strong><?php get_longest_ride("time","number"); ?></strong></li>
</ul>

<?php get_long_km(20); // DEBUG ?>

<br/>

<h3>All Rides</h3>	
<?php get_log(); ?>