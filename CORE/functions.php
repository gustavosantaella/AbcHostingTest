<?php 

function urlBase()
{
	/* url base project*/
	echo $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME']."/";


}