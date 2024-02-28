<?php

namespace src\Repositories;

use src\Models\User;

class UserRepository extends Repository {

	/**
	 * @param string $id
	 * @return User|false
	 */
	public function getUserById(string $id): User|false {
		$sqlStatement = $this->pdo->prepare('SELECT * FROM users WHERE id=?');
		$result = $sqlStatement->execute([$id]);
		if ($result) {
			$resultSet = $sqlStatement->fetch();
			return new User($resultSet);
		}
		return false;
	}

	/**
	 * @param string $email
	 * @return User|false
	 */
	public function getUserByEmail(string $email): User|false {
		$sqlStatement = $this->pdo->prepare('SELECT * FROM users WHERE email=?');
		$result = $sqlStatement->execute([$email]);
		if ($result) {
			$resultSet = $sqlStatement->fetch();
			return new User($resultSet);
		}
		return false;
	}

	/**
	 * @param string $passwordDigest
	 * @param string $email
	 * @param string $name
	 * @return User|false
	 */
	public function saveUser(string $name, string $email, string $passwordDigest): User|false {
		
		$description = 'placeholder';
		$profilePicture = 'placeholder';

		$hashedPassword = password_hash($passwordDigest, PASSWORD_DEFAULT);

		$sqlStatement = $this->pdo->prepare("INSERT INTO users (password_digest, email, name, description, profile_picture) VALUES ( ?, ?, ?, ?, ?);");
		$result = $sqlStatement->execute([ $hashedPassword, $email, $name, $description, $profilePicture]);

		if ($result) {
			$lastInsertId = $this->pdo->lastInsertId();
			$_SESSION['logged_in_user'] = $lastInsertId;
			return $this->getUserById($lastInsertId);
		} else {
			echo "ruh roh";
			return false;
		}
	}

	/**
	 * @param int $id
	 * @param string $name
	 * @param string|null $profilePicture
	 * @return bool
	 */
	public function updateUser(int $id, string $name, ?string $profilePicture = null): bool {
		$sqlStatement = $this->pdo->prepare("UPDATE users SET name=?, profile_picture=? WHERE id=?");
		$result = $sqlStatement->execute([$name, $profilePicture, $id]);
		return $result;
	}

}
