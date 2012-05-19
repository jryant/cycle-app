<?php
	require 'includes/db.php';
	$page = $_GET['p'];
	if ($page==""){
		$page = "insert";
	}

	function get_pages(){
		global $page;
		$pages = array(
			"insert" => "Insert Entry",
			"view" => "View Logs"
		);
		foreach($pages as $key => $value){
			echo "<li";
			echo ($key == $page) ? " class=\"active\"" : "" ; // DEBUG
			echo "><a href=\"index.php?p=".$key."\">".$value."</a></li>\n"; //  class=\"active\"
		}
	}
	
	function show_page(){
		global $page;
		if ($page){
			include("pages/$page.php");
		} else {
			include("pages/main.php");
		}
	}
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Cycle Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Jason Ryant">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

	<script>
		function submitInsert(){
			var error = 0;
			var year = $('#year').val();
			var month = $('#month').val();
			var day = $('#day').val();
			var date = year+"-"+month+"-"+day;
			var km = $('#km').val();
			var time = $('#time').val();
			var notes = $('#notes').val();
			if (km==""){
				$('#km').parent().addClass("error");
				$('#km').siblings('i').removeClass("hide");
				error++;
			}
			else if ($('#km').parent().hasClass("error")){
				$('#km').parent().removeClass("error");
				$('#km').siblings('i').addClass("hide");
				error--;
			}
			if (time==""){
				$('#time').parent().addClass("error");
				$('#time').siblings('i').removeClass("hide");
				error++;
			}
			else if ($('#time').parent().hasClass("error")){
				$('#time').parent().removeClass("error");
				$('#time').siblings('i').addClass("hide");
				error--;
			}
			if(error==0){
				$("#insert .insert-form").slideUp();
				$("#insert button").button('loading');
				$("#insert .progress").show();
				$.ajax({
					url: "includes/ajax.php",
					type: "POST",
					data: "a=insert&date="+date+"&km="+km+"&time="+time+"&notes="+notes,
					success: function(html){
						$("#insert .progress").hide();
						$("#insert button").hide();
						console.log(html)
						if(html=="1"){
							$("#insert-success").show();
							$("#insert button").button('reset');
						}
						else {
							$("#insert-error").show();
							$("#insert button").button('reset');					
						}
					}
				});
			}
		};
		
		function insert_new(){
			$(".alert").hide();
			$("#insert .insert-form").slideDown();
			$("#insert button").show();
		}
			
		function char_remain(){
			var length = $("#notes").val().length;
			var remain = 120 - length;
			$("#char_remain").text(remain);
		}
		
		function sort_log(order){
			console.log(order);
			$.ajax({
				url: "includes/ajax.php",
				type: "POST",
				data: "a=sort_log&order="+order,
				success: function(html){
					console.log(html)
				}
			});
		}
		
	</script>
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Cycle Tracker</a>
          <div class="nav-collapse">
            <ul class="nav">
				<?php get_pages(); ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

		<?php show_page(); ?>
		
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
	<script src="assets/js/jquery.numeric.js"></script>
	<script>
		$("#km, #time").numeric();
		// $("i.info").popover({
		// 	placement: 'left'
		// });
		$("i.info").tooltip({
			placement: 'left'
		});
	</script>
  </body>
</html>
