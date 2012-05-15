<?php
	include 'connect.php';
	$id=$_GET['id'];
	$SQLProduct="select id,name,description,currency,price,userId,salesType from product where id=$id";
	$resultProduct=mysql_query($SQLProduct);
	$rowProduct=mysql_fetch_array($resultProduct);		
	$SQLPics="SELECT url FROM pics WHERE productId=$id";
	$resultPics=mysql_query($SQLPics);

?>
<span class="showProductName"><?php echo $rowProduct['name']; ?></span>
<br/><br/>
<div class="showProductPics">
	<?php while ($rowPics=mysql_fetch_array($resultPics)) {?>
		<a href="<?php echo $rowPics['url']; ?>" rel="fancybox-thumb" class="showProductImgs">
		  <img src="<?php echo $rowPics['url']; ?>" style="width:160px;height:160px" class="showProductPics"/>
		</a>
	<?php }?>
</div>
<br/>
<div class="showDescription"><?php echo $rowProduct['description']; ?></div>
<br/>
<span class="showProductPrice">Price: <?php echo $rowProduct['currency']; ?><?php echo $rowProduct['price']; ?></span>
<br/><br/>
<br/>
<span class="showProductOwner">Posted by <a href="#">Username</a></span>
<br/>
<script type="text/javascript">
	$(".showProductImgs").fancybox({
		prevEffect	: 'none',
		nextEffect	: 'none',
		helpers	: {
			title	: {
				type: 'outside'
			},
			overlay	: {
				opacity : 0.8,
				css : {
					'background-color' : '#000'
				}
			},
			thumbs	: {
				width	: 50,
				height	: 50
			}
		}
	});
</script>

<br/>
<div id="allComments">

</div>

<span class="siteMsg">Enter your Question or Comment:</span><br/>
<textarea name="comment" id="newComment" style="width:500px;height:150px"></textarea>
<input type="button" value="Submit" class="wholeButton" onClick="addComment('<?php echo $id; ?>')">
