<?php
	require_once('facebook/src/facebook.php');
	include 'reqs.php';

	/*
        $facebook = new Facebook(array(
                'appId' => '446717918677512',
                'secret' => 'b6d57e3ed27d912291e6bf95fff23fbd',
                'cookie' => true
        ));
        $user=$facebook->getUser();
        */
	
	if ($_POST['searchPlace'])
	{
		$name= empty($_POST['place'])? "*":$_POST['place'];
		$places=simplexml_load_file("http://www.43places.com/service/search_places?api_key=1234&q=$name");
	}
	else if ($_GET['showPlace'])
	{
		$placeId=$_GET['showPlace'];
		$places=simplexml_load_file("http://www.43places.com/service/get_place_by_id?api_key=1234&id=".$placeId);
		if ($_GET['highRes']=="true")
			$highRes=1;
		else
			$highRes=0;
	}
?>
<html>
	<head>
		<title>Test</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
                <script src="js/galleria-1.2.7.min.js"></script>
                <script src="js/galleria.history.min.js"></script>
		<script type="text/javascript">
		      WebFontConfig = {
			google: { families: [ 'Francois One', 'Droid Serif','Tangerine' ] }
		      };
		      (function() {
			var wf = document.createElement('script');
			wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
			    '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
			wf.type = 'text/javascript';
			wf.async = 'true';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(wf, s);
		      })();
			Galleria.loadTheme('js/classic/galleria.classic.min.js');
		</script>
		<style>
            		.content{color:#777;font:12px/1.4 "helvetica neue",arial,sans-serif;width:620px;margin:20px auto;}
            		#galleria{height:320px}
		</style>


	</head>
	<body>
	
		<div align="center">
			<form method="POST" action="index.php">
				Seach a Place:<input type="text" name="place"><input type="submit" name="searchPlace" Value="Search"/><br/>
				e.g. Mauritius,Europe,United States	
			</form>
			<?php if (empty($_POST['showPlace']) && empty($_GET['searchPlace'])){?>
				<img src ="imgs/flying.gif"/>
			<?php } ?>
		</div>



		<?php
			$galleryId=0;
			if ($_GET['showPlace'])
			{
                               $place=$places; 
				include 'currentPlace.php';
			}
			else
			{
				foreach($places->place as $place)
				{
					include 'currentPlace.php';
				}
			}
		?>
		<script>
			$(document).remove(".galleria-errors");
		</script>
	</body>	
</html>
