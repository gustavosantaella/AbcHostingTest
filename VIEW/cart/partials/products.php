<?php 
$i=0;
$price;

$array = $data;
?>

<?php foreach ($data as $key => $value): 
	$i++;
	
	$total = 0;

	$unitTotal = $value['price'] * $value['stock'];

	$price[] =$value['price'] * $value['stock'];
	
	?>

	<tr>
		<td id='id'><?php echo $i ?></td>
		<td id='name'> <?php echo $value['name'] ?></td>
		<td id='description'><?php echo $value['description'] ?></td>
		<td id='stock'><?php echo $value['stock'] ?></td>
		<td id='price'>$./<?php echo $value['price'] ?></td>
		<td id='unitTotal'>$./<?php echo $unitTotal ?></td>
		<td id='button'> <button type="button" id='s' onclick="remove(<?php echo $key  ?>)" class='btn btn-danger font-weight-bold'>Remove</button></td>
	</tr>
<?php endforeach; $array['total'] =array_sum($price); ?>
