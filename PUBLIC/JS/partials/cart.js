const listCart =async () =>{

		const response = await axios.get('getCart');
		const data = response.data;

		if (data.length >0) {
			var html = ''
			var price =[];
			var i= 0
			data.map(e =>{
				i++
				unitTotal = e.price * e.stock;
				
				price.push(e.price * e.stock)
				html += `
				<tr>
				<td id='id'>${i}</td>
				<td> id='name'${e.name}</td>
				<td id='description'>${e.description}</td>
				<td id='stock'>${e.stock}</td>
				<td id='price'>$./${e.price}</td>
				<td id='unitTotal'>$./${unitTotal.toFixed(2)}</td>
				<td id='button'> <button type="button" id='s' onclick="remove(${e.cart_id})" class='btn btn-danger font-weight-bold'>Remove</button></td>
				</tr>

				`;
			})

			let  total= price.reduce((a,b)=> {return a+b})

			$('#tbody').html(html);
			$('#total').html(`$./${total.toFixed(2)}`);
		}
		else
		{
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
	const remove =async (param) => { 

		

		const response = 	await $.ajax({
			type:"POST",
			url:"remove",
			data:{
				cart_id:param,
			}
		})
		if (response) {

			listCart();
			countRowCart('countRowCart')

		}
		

	}


