<div class="container-fluid mt-5">
	<div class="table-responsive">
		<div class="card text-center">
			<div class="card-body">
				<div class="float-right">
					<a href="<?php urlBase() ?>UserController/logout" class='text-decoration-none font-weight-bold btn btn-danger'>Logout</a>
				</div>
				<h4 class="card-title h1">$./<?php echo $data[0]->cash ?></h4>
				<table class="table table-hover table-inverse">
					<thead>
						<tr>
							<th>Previous balance</th>
							<th>Spending</th>
							<th>Current balance</th>
						</tr>
					</thead>
				
					<tbody class="text-center">
						<?php if (isset($data[0]->last_cash)): ?>
							<?php foreach ($data as $key => $value): ?>
							<tr>
								<td>$./<?php echo $value->last_cash ?></td>
								<td class="text-danger">$./<?php echo "-$value->movement" ?></td>
								<td class="text-success">$./<?php echo $value->last_cash - $value->movement  ?></td>
							</tr>
						<?php endforeach ?>
						<?php endif ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script src="<?php urlBase() ?>PUBLIC/JS/partials/cart.js"></script>