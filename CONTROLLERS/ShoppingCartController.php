<?php 
include('TRAITS/validator.php');
include('defaultController.php');
use TRAITS\validator;
class ShoppingCartController extends defaultController
{

	use validator;
	
	private $name;
	private $description;
	private $price;
	private $image;

	public function __construcr()
	{
	}

#save records in related tables.
#Return status in json format
	public function store()
	{
		$product = $this->validate($_POST,['id','price']);
		new loadModel('ShoppingCart');
		
		$bd = new database;
		$model = new ShoppingCart($bd);
		if (!$model->store() || !$model->storeLinerowsCart($product,$model->maxId()[0]->id))
		{
			echo json_encode(['state'=>false]);

		}
		
		echo json_encode(['state'=>true]);
	}

	public function countRowCart()
	{
		new loadModel('ShoppingCart');
		$bd = new database;
		$model = new ShoppingCart($bd);
		echo "({$model->countCart()->count})";
	}

	public function show()
	{
		
		$this->headerPage();
		new view('cart/cart.php');
		$this->footerPage();
	}

	public function getCart()
	{
		new loadModel('ShoppingCart');
		$bd = new database;
		$model = new ShoppingCart($bd);
		$data = $model->showCart();

		echo json_encode($data);
	}

	public function remove()
	{
		$product =$this->validate($_POST,['cart_id']);
		new loadModel('ShoppingCart');
		$bd = new database;
		$model = new ShoppingCart($bd);
		if (!$model->remove($product))
		{
			echo json_encode(false);
		}
		echo json_encode(true);	


	}
}