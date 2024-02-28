<?php

namespace src\Controllers;

use core\Request;
use src\Repositories\UserRepository;

class LoginController extends Controller
{

	/**
	 * Show the login page.
	 * @return void
	 */
	public function index(): void
	{

		$this->render('login');
		
	}

	public function settings(): void
	{

		$this->render('settings');
		
	}

	/**
	 * Process the login attempt.
	 * @param Request $request
	 * @return void
	 */
	public function login(Request $request): void
	{
		$email = $request->input('email');
		$password = $request->input('password');

		$user = (new UserRepository)->getUserByEmail($email);
		$correctPassword = password_verify($password, $user->password_digest);
		if ($correctPassword) {
			$_SESSION['logged_in_user'] = $user->id;
			$this->redirect('/');
		} else {
			$_SESSION['message'] = 'wrong login info';
			$this->redirect('/login');
		}
	}
}
