<?php 

class databaseModel extends loadModel
{
	private object $conex;

	public function __construct(object $conex)
	{
		$this->conex = $conex;

	}

	public function create()
	{
# cretae table users	
		$string = "
		CREATE TABLE IF NOT EXISTS users(
		id int AUTO_INCREMENT NOT NULL,
		username varchar(100) UNIQUE,
		password varchar(50),
		PRIMARY KEY (id)     );";

		$this->conex->conex()->prepare($string)->execute();

#create table products
		$string = "
		CREATE TABLE IF NOT EXISTS products(
		id int AUTO_INCREMENT NOT NULL,
		name varchar(100),
		description varchar(100) NULL,
		price FLOAT,
		PRIMARY KEY (id)           );";

		$this->conex->conex()->prepare($string)->execute();

#create table cart 
		$string = "
		CREATE TABLE IF NOT EXISTS carts(
		id int AUTO_INCREMENT NOT NULL,
		user_id int,
		PRIMARY KEY (id),
		FOREIGN KEY fk_carts_users (user_id)
		REFERENCES users (id) 
		ON DELETE CASCADE  );";

		$this->conex->conex()->prepare($string)->execute();

#cretae table cart_rows
		$string = "
		CREATE TABLE IF NOT EXISTS cart_rows(
		id serial NOT NULL,
		stock int,
		cart_id int UNSIGNED,
		product_id int,  
		PRIMARY KEY (id),
		FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
		FOREIGN KEY (cart_id) REFERENCES carts(id) ON DELETE CASCADE );";

		$this->conex->conex()->prepare($string)->execute();

		#cretae table wallets
		$string = "
		CREATE TABLE IF NOT EXISTS wallets(
		user_id int NOT NULL,
		cash bigint,
		FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE );";

		$this->conex->conex()->prepare($string)->execute();


		//$string = "INSERT INTO users (name,username,password) VALUES('Gustavo', 'GustavoSantaella', '".password_hash('123456',PASSWORD_DEFAULT)."')";
		//$this->conex->conex()->prepare($string)->execute();
		
		//$string = "INSERT INTO wallets (user_id,cash) VALUES(1,100)";
		//$this->conex->conex()->prepare($string)->execute();

		
	}




}