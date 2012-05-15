var prefix="";
	
function empty(elem, helperMsg)
{
	elem=new String(elem);
	if(elem.length == 0){
		alert(helperMsg+" cannot be empty");
		return true;
	}
	return false;
}

function isNumeric(elem, helperMsg)
{
	if (empty(elem,helperMsg)) return false;

	elem=new String(elem);
	var numericExpression = /^[0-9]+$/;
	if(elem.match(numericExpression)){
		return true;
	}else{
		alert(helperMsg+" should contain only numbers");
		return false;
	}
}

function isSelected(elem,name){
	if (elem=="0")
	{
		alert("Please choose  a proper "+name);
		return false;
	}
	return true;
}



/*add Product Functions*/
function showAddProductForm()
{
	var url=prefix+"addProductForm.php";
        $.get(url,function (content)
        {
                $("#titleContent").html("Add details of your product here");
                $("#mainContent").html(content);
        });
}

function addProduct()
{
	var name=$("#name").val();
	var category=$("#category").val();
	var price=$("#price").val();

	if (empty(name,"name")) return false;
	if (!isSelected(category,"category")) return false;
	if (!isNumeric(price,"Price")) return false;	
}


function confirmAddProduct(status)
{
	if (status)
	{
		alert("Product has been added");
	}
}

function showProduct(id)
{
	var url=prefix+"showProduct.php?id="+id;
        $.get(url,function (content)
        {
                $("#titleContent").html("");
                $("#mainContent").html(content);
        });

}

function showProducts()
{
	var search=$("#search").val();
	var category=$("#category").val();
	var from=$("#from").val();
	var to=$("#to").val();
	var country=$("#country").val();
	var url=prefix+"showAllProduct.php?search="+search+"&category="+category+"&from="+from+"&to"+to+"&country="+country;
        
	$.get(url,function (content)
        {
                $("#titleContent").html("");
                $("#mainContent").html(content);
        });
}

function showCatProduct(category)
{
	var country=$("#country").val();
        var url=prefix+"showAllProduct.php?category="+category+"&country="+country;
        $.get(url,function (content)
        {
                $("#titleContent").html("");
                $("#mainContent").html(content);
        });
}

function addComment(productId)
{
	var comment=$("#newComment").val();
	if (empty(comment,"comment")) return false;
	var userId=5;
	var url=prefix+"comment.php?action=addComment&userId="+userId+"&comment="+comment+"&productId="+productId;
	$.get(url,function (content)
	{
		if (content)
		{
			$("#allComments").html(comment)
		}	
	});
}
