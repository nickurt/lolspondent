<?php
require __DIR__ . '/../vendor/autoload.php';

define('TEMPLATE_PATH', 	__DIR__ .'/../templates');

// Slim
$app = new \Slim\Slim(
	[
    	'templates.path' 	=> 	TEMPLATE_PATH,
    	'debug'				=> 	true,
    	'log.enabled'		=>	false,
    	'log.level'			=> 	\Slim\Log::DEBUG,
    	'mode'				=>	'production',
 	]
);

// Singleton for the database
$app->container->singleton('db', function () {
    return new PDO('sqlite:'. realpath(__DIR__. '/../data/lolspondent.db'));
});

// Database
$db = $app->db;

// Homepage
$app->get('/', function() use($app, $db) {
	$recent 		= 	$db->query("SELECT *, COUNT( decorrespondent_id ) as count FROM posts GROUP BY decorrespondent_id ORDER BY id desc LIMIT 15");
	$populair 		= 	$db->query("SELECT *, COUNT( decorrespondent_id ) as count FROM posts GROUP BY decorrespondent_id ORDER BY count desc LIMIT 15");

	$app->render('static/home.php', ['recent' => $recent, 'populair' => $populair], 200);
})->name('home');

// Page with articles
$app->get('/article', $article = function($id = 1) use ($db, $app) { 
	$pages 			= 	$db->query("SELECT COUNT( * ) as aggregate FROM posts GROUP BY decorrespondent_id");

	// Information about the paginator
	$page_info		=	[
							'all_pages' 	=>	$pages->rowCount(),
							'current_page'	=> 	$id,
							'max_pages'		=>	(int) floor($pages->rowCount()/15),	
							'next_page'		=>	$id+1,
							'prev_page'		=> 	$id-1,
						];

	$articles 		= 	$db->prepare("SELECT *, COUNT( decorrespondent_id ) as count FROM posts GROUP BY decorrespondent_id ORDER BY decorrespondent_id desc LIMIT 15 OFFSET :offset");
	$articles->bindValue(':offset', (int) ($page_info['current_page']-1) * 15, PDO::PARAM_INT);
	$articles->execute();

	$app->render('articles/index.php', ['articles' => $articles, 'pages' => $pages, 'page_info' => $page_info], 200);
})->name('articles');

// Support for multiple pages for the articles
$app->get('/article/page/:id', $article)->conditions(['id' => '[0-9]+']);

// Show the Article
$app->get('/article/:id', function ($id) use ($db, $app) {
    $links 			= 	$db->prepare("SELECT * FROM posts WHERE decorrespondent_id = :id ORDER BY url ASC");
    $links->bindValue(':id', (int) $id, PDO::PARAM_INT);
	$links->execute();
	
    $app->render('articles/article.php', ['links' => $links], 200);
})->conditions(['id' => '[0-9]+']);

// 404!
$app->notFound(function() use ($app) {
	$app->render('errors/404.php', [], 404);
});

// Run the app!
$app->run();