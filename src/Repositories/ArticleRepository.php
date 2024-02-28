<?php

namespace src\Repositories;

use src\Models\Article as Article;
use src\Models\User;

class ArticleRepository extends Repository {

	/**
	 * @return Article[]
	 */
	public function getAllArticles(): array {

			$sqlStatement = $this->pdo->query("SELECT * FROM articles;");
			$rows = $sqlStatement->fetchAll();
	
			$articles = [];
			foreach ($rows as $row) {
				$articles[] = new Article($row);
			}
	
			return $articles;
	}

	/**
	 * @param string $title
	 * @param string $url
	 * @param string $authorId
	 * @return Article|false
	 */
	public function saveArticle(string $title, string $url, string $authorId): Article|false {
		$created_at = date('Y-m-d H:i:s');

		$sqlStatement = $this->pdo->prepare("INSERT INTO articles (title, url, created_at, author_id) VALUES ( ?, ?, ?, ?);");
		$result = $sqlStatement->execute([ $title, $url, $created_at, $authorId]);

		if ($result) {
			$lastInsertId = $this->pdo->lastInsertId();
			return $this->getArticleById($lastInsertId);
		} else {
			echo "ruh roh";
			return false;
		}
	}

	/**
	 * @param int $id
	 * @return Article|false Article object if it was found, false otherwise
	 */
	public function getArticleById(int $id): Article|false {
		$sqlStatement = $this->pdo->prepare('SELECT * FROM articles WHERE id=?');
		$result = $sqlStatement->execute([$id]);
		if ($result) {
			$resultSet = $sqlStatement->fetch();
			return new Article($resultSet);
		}
		return false;
	}

	/**
	 * @param int $id
	 * @param string $title
	 * @param string $url
	 * @return bool true on success, false otherwise
	 */
	public function updateArticle(int $id, string $title, string $url): bool {
		$updatedAt = date('Y-m-d H:i:s');
		$sqlStatement = $this->pdo->prepare("UPDATE articles SET title=?, url=?, updated_at=? WHERE id=?");
		$result = $sqlStatement->execute([$title, $url, $updatedAt, $id]);
		return $result;
	}

	/**
	 * @param int $id
	 * @return bool true on success, false otherwise
	 */
	public function deleteArticleById(int $id): bool {
		$sqlStatement = $this->pdo->prepare("DELETE FROM articles WHERE id=?");
		$result = $sqlStatement->execute([$id]);
		return $result;
	}

	/**
	 * @param string $articleId
	 * @return User|false
	 */
	public function getArticleAuthor(string $articleId): User|false {
        $sqlStatement = $this->pdo->prepare('SELECT * FROM users WHERE id=(SELECT author_id FROM articles WHERE id=?)');
        $result = $sqlStatement->execute([$articleId]);

        if ($result) {
            $resultSet = $sqlStatement->fetch();
            return new User($resultSet);
        }

        return false;
	}

}
