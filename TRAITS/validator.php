<?php 

namespace TRAITS;

trait validator{
	/*************
	*
	*	Method: validate
    *	function: validate if the keys of an associative array exist
    *	return: object Request
    *	
	*****************/
	public function validate($request,$data)
	{
		if (isset($data) && isset($request))
		{
			for($i = 0; $i <count($data); $i++)
			{
				if (!isset($request[$data[$i]]) && empty($request[$data[$i]])) 
				{
					exit();
					
				}
				

				return (object)$request;
			}
		}
	}

	/*************
	*
	*	Method: ifExistSession
    *	function: validate if exist session
    *	
	*****************/

	public function ifExistSession($home = null,$login= null)
	{
		if (!isset($_SESSION['user'])) 
		{
			header("location:$home");
		}
		else if(isset($_SESSION['user']))
		{
			header("location:$login");
		}
		
	}
}