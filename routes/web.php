<?php

use core\Router;

use src\Controllers\ArticleController;
use src\Controllers\LoginController;
use src\Controllers\LogoutController;
use src\Controllers\RegistrationController;
use src\Controllers\SettingsController;

Router::get('/', [ArticleController::class, 'renderIndexPage']); // the root/index page

Router::get('/about', [ArticleController::class, 'about']);

Router::get('/new', [ArticleController::class, 'create']);

// User/Auth related

Router::get('/login', [LoginController::class, 'index']);
Router::post('/login', [LoginController::class, 'login']);

Router::get('/register', [RegistrationController::class, 'index']); // show registration form.
Router::post('/register', [RegistrationController::class, 'register']); // process a registration req.

Router::post('/logout', [LogoutController::class, 'logout']);

Router::post('/upload_image', [SettingsController::class, 'uploadImage']);

// Article related

Router::post('/articles/store', [ArticleController::class, 'store']);

Router::post('/articles/edit', [ArticleController::class, 'edit']);

Router::post('/articles/update', [ArticleController::class, 'update']);

Router::post('/articles/delete', [ArticleController::class, 'delete']);

// Settings related

Router::get('/settings', [SettingsController::class, 'index']); 

Router::post('/settings/update', [SettingsController::class, 'update']); 

Router::post('/settings/uploadImage', [SettingsController::class, 'uploadImage']); 