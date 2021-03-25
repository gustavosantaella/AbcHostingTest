<?php 

class defaultController extends controller
{

	private $database;

	public function __construct()
	{
		/* load models */
		new loadModel('product');
		$this->database = new database;
		
		parent::__construct();
	}

	/*************
	*
	*	Method: index
    *	function:return view and product list
    *	
	*****************/
	public function index()
	{
		$model = new product($this->database);
		
		$products = $model->show()->fetchAll(PDO::FETCH_OBJ);
		$this::headerPage();
		new view("index.php",compact('products',compact('products')));
		$this::footerPage();
	}

    /*************
	*
	*	Method: headerPage
    *	function:return view 
    *	
	*****************/
	public function headerPage()
	{

		new view("layout/header.php");

	}

    /*************
	*
	*	Method: footerPage
    *	function:return view 
    *	
	*****************/
	public function footerPage()
	{

		new view("layout/footer.php");

	}
}