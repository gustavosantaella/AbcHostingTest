<?php
define('env',parse_ini_file('.env'));
require_once("CONTROLLERS/config.php");
require_once("CORE/controller.php");
require_once("CORE/view.php");
require_once("CORE/database.php");
require_once("CORE/loadModel.php");
require_once("CORE/functions.php");
/*if isset var controller in url?*/
if ($_GET && $_GET['controller'] ) 
{

	/* iseet controller??*/
	$default_controller = $_GET['controller'];
	if (file_exists("CONTROLLERS/$default_controller.php"))
	{
		/*Load controller*/
		require_once("CONTROLLERS/$default_controller.php");
	}
	else
	{
		die("Controlador inexistente");
	}
}
else 
{
	
	if (file_exists("CONTROLLERS/$default_controller.php")) 
	{
		/*load controller*/
		require_once("CONTROLLERS/$default_controller.php");
	}
	else
	{
		die("Controlador inexistente");
	}

}

$Class = new $default_controller();



