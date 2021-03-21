<?php 
class defaultController extends controller
{
	public function __construct()
	{

		parent::__construct();
	}

	public function index()
	{
		$database = new database;

		$database->conex();


		$mode =new  loadModel('databaseModel');

		$data =  new databaseModel($database->conex);

		$data->create();
		$this::headerParge();
		new view("index.php");
		$this::footerPage();
	}

	public function headerParge(){

		
		new view("layout/header.php");

	}

	public function footerPage(){

		new view("layout/footer.php");

	}
}