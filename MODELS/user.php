<?php
class user extends loadModel
{

	private $conex;

	public function __construct($conex)
	{
		$this->conex = $conex;
	}

}