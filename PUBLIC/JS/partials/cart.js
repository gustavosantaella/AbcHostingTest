
const countRowCart =async (url) => {

	$("#count").load(url);
}

const addToCart  = async (product) =>{


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

	const	data = JSON.parse(response)
	if (data.state)
	{
		console.log(data)
		
		countRowCart('ShoppingCartController/countRowCart')
		notify()
	}

}

const notify = () => {

	$('#listProduct > .notify').toggleClass('activeNotify')
	setTimeout(()=>{$('#listProduct > .notify').toggleClass('activeNotify')},1800)
}

const listCart =async () =>{

	const response = await axios.get('getCart');
	const data = response.data;

	if (data.length >0)
	{
		
		listPartial(data)

	}
	else
	{
		$(document).ready(()=>{
			if ($('#buy').length >0) 
			{
				$('#buy').remove();
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

const listPartial = (data) =>{
	
	var html = ''
	var price =[];
	var i= 0
	data.forEach(e =>{
		i++
		unitTotal = e.price * e.stock;

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
		<button type="button" id='s' onclick="remove(${e.id})" class='btn btn-danger font-weight-bold'>Remove</button>
		</td>
		</tr>

		`;
	})

	let  total= price.reduce((a,b)=> {return a+b})

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


		
	}
	

}


const remove =async (param) => { 

	//console.log(param)


	await $.ajax({
		type:"POST",
		url:"remove",
		data:{
			cart_id:param,
		}
	})
	.then(e=>{

		countRowCart('countRowCart')
		listCart()
	})
	.catch(e=>console.log(e))
	


}

const buy = async (param) =>{
	
	await $.ajax({
		type:'POST',
		url:"buy",
		data:{
			data:param
		}
	}).then(e => {
	r = JSON.parse(e)

		if (r.state)
		{	console.log('true',e)
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


const message = (data) => {

	swal({
		title: data.title,
		text: data.text,
		icon: data.icon,
		button: "Accept",
	});
}


