
<div class="table-responsive">
	<table class="table table-hover table-inverse">
		<thead>


			<tr id="message">

			</tr>
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
			<!-- 
			elements cart in PUBLIC/JS/partials/cart.js 
			Function: listCart;
		-->
	</tbody>

	<tfoot>
		<tr>
			<td colspan="4" class="font-weight-bold h3 text-right">TOTAL</td>
			<td class="font-weight-bold h3 text-center" colspan="2" id="total">$./

			</td>
		</tr>
	</tfoot>
</table>

<?php if (isset($_SESSION['user'])): ?>

	<div id="buyButton">

	</div>
<?php endif ?>
</div>


<script src="<?php urlBase() ?>PUBLIC/JS/partials/cart.js"></script>
<script>listCart()</script>