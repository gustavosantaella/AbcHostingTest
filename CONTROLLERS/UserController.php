<?php 

class UserController extends defaultController
{

	public  $user;
	private  $password;
	public  $message;

	public function __contruct()
	{

		parent::__contruct();
		
	}

	/*************
	*
	*	Method: index
    *	return: VIEW login
    *	
	*****************/
	public function index()
	{
		$session =  $this->ifExistSession(null,'../');
		

		new view('user/login.php',$this->message);
	}
	/*************
	*
	*	Method: login
    *	function: validate that the data sent by request exists in the database
    *	
    *	
	*****************/
	public function login()
	{
		/*if isset session*/
		$session =  $this->ifExistSession(null,'../');
		/*validate request*/
		$request =	$this->validate($_POST,['username','password']);
		new loadModel('user');
		$model = new user(new database);
		$this->user = $model->login($request);
		if ($this->user->rowCount() ===0)
		{
			/*user invalid*/
			$this->message = 'Invalid user';
			$this::index();
			return false;
		}
		/*user valid*/

		/*conversion array to object*/
		$user = $this->user->fetch(PDO::FETCH_OBJ);


		/* password invalid */
		if (!password_verify($request->password, $user->password))
		{
			$this->message = 'Invalid password';
			$this::index();
		}
		else
		{
			/* LOGIN !!*/
			$_SESSION['user'] = $user->username;
			$_SESSION['userId'] = $user->id;

			header('location:../');
		}

		

	}

	/*************
	*
	*	Method: register
    *	function: validate that the data sent by request does not exist in the database
    *	
    *	
	*****************/
	public function register()
	{
		$session =  $this->ifExistSession(null,'../');
		$request =	$this->validate($_POST,['username','password']);
		new loadModel('user');
		$this->user =$request->username;
		/*encrypt password*/
		$this->password = password_hash($request->password, PASSWORD_DEFAULT);
		$db = new database;
		$model = new user($db);

		/*user already exist*/
		if (!$model->register($this,$this->password))
		{
			$this->message = 'Please try again';
			$this::index();
			return false;
		}
		/* create wallet error*/
		if (!$model->storeWallet($model->maxId()->id)) 
		{
			$this->message = 'Please try again';
			$this::index();
			return false;
		}

		/* REGISTER USER  AND WALLET CREATE !! */
		$this->message = "Welcome $this->user";
		$this::index();

	}

	/*************
	*
	*	Method: profile
    *	function: return view and user information
    *	
    *	
	*****************/
	public function profile()
	{
		$session =  $this->ifExistSession('index',null);

		new loadModel('user');
		$db = new database;
		$model = new user($db);
		$user =(object)$_SESSION;
		$data =$model->getWallet($user);
		$user = ($data->fetchAll(PDO::FETCH_OBJ));
		if (!count($user) >0) 
		{
			$user= [(object)['cash'=>$model->wallet()->fetch(PDO::FETCH_OBJ)->cash]];

		}
		$this::headerPage();
		new view('user/profile.php',$user);
		$this::footerPage();
	}

	/*delete session*/
	public function logout()
	{
		$this->ifExistSession('index',null);
		unset($_SESSION['user']);
		unset($_SESSION['userId']);

		$this->ifExistSession('index',null);
	}

}