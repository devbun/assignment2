<?php

namespace src\Controllers;

use core\Request;
use src\Repositories\ArticleRepository;
use src\Repositories\UserRepository;
use src\Models\Article;

class ArticleController extends Controller
{

	/**
	 * Display the page showing the articles.
	 * @return void
	 */
	public function renderIndexPage(): void
	{
		$articles = (new ArticleRepository)->getAllArticles();
		$this->render('index', ['articles' => []]);
	}

	public function about(): void
	{
		$this->render('about', ['articles' => []]);
	}

	/**
	 * Process the storing of a new article.
	 * @return void
	 */
	public function create(): void
	{
		if ($_SESSION['logged_in_user']) {
			$this->render('new_article', ['articles' => []]);
		}
		$this->redirect('/login');
	}

	public function store(Request $request)
	{
		$title = $_REQUEST['title'];
		$url = $_REQUEST['url'];
		$authorId = $_SESSION['logged_in_user'];
		
		$articleRepository = new ArticleRepository();
		$articleRepository->saveArticle($title, $url, $authorId);
		$this->redirect('/');
	}

	/**
	 * Show the form for editing an article.
	 * @param Request $request
	 * @return void
	 */
	public function edit(Request $request): void
	{
		// TODO
		$id = $_REQUEST['id'];
		$this->render('update_article', ['articles' => []]);
	}

	/**
	 * Process the editing of an article.
	 * @param Request $request
	 * @return void
	 */
	public function update(Request $request): void
	{
		// TODO
		$id = $_REQUEST['id'];
		$title = $_REQUEST['title'];
		$url = $_REQUEST['url'];
		
		$articleRepository = new ArticleRepository();
		$articleRepository->updateArticle($id, $title, $url);
		$this->redirect('/');
	}

	/**
	 * Process the deleting of an article.
	 * @param Request $request
	 * @return void
	 */
	public function delete(Request $request): void
	{
		$id = $_REQUEST['id'];
		$articleRepository = new ArticleRepository();
		$articleRepository->deleteArticleById($id);
		$this->render('index', ['articles' => []]);
	}
}
