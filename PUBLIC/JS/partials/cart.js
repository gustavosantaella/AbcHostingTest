/*we count the elements in the cart session*/
const countRowCart =async (url) => {

	$("#count").load(url);
}

/*function in charge of adding elements to the cart*/
const addToCart  = async (product) =>{


	/*we make a POST request to the server*/
	const response = await $.ajax({
		type:"POST",
		url:"ShoppingCartController/store",
		data:{
			id:product.id,
			price:product.price,
			name:product.name,
			description:product.description
		}
	});
	/*we stop the results*/
	const	data = JSON.parse(response)
	if (data.state)
	{
		console.log(data)
		/*if it is correct, we use the countRowCart function to count the elements.*/
		countRowCart('ShoppingCartController/countRowCart')
		/*notification*/
		notify()
	}

}

const notify = () => {

	/*we show the notification*/
	$('#listProduct > .notify').toggleClass('activeNotify')
	/*after 18000 milliseconds the notification disappears*/
	setTimeout(()=>{$('#listProduct > .notify').toggleClass('activeNotify')},1800)
}

const listCart =async () =>{

	/*we get all the products stored in the cart*/
	const response = await axios.get('getCart');
	const data = response.data;
	/*if the answer is greater than 0, it means that there are items in the cart*/
	if (data.length >0)
	{
		/*We call the function in charge of displaying the cart*/
		listPartial(data)

	}
	else
	{
		/*Empty cart*/

		$(document).ready(()=>{
			if ($('#buy').length >0) 
			{
				$('#buy').remove();
				$('#select-content').remove();
			}
		})
		$('#tbody').html(`

			<tr>
			<td colspan='7' class='text-center font-weight-bold '>
			Empty cart
			</td>
			</tr>
			`)
		let num =0;
		$('#total').html(`$./${num.toFixed(2)}`);
		
	}

}

/* list cart*/
const listPartial = (data) =>{

	var html = ''
	var price =[];
	var i= 0
	/*we loop through the server response*/
	data.forEach(e =>{
		/*for each element it will show a row with the element's data*/
		i++
		/*we calculate the unit total*/
		unitTotal = e.price * e.stock;
		/*we add the total to an empty array*/
		price.push(e.price * e.stock)
		html += `
		<tr>
		<td id='id'>${i}</td>
		<td id='name'> ${e.name}</td>
		<td id='description'>${e.description}</td>
		<td id='stock'>${e.stock}</td>
		<td id='price'>$./${e.price}</td>
		<td id='unitTotal'>$./${unitTotal.toFixed(2)}</td>
		<td id='button'>
		<button type="button"
		id='s'
		onclick="remove(${e.id})" 
		class='btn btn-danger font-weight-bold'>
		Remove
		</button>
		</td>
		</tr>

		`;
	})
	/*sum total price*/
	let  total= price.reduce((a,b)=> {return a+b})

	/*show table*/
	$('#tbody').html(html);
	$('#total').html(`$./${total.toFixed(2)}`);

	
	if (!$('#buy').length >0) 
	{

		button = document.createElement('input')
		button.setAttribute('id','buy')
		button.setAttribute('type','button')
		button.setAttribute('onclick','buy()')
		button.setAttribute('class','btn btn-success font-weight-bold')
		button.setAttribute('value','Buy')
		$('#buyButton').append(button)
		$('#buyButton').before(`

			<div class='mb-3' id='select-content'>
			<h3 class='mb-2'>Option</h3>
			<select id='select' class='form-control'>
			<option>--Select option-- </option>
			<option value='5'> 5$</option>
			<option value='0'> 0$</option>
			</select>
			</div>
			`);

		
	}
	

}

/*delete element*/
const remove =async (param) => { 

	await $.ajax({
		type:"POST",
		url:"remove",
		data:{
			cart_id:param,
		}
	})
	.then(e=>{
		/*count cart*/
		countRowCart('countRowCart')
		/*call to function for list cart*/
		listCart()
	})
	.catch(e=>console.log(e))
	


}

/*buy*/
const buy = async (param) =>{
	/*we send the elements inside the cart*/
	if($('#select').val() ==5 ||$('#select').val() ==0)
	{
		await $.ajax({
			type:'POST',
			url:"buy",
			data:{
				data:param,
				option:$('#select').val()
			}
		}).then(e => {

			/*If the server's response is correct, we will show a message on the screen*/
			r = JSON.parse(e)
			console.log(e)
			if (r.state)
			{	
				listCart()
				countRowCart('countRowCart')
				message({
					title:'Succsess!',
					text:'Thank you for buying!',
					icon:'success',
				})
			}
			else
			{
				/*If the response from the server is incorrect, we display a message on the screen*/
				console.log('else',r.state)
				message({
					title:'Sorry!',
					text:'Sorry not enough money!',
					icon:'warning',
				})

			}

		})
		.catch(e => console.log('error',e))
	}
	else
	{
		$('#select').css({
			border:'1px solid red',
			transition:'0.5s'
		})
	}
}

/*message*/
const message = (data) => {

	swal({
		title: data.title,
		text: data.text,
		icon: data.icon,
		button: "Accept",
	});
}


