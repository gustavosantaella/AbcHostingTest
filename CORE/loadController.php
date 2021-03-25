<?php 


class loadController 
{
  public function __construct($controller)
  {
    /*isset controller ?*/
  	if (file_exists("CONTROLLERS/$controller.php")) 
  	{
      /*load controller*/
  		require_once("CONTROLLERS/$controller.php");
  	}
  	else
  	{
  		die("not found controller: $controller");
  	}
  }
}