<?php

namespace src\Controllers;

use core\Request;
use src\Repositories\UserRepository;

class SettingsController extends Controller
{

	/**
	 * @param Request $request
	 * @return void
	 */
	public function index(Request $request): void
	{
		// TODO
		$this->render('settings', [
			'user' => null
		]);
	}

	public function uploadImage(Request $request)
	{
		var_dump($request);
		exit;
	}

	/**
	 * @param Request $request
	 * @return void
	 */
	public function update(Request $request): void
	{
		$id = $_REQUEST['id'];
		$name = $_REQUEST['name'];
		if ($_REQUEST['profile_picture']) {
			$profilePicture = $_REQUEST['profile_picture'];
		} else {
			$profilePicture = '';
		}

		$userRepository = new UserRepository();
		$userRepository->updateUser($id, $name, $profilePicture);
		$this->redirect('/');
	}
}
