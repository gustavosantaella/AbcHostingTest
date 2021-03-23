<?php 
include 'TRAITS/validator.php';
use TRAITS\validator;

class UserController extends controller
{
	use validator;
	public  $user;
	private  $password;
	public  $message;

	public function __contruct()
	{

		parent::__contruct();
		
	}

	public function index()
	{
		$session =  $this->session();
		if ($session){header('location:../');}

		new view('user/login.php',$this->message);
	}

	public function login()
	{
		$request =	$this->validate($_POST,['username','password']);
		new loadModel('user');
		$model = new user(new database);
		$this->user = $model->login($request);
		if ($this->user->rowCount() ===0)
		{
			$this->message = 'Invalid user';
			$this::index();
			return false;
		}

		$user = $this->user->fetch(PDO::FETCH_OBJ);


		if (!password_verify($request->password, $user->password))
		{
			$this->message = 'Invalid password';
			$this::index();
		}

		$_SESSION['user'] = $user->username;
		$_SESSION['userId'] = $user->id;

		header('location:../');

	}

	public function register()
	{
		$request =	$this->validate($_POST,['username','password']);
		new loadModel('user');
		$this->user =$request->username;
		$this->password = password_hash($request->password, PASSWORD_DEFAULT);

		$model = new user(new database);
		if (!$model->register($this,$this->password)) {
			$this->message = 'Please try again';
			$this::index();
		}

		$this->message = "Welcome $this->user";
		$this::index();

	}



	

}