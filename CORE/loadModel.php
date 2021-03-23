<?php 


class loadModel 
{
  public function __construct($model)
  {
    /*isset model ?*/
  	if (file_exists("MODELS/$model.php")) 
  	{
      /*load model*/
  		require_once("MODELS/$model.php");
  	}
  	else
  	{
  		die("no se puede encontrar el modelo: $model");
  	}
  }
}