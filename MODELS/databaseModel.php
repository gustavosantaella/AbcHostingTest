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
		name varchar(100),
		username varchar(100) UNIQUE,
		password varchar(50),
		PRIMARY KEY (id)     );";

		$this->conex->prepare($string)->execute();

#create table products
		$string = "
		CREATE TABLE IF NOT EXISTS products(
		id int AUTO_INCREMENT NOT NULL,
		name varchar(100),
		description varchar(100) NULL,
		price FLOAT,
		PRIMARY KEY (id)           );";

		$this->conex->prepare($string)->execute();

#create table cart 
		$string = "
		CREATE TABLE IF NOT EXISTS carts(
		id serial NOT NULL,
		user_id int,
		PRIMARY KEY (id),
		FOREIGN KEY fk_carts_users (user_id)
		REFERENCES users (id) 
		ON DELETE CASCADE  );";

		$this->conex->prepare($string)->execute();

#cretae table cart_rows
		$string = "
		CREATE TABLE IF NOT EXISTS cart_rows(
		id serial NOT NULL,
		cartid int,
		product_id int,  
		PRIMARY KEY (id),
		FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE );";

		$this->conex->prepare($string)->execute();
	}




}