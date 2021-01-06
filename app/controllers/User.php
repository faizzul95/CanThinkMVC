<?php

class User extends Controller
{
	protected $user_model;

	public function __construct()
	{
		$this->user_model = $this->model('User_model');
	}

	public function index()
	{
		$data = [
			'title' => 'List User',
			'user' => $this->user_model->getAllUser(),
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

}