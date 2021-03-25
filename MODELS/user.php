<?php
class user extends loadModel
{

	public $conex;
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
			return	 $prepare->execute([
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


	public function maxId()
	{
		try 
		{
			$this->query = "SELECT MAX(id) as id FROM $this->table";
			$prepare = $this->conex->conex()->prepare($this->query);
			$prepare->execute();

			return $prepare->fetch(PDO::FETCH_OBJ);
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function storeWallet($id)
	{
		try 
		{
			
			$this->query = "INSERT INTO  wallets (user_id,cash) VALUES (:user,:cash)";
			$prepare = $this->conex->conex()->prepare($this->query);
			return	 $prepare->execute([
				':user'=>$id,
				':cash'=>100 
			]);


		}
		catch (Exception $e)
		{
			return false;
		}
	}

	public function getInfoUser($user)
	{
		try 
		{
			$this->query = "SELECT * FROM $this->table u INNER JOIN 
			wallets w ON u.id = w.user_id
			WHERE username = :username";
			$prepare = $this->conex->conex()->prepare($this->query);
			$prepare->execute([
				':username'=>$user->user
			]);

			return $prepare;
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function getWallet($user)
	{
		try 
		{
			$this->query = "SELECT * FROM wallets w INNER JOIN 
			movements m ON w.id = m.wallet_id
			WHERE w.user_id = :user 
			ORDER BY m.id DESC";
			$prepare = $this->conex->conex()->prepare($this->query);
			$prepare->execute([
				':user'=>$user->userId
			]);

			return $prepare;
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function wallet()
	{
		try 
		{
			$this->query = "SELECT * FROM wallets w ";
			$prepare = $this->conex->conex()->prepare($this->query);
			$prepare->execute([
				':user'=>$_SESSION['userId']
			]);

			return $prepare;
		}
		catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}

	public function storeMovements($data)
	{
		try 
		{

			$this->query = "INSERT INTO  movements (wallet_id,last_cash,movement) VALUES (:wallet,:last,:movement)";
			$prepare = $this->conex->conex()->prepare($this->query);
			return	 $prepare->execute([
				':wallet'=>$data->id,
				':last'=> $data->cash, 
				':movement'=>$data->total, 
			]);


		}
		catch (Exception $e)
		{
			return false;
		}
	}
	
	public function updateCash($data,$id)
	{
		try 
		{
			
			$this->query = "UPDATE wallets SET cash=:cash WHERE user_id=:user";
			$prepare = $this->conex->conex()->prepare($this->query);
			return	 $prepare->execute([
				':cash'=>$data,
				':user'=>$id
			]);
		}
		catch (Exception $e)
		{
			return false;
		}
	}

}