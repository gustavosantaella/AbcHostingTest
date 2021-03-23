
const addToCart  = async (product) =>{


	const response = await $.ajax({
		type:"POST",
		url:"ShoppingCartController/store",
		data:{
			id:product.id,
			price:product.price
		}
	});

	const	data = JSON.parse(response)
	if (data.state)
	{

		$('#listProduct > .notify').toggleClass('activeNotify')

	
		countRowCart('ShoppingCartController/countRowCart')

		setTimeout(()=>{$('#listProduct > .notify').toggleClass('activeNotify')},3000)

	}

}


const countRowCart =async (url) => {

	$("#count").load(url);
}
