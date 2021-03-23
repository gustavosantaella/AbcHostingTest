	<?php foreach($data['products'] as $product):
		?>

		<div class="card text-center ml-4 mt-3 col-md-3">
			<div class="img-fluid">
				<img class="card-img-top text-center"  src="<?= $product->image ?>" alt="Card image cap" style='width: 50%; height: 120%'>
			</div>
			<div class="card-body">
				<h4 class="card-title"><?php echo $product->name ?></h4>
				<p class="card-text">
					<?= $product->description ?>
				</p>
				<p class="card-text">
					$./<?= $product->price ?>
				</p>
				<button onclick='addToCart(<?php echo json_encode($product) ?>)' class="btn btn-primary addToCart">Add to cart</button>
			</div>
		</div>
		<?php 
	endforeach;

