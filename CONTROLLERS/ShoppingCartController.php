<?php 

class ShoppingCartController extends defaultController
{
	public $name;
	public $id;
	public $description;
	public $price;
	public $stock;
	public $cart;


	/*************
	*
	*	Method: store
    *	function: create or update items in the cart session 
    *	return: JSON
    *	
	*****************/
	public function store()
	{
		/*validate associative array elements*/
		$product = $this->validate($_POST,['id','price']);

		/*Create cart arrangement to store sent data*/
		$this->cart =[
			'id'=>$this->id = $product->id, 
			'name'=>$this->name = $product->name,
			'price'=>$this->price = $product->price, 
			'stock'=>$this->stock =1, 
			'description'=>$this->description = $product->description
		];

		/*verify that the session does not exist. To add a new item*/
		if (!isset($_SESSION['cart'])) 
		{
			$_SESSION['cart'][0] =$this->cart;
			echo json_encode(['state'=>true,'data'=>$this->cart]);
		}
		/*We use a method to look for the keys within the session, since they exist*/
		$position = $this->searchKey();

		/*we verify that it is not null*/
		if ($position !==null) 
		{

			/****************
			* If the session is not null, it means that there are already elements in the * array.
			* 
            * We use the variable $ position to access the element and add 1 to the stock.
            *
            * return: JSON
 			 ***************/
			$_SESSION['cart'][$position]['stock'] +=1;

			echo json_encode(['state'=>true,'data'=>$this->cart]);
		}
		else
		{
			/***************

			* If the cart session is null, it means that it is a new item.
			* We count how many elements there are in the array and with the $position
			* variable we access the position we want to *create. Finally we assign $ this-> cart. 	
			* return: JSON	
			* 		
			***************/
			$position = count($_SESSION['cart']);
			$_SESSION['cart'][$position] =$this->cart;
			echo json_encode(['state'=>true,'data'=>$this->cart]);
		}

	}

	public function countRowCart()
	{
		/*we count how many elements are in the cart session to show them with javascript*/
		if (!isset($_SESSION['cart'])) 
			$_SESSION['cart'] = [];
		
		$count = count($_SESSION['cart']);
		
		echo "({$count})";
	}

	/*************
	*
	*	Method: show
    *	
    *	return: view
    *	
	*****************/
	public function show()
	{
		$this->headerPage();
		new view('cart/cart.php');
		$this->footerPage();
	}

	/*************
	*
	*	Method: show
    *	function: we get the elements of the session to be listed
    *	return: JSON
    *	
	*****************/
	public function getCart()
	{		
		$data = $_SESSION['cart'];

		echo json_encode($data);
	}

	/*************
	*
	*	Method: remove
    *	function: weremove item from session or update stock of an item
    *	return: true 
    *	
	*****************/
	public function remove()
	{
		
		$request =$this->validate($_POST,['cart_id']);
		$this->id = $request->cart_id;
		$position = $this::searchKey();

		if ($_SESSION['cart'][$position]['stock'] >1) 
		{
			

			$_SESSION['cart'][$position]['stock'] -=1;
			echo json_encode(true);
			;
		}
		else
		{
			array_splice($_SESSION['cart'], $position,1);
			echo json_encode(true);
			;
		}

	}

	/*************
	*
	*	Method: searchKey
    *	function:go through all the elements of the session
    *	return: key 
    *	
	*****************/

	public function searchKey()
	{
		foreach ($_SESSION['cart'] as $key => $value)
		{
			if ($value['id'] === $this->id) 
			{
				
				return $key;
			}
		}
	}

	/*************
	*
	*	Method: buy
    *	function:Buy products
    *	return: JSON 
    *	
	*****************/
	public function buy()
	{
		$request = 	$this::validate($_SESSION,['userId','user','cart']);

		/*we go through the session array and save in a new array the unit price result by the quantity*/
		$total = [];	
		foreach ($_SESSION['cart'] as $key => $value) 
		{
			$total [] = $value['price'] * $value['stock']; 
		}
		new loadModel('user');
		$db = new database;
		$model = new user($db);
		/*conversion array to object*/
		$user =(object)$_SESSION;
		$data =$model->getInfoUser($user);
		/*we add the arrangement*/
		$sum = array_sum($total);
		/*if the user exists*/
		if ($data->rowCount() > 0 ) 
		{

			$user = $data->fetch(PDO::FETCH_OBJ);
			/*We verify that the user's capital is greater than the total price*/
			if ($user->cash >$sum)
			{
				
				$user->total =$sum;
				/*We verify that the movements have been created successfully*/
				if ($model->storeMovements($user))
				{
					/*We update the wallet*/
					$model->updateCash($user->cash - $user->total,$user->user_id);
					/*reset session */
					$_SESSION['cart'] =[];
					echo json_encode(['state'=>true]);
					return true;
				}
			}
			else
			{
				echo json_encode(['state'=>false]);
			}
		}
		

	}
}