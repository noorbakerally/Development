<?php
	$name=$place->name;
	echo '<div class="placeName">'.$name.'</div>';

	
	$placeId=$place['place_id'];
	$placeById=simplexml_load_file("http://www.43places.com/service/get_place_by_id?api_key=1234&id=".$placeId);
	$currentPlace=simplexml_load_file("http://www.43places.com/service/get_places_photos?api_key=1234&id=$placeId");
	$photos=$currentPlace->photos;



	if ($photos->photo_set)
	{
		echo '<div id="galleria'.$galleryId.'" style="width:620px;height:320px">';
			foreach ($photos->photo_set as $photo)
			{
				if (!$highRes)
					$url=$photo->square;
				else
					$url=$photo->original;

				echo "<a href='$url'>";
				echo "<img title='$url'  src='$url'>";
				echo "</a>";
			}
		echo '</div>';
		if (!$highRes)
			echo "To view the gallery in higher resolution(take more time to load), click <a href=index.php?showPlace=".$placeId."&highRes=true>here</a>";
                else
			echo "To view the gallery in  lower resolution(take less time to load), click <a href=index.php?showPlace=".$placeId."&highRes=false>here</a>";

			
	}

	$ancestors=$placeById->ancestors;
	$currentName=$name;
	echo "<ul>";
	
	$currentAncesId=$placeId;
	foreach($ancestors->ancestor as $currentAncescestor)
	{
		
	
		echo "<li><a href='index.php?showPlace=".$currentAncesId."'>".$currentName."</a> is found in <a href='index.php?showPlace=".$currentAncescestor['id']."'>".$currentAncescestor."</a></li>";
		$currentName=$currentAncescestor;
		$currentAncesId=$currentAncescestor['id'];
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
<script>
	<?php 
	// Initialize Galleria
	if ($photos->photo_set)
        {
	?>
		Galleria.run('#galleria<?php echo $galleryId; ?>');
	<?php
		$galleryId++;
	}
	?>
</script>

