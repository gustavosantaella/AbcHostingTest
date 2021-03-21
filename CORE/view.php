<?php 


class view
{
	public function __construct($view,$data=null)
	{
		/* isset view?*/
		if (file_exists("./VIEW/$view")) {
			
			/*Load view	*/
			require_once("./VIEW/$view");
		}
		else
		{	
			die("404 - Site not found");
		}
	}
}