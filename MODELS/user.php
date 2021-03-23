<?php
class user extends loadModel
{

	private $conex;
	private $query;
	private $table = 'users';

	public function __construct($conex)
	{
		$this->conex = $conex;
	}

	public function register($user,$password)
	{
		
		try 
		{
			
			$this->query = "INSERT INTO  $this->table (username,password) VALUES (:username,:password)";
			$prepare = $this->conex->conex()->prepare($this->query);
			return $prepare->execute([
				':username'=>$user->user,
				':password'=>$password 
			]);
		}
		catch (Exception $e)
		{
			return false;
		}
	}

	public function login($user)
	{
		try 
		{
			$this->query = "SELECT * FROM $this->table WHERE username = :username";
			$prepare = $this->conex->conex()->prepare($this->query);
			 $prepare->execute([
				':username'=>$user->username
			]);

			 return $prepare;
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

}