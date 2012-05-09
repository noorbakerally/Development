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


function showAddProductForm()
{
	var url=prefix+"addProduct.php";
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
