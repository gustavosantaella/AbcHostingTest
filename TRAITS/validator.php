<?php 

namespace TRAITS;

trait validator{
	public function validate($request,$data)
	{
		if (isset($data) && isset($request))
		{
			for($i = 0; $i <count($data); $i++)
			{
				if (!isset($_POST[$data[$i]])) 
				{
					exit();
					
				}

				return (object)$request;
			}
		}
	}

	public function session()
	{
		if (isset($_SESSION['user'])) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}