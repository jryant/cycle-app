<h1>Insert New Entry</h1>

<br/>

<div id="insert-success" class="alert alert-success hide">
	<button class="close" data-dismiss="alert">×</button>
	<i class="icon-ok-sign"></i> <strong>Success!</strong> Your ride entry has been added!
</div>

<div id="insert-error" class="alert alert-error hide">
	<button class="close" data-dismiss="alert">×</button>
	<i class="icon-exclamation-sign"></i> <strong>Error!</strong> Something went wrong.
</div>

<form id="insert" onSubmit="submitInsert();return false;">
	<fieldset>
		<div class="control-group">
			<!-- <label class="control-label">Date</label> -->
			<div class="controls">
				<select name="month" class="span2" id="month" size="1">
					<?php
						$months = array(
							1 => "Jan", 2 => "Feb", 3 => "Mar", 4 => "Apr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Aug", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dec"
						);
						for($m=1;$m<=12;$m++){
							echo "<option value=\"".str_pad($m,2,"0",STR_PAD_LEFT)."\"";
							echo (date('n') == $m) ? " selected=\"selected\"" : "" ;
							echo ">".$months[$m]."</option>\n";
						}								
					?>
				</select><select name="day" class="span2" id="day" size="1">
					<?php
						for($d=1;$d<=31;$d++){
							echo "<option value=\"".str_pad($d,2,"0",STR_PAD_LEFT)."\"";
							echo (date('j') == $d) ? " selected=\"selected\"" : "" ;
							echo ">$d</option>\n";
						}								
					?>
				</select><select name="year" class="span2" id="year" size="1">
					<option value="2012" selected="selected">2012</option>
				</select>
			</div>
		</div>
		<div class="control-group input-append">
			<!-- <label for="km">Distance</label> -->
			<input id="km" class="span2" type="tel" maxlength="3" name="km" placeholder="Distance"><span class="add-on">km</span>
		</div>
		<div class="control-group input-append">
			<!-- <label for="km">Distance</label> -->
			<input id="time" class="span2" type="tel" maxlength="3" name="time" placeholder="Time"><span class="add-on">mins</span>
		</div>
		<div class="control-group input-append">
			<input id="notes" class="span3" type="text" maxlength="255" name="notes" placeholder="Notes" onKeyUp="char_remain();"><span id="char_remain" class="add-on">120</span>
		</div>
		<button type="submit" class="btn btn-primary" data-loading-text="Inserting...">Insert</button>			
	</fieldset>
</form>
