<?php 

class ShoppingCart extends loadModel
{
	public object $conex;
	private string $query;
	protected array $tables = ['carts','cart_rows','products'];


	public function __construct(object $conex)
	{
		$this->conex = $conex;
	}

	public function store(): bool
	{
		try
		{

			$this->query = "INSERT INTO  {$this->tables[0]} (user_id) VALUES (:id)";
			$prepare = $this->conex->conex()->prepare($this->query);
			return $prepare->execute([':id'=>$_SESSION['userId']]);
			
			
		} 
		catch (Execption  $e) 
		{
			print "Error!: " . $e->getMessage() . "</br>";
		}

	}

	public function storeLinerowsCart(object $data, int $id):bool
	{

		try
		{

			$this->query = "INSERT into {$this->tables[1]} (stock,cart_id,product_id) VALUES(:stock,:cid,:pid)";
			$prepare = $this->conex->conex()->prepare($this->query);
			$this->conex->close();
			return $prepare->execute([':stock'=>1,':cid'=>$id,':pid'=>$data->id]);
			
			
		} 
		catch (Execption  $e) 
		{
			print "Error!: " . $e->getMessage() . "</br>";
		}


	}

	public function maxId(): array
	{
		$this->query = "SELECT MAX(id) as id FROM {$this->tables[0]}";
		$prepare = $this->conex->conex()->prepare($this->query);
		$prepare->execute();
		return $prepare->fetchAll(PDO::FETCH_OBJ);
	}

	public function countCart(){
		$this->query = "SELECT COUNT('*') as count FROM {$this->tables[0]} WHERE user_id =:id";
		$prepare = $this->conex->conex()->prepare($this->query);
		$prepare->execute(['id'=>$_SESSION['userId']]);
		return $prepare->fetch(PDO::FETCH_OBJ);
	}

	public function showCart(){

		try {
			$this->query = "
			SELECT
			sum(b.stock) as stock,
			sum(c.price) as price,
			a.id,
			b.id as row_id,
			c.id as product_id,
			c.name,
			c.description,
			c.price,
			b.cart_id as cart_id
			FROM {$this->tables[0]} a INNER JOIN
			{$this->tables[1]} b ON a.id = b.cart_id INNER JOIN
			{$this->tables[2]} c ON b.product_id = c.id
			WHERE user_id =:id GROUP BY c.id";
			$prepare = $this->conex->conex()->prepare($this->query);
			$prepare->execute([':id'=>$_SESSION['userId']]);
			return $prepare->fetchAll(PDO::FETCH_OBJ);
			
		} 
		catch (Exception $e) {
			print "Error!: " . $e->getMessage() . "</br>";

		}

	}


	public function remove($id)
	{
		try 
		{
			$this->query = "DELETE FROM carts WHERE user_id =:id AND id=:cart_id";
			$prepare = $this->conex->conex()->prepare($this->query);
			return $prepare->execute([':id'=>$_SESSION['userId'],':cart_id'=>$id->cart_id]);
			
		} 
		catch (Exception $e)
		{
			print "Error!: " . $e->getMessage() . "</br>";
		}
	}
}