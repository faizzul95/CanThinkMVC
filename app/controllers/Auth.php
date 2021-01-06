<?php

class Auth extends Controller
{
	private $db;
	protected $model;
	
	public function __construct()
	{
		$this->db = new Database;
		$this->model = $this->model('User_model');
		$this->session = new \Configuration\SessionManager();
	}

	public function index()
	{

		$data = [
			'title' => 'Login',
		];

		$this->view('auth/login', $data);
	}

	public function login()
	{
		$this->view('auth/login');
	}

	public function register()
	{
		$this->view('auth/register');
	}

	public function authorize()
	{

		  $usr_username = $this->db->escape($_POST['username']);
	      $enteredPassword = $this->db->escape($_POST['password']);

		  $data = $this->model->getUserByEmail($usr_username);

	      if (count($data) > 1) {

		      $current_password = $data['user_password'];
		      $status = $data['status_id'];
		      $roleid = $data['role_id'];

		      $role = $this->model->getUserRole($roleid);
		      $rolename = $role['role_name'];

		      $result = $this->passDecrypt($current_password, $enteredPassword);

		      if ($result) {
			      	if ($status == '1') {

						  // Set session a USING SESSION MANAGER
						  $this->session->set('userID', $data['user_id']);
						  $this->session->set('username', $data['user_username']);
						  $this->session->set('fullname', $data['user_fullname']);
						  $this->session->set('userEmail', $data['userEmail']);
						  $this->session->set('roleID', $roleid);
						  $this->session->set('roleName', $rolename);
						  $this->session->set('avatar', $data['user_avatar']);
						  $this->session->set('isLoggedIn', TRUE);

		                  // Setting a COOKIE
						  // $cookie_name = "userID";
						  // $cookie_value = $_SESSION['userID'];
						  // setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
		                  
		                  header('Location: ' . base_url . 'user');
						  exit;

		            }else if ($status == '2') {
		                
		                  Flasher::setNotifications('Peringatan', 'Akaun anda tidak aktif !', 'warning');
						  header('Location: ' . base_url . 'auth');
						  exit;

		            }else if ($status == '3') {

		                  Flasher::setNotifications('Amaran !', 'Akaun anda telah disekat', 'error');
						  header('Location: ' . base_url . 'auth');
						  exit;
		            }
		      }else{

		      	Flasher::setNotifications('Gagal !', 'Nama Pengguna atau kata laluan tidak tepat', 'error');
				header('Location: ' . base_url . 'auth');
				exit;

		      }

	      }else{
				Flasher::setNotifications('Gagal !', 'Nama Pengguna atau kata laluan tidak tepat', 'error');
				header('Location: ' . base_url . 'auth');
				exit;
		  }

	}

	private function passDecrypt($dbpass, $enterpass){

	  if (password_verify($enterpass, $dbpass)) {
           return true;
      } else {
           return false; 
      }

	}

	public function logout()
	{
		// IF USE COOKIE UNCOMMENT THIS
		// if (isset($_COOKIE)) {
		//     foreach($_COOKIE as $name => $value) {
		//         if ($name != "preservecookie") // Name of the cookie you want to preserve 
		//         {
		//             setcookie($name, '', 1); // Better use 1 to avoid time problems, like timezones
		//             setcookie($name, '', 1, '/');
		//         }
		//     }
		// }

		$this->session->clear();

		Flasher::setNotifications('Berjaya !', 'Berjaya Log Keluar', 'success');
		header('Location: ' . base_url . 'auth');
		exit;
	}

}