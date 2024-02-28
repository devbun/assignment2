<?php

namespace src\Controllers;

use core\Request;
use PDOException;
use src\Repositories\UserRepository;

class RegistrationController extends Controller
{

	/**
	 * @return void
	 */
	public function index(): void
	{
		$this->render('register');
	}

	public function register(Request $request): void
	{

		$password_digest = $_POST['password'];
		$email = $_POST['email'];
		$name = $_POST['name'];

			if (strlen($password_digest) < 8) {
				$_SESSION['message'] = 'Password needs to be at least 8 characters';
				$this->redirect('/register');
				return;  
			}
		
			if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password_digest)) {
				$_SESSION['message'] = 'Password must contain at least one symbol';
				$this->redirect('/register');
				return;  
			}
		
		$userRepository = new UserRepository();
		$userRepository->saveUser($name, $email, $password_digest);
		$this->redirect('/');
	}
}
