<?php 
include('TRAITS/validator.php');
use TRAITS\validator;
class controller
{
		use validator;
	public function __construct()
	{
		/*validate that the get requests corresponding to the action of a controller exist*/
		if ($_GET && isset($_GET['action']))
		{
			$action = $_GET['action'];
			
			if (method_exists($this, $action)) 
			{
				$this->$action();
			}
			else
			{
				
				die("Not found");
			}


		}
		else
		{
			/*we validate yes, we are in the index*/
			if (method_exists($this, "index")) 
			{
				$this->index();
			}
			else
			{
				die("index not defined");
			}

		}
	}


	
}