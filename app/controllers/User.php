<?php

require_once '../vendor/autoload.php';
// use Ozdemir\Datatables\Datatables;
// use Ozdemir\Datatables\DB\MySQL;

class User extends Controller
{
	protected $user_model;
	protected $dt;

	public function __construct()
	{
		$this->session();
		$this->user_model = $this->model('User_model');
		$this->role_model = $this->model('Role_model');
		$this->status_model = $this->model('Status_model');
	}

	public function index()
	{
		$data = [
			'title' => 'List User',
			'user' => $this->user_model->getAllUser(),
			'roleData' => $this->role_model->getAllRole(),
			'statusData' => $this->status_model->getAllStatus(),
		];
		
		$this->render('user/list', $data);
	}

	public function create()
	{

		$result = $this->user_model->insert($_POST);

		$this->setToastr('create', $result);

		header('Location: ' . base_url . 'user');
		exit;

	}

	public function getupdate()
	{
		// return data in json
		$this->jsonResult($this->user_model->getUserByID($_POST['id']));
	}

	public function update()
	{
		$result = $this->user_model->update($_POST);

		$this->setToastr('update', $result);

		header('Location: ' . base_url . 'user');
		exit;
	}

	public function delete($id)
	{
		$result = $this->user_model->delete($id);

		$this->setToastr('delete', $result);

		header('Location: ' . base_url . 'user');
		exit;
	}

	// public function testpage()
	// {
	// 	$data = [
	// 		'title' => 'List User',
	// 		'user' => $this->user_model->getAllUser(),
	// 	];
		
	// 	$this->render('user/testpage', $data);
	// }

	// server side datatable
	// public function getDataDt()
	// {
	
	//     $config = [ 
	// 				'host'     => 'localhost',
	// 		        'port'     => '3306',
	// 		        'username' => 'root',
	// 		        'password' => '',
	// 		        'database' => 'canteen_db' 
	// 		      ];

	//     $this->dt = new Datatables( new MySQL($config) );
	//     $this->dt->query('SELECT user_id, user_fullname, user_email, user_username, user_password FROM user');
	//     echo $this->dt->generate();
	// }

}