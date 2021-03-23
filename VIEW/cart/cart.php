
<div class="table-responsive">
	<table class="table table-hover table-inverse">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Description</th>
				<th>Stock</th>
				<th>Price</th>
				<th>Total</th>
				<th class="">Option</th>
			</tr>
		</thead>
		<tbody id="tbody">
		
		</tbody>

	<tfoot>
		<tr>
			<td colspan="4" class="font-weight-bold h3 text-right">TOTAL</td>
			<td class="font-weight-bold h3 text-center" colspan="2" id="total"></td>
		</tr>
	</tfoot>
	</table>

	
</div>


<script src="<?php urlBase() ?>PUBLIC/JS/partials/cart.js"></script>
<script>listCart()</script>