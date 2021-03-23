<script>



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
				<td>${i}</td>
				<td>${e.name}</td>
				<td>${e.description}</td>
				<td>${e.stock}</td>
				<td>$./${e.price}</td>
				<td>$./${unitTotal.toFixed(2)}</td>
				<td> <button type="button" id='s' onclick="remove(${e.cart_id})" class='btn btn-danger font-weight-bold'>Remove</button></td>
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


</script>