<?php 

class product extends loadModel
{
	public object $conex;
	private string $query;

	public function __construct(object $conex)
	{
		$this->conex = $conex;
	}

	public function show()
	{
		$this->query = 'SELECT * FROM products';
		$prepare = $this->conex->conex()->prepare($this->query);
		$prepare->execute();
		return $prepare;
	}

	public function store()
	{
		try
		{
		
			$this->query = 'INSERT INTO carts (user_id) VALUES (:id)';
			$prepare = $this->conex->conex()->prepare($this->query);
			$prepare->execute([':id'=>1]);
			$prepare = $this->conex->conex()->prepare('SELECT LAST_INSERT_ID() FROM carts');
			$prepare->execute();
			return $prepare;
		} 
		catch (Execption  $e) 
		{

			$this->conex->conex()->rollback();
			print "Error!: " . $e->getMessage() . "</br>";
		}

	}

	public function storeLinerowsCarts()
	{

	}
}