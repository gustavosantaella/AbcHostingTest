<?php 
class database{

	private $host;
	private $port;
	private $user;
	private $pass;
	public  $conex;
	private $opciones;


	public  function __construct(){

		
		$this->host   = env['DB_HOST'];
		$this->port   = env['DB_PORT'];
		$this->user   = env['DB_USERNAME'];
		$this->dbname = env['DB_NAME'];
		$this->pass   = env['DB_PASSWORD'];
		
		


	}
	

	
	public function conex(){

		try{

			$conex = $this->conex = new PDO("mysql:dbname=$this->dbname;host=$this->host;port=$this->port", $this->user, $this->pass,[ 

				PDO::ATTR_STRINGIFY_FETCHES => PDO::ATTR_EMULATE_PREPARES,false,
				PDO::ATTR_ERRMODE           => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_CASE              => PDO::CASE_NATURAL,
				PDO::ATTR_ORACLE_NULLS      => PDO::NULL_EMPTY_STRING])or die("ERROR");


			return $conex;

		}catch(PDOException $e){

			echo"Error: $e";

		}
	}




	public function close(){

		$this->conex=null;
		$this->port=null;
		$this->user=null;
		$this->pass=null;
		$this->dbname=null;
		$this->host=null;
	}
}






?>

