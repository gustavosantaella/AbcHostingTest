<?php 
class defaultController extends controller
{
	private $database;

	public function __construct()
	{
		new loadModel('product');
		new loadModel('user');
		//new loadModel('databaseModel');
		$this->database = new database;
		
		parent::__construct();
	}

	public function index()
	{
		$model = new product($this->database);
		
		$products = $model->show()->fetchAll(PDO::FETCH_OBJ);
		$this::headerPage();
		new view("index.php",compact('products',compact('products')));
		$this::footerPage();
	}

	public function headerPage()
	{
		new loadModel('ShoppingCart');
		$bd = new database;
		$model = new ShoppingCart($this->database);
		$count = $model->countCart();
		new view("layout/header.php",$count);

	}

	public function footerPage()
	{

		new view("layout/footer.php");

	}
}