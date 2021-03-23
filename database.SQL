	
CREATE TABLE IF NOT EXISTS users(
	id int AUTO_INCREMENT NOT NULL,
	name varchar(100),
	username varchar(100) UNIQUE,
	password varchar(50),
	PRIMARY KEY (id)    
	);



#create table products

CREATE TABLE IF NOT EXISTS products(
	id int AUTO_INCREMENT NOT NULL,
	name varchar(100),
	description varchar(100) NULL,
	price FLOAT,
	PRIMARY KEY (id)         
	);



#create table cart 

CREATE TABLE IF NOT EXISTS carts(
	id int AUTO_INCREMENT NOT NULL,
	user_id int,
	PRIMARY KEY (id),
	FOREIGN KEY fk_carts_users (user_id)
	REFERENCES users (id) 
	ON DELETE CASCADE 
	);



#cretae table cart_rows

CREATE TABLE IF NOT EXISTS cart_rows(
	id serial NOT NULL,
	stock int,
	cart_id int,
	product_id int,  
	PRIMARY KEY (id),
	FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
	FOREIGN KEY (cart_id) REFERENCES carts(id) ON DELETE CASCADE
	);



		#cretae table wallets
		
		CREATE TABLE IF NOT EXISTS wallets(
			user_id int NOT NULL,
			cash bigint,
			FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
			);


