<?php
	$name=$place->name;
	echo '<div class="placeName">'.$name.'</div>';


	$placeId=$place['place_id'];
	$placeById=simplexml_load_file("http://www.43places.com/service/get_place_by_id?api_key=1234&id=".$placeId);
	$currentPlace=simplexml_load_file("http://www.43places.com/service/get_places_photos?api_key=1234&id=$placeId");
	$photos=$currentPlace->photos;

	/*
	echo '<div id="galleria" style="width:620px">';
		foreach ($photos->photo_set as $photo)
		{
			$url=$photo->square;
			echo "<a href='$url'>";
			echo "<img title='$url'  src='$url'>";
			echo "</a>";
		}
	echo '</div>';
	*/

	$ancestors=$placeById->ancestors;
	$currentName=$name;
	echo "<ul>";
	foreach($ancestors->ancestor as $currentAncescestor)
	{
		echo "<li>".$currentName." is found in ".$currentAncescestor."</li>";
		$currentName=$currentAncescestor;
	}
	echo "</ul>";

	$children=$placeById->children;
	if ($children->child)
	{
		echo $name." contain the following places:";
		echo '<ul>';
		foreach ($children->child as $child)
		{
			echo '<li><a href="index.php?showPlace='.$child['id'].'">'.$child.'<a></li>';
		}
		echo '</ul>';
	}

?>
