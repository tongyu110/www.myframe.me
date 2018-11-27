<?php


	#判断 PHP 的版本是否合法
	#初始化系统时区
	#加载路由

        
        define('APP_ROOT',dirname(__DIR__));
        define('SITE_URL','http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['PHP_SELF'],0,-10));
        
        date_default_timezone_set('Asia/Shanghai');

	require '../../vendor/autoload.php';
	$config = require '../config/base.php';


	$router = new AltoRouter();

	// map homepage
	$router->map( 'GET', '/', function() {
		echo "Welcome My Frame";
		//require __DIR__ . '/views/home.php';
	});

	// map user details page
	$router->map( 'GET', '/user/[i:id]/', function( $id ) {
		echo $id;
		//require __DIR__ . '/views/user-details.php';
	});


	$router->map( 'GET|POST', '/[a:controller]/[a:action]', function($controller,$action) {

		
		$controllerClass = '\app\controllers\\'.ucfirst($controller).'Controller';
		$controller = new $controllerClass();
		if(method_exists($controller, $action)) {
			$controller->$action();
		}else{
			echo "method not find";
		}
		

	});

	$router->map( 'GET|POST', '/[a:controller]/[a:action]/?[**:]', function($controller,$action) {

		$args = explode('/',$_SERVER['REQUEST_URI']);
		$args = array_slice($args,3);

		
		$controllerClass = '\app\controllers\\'.ucfirst($controller).'Controller';
		$controller = new $controllerClass();
		if(method_exists($controller, $action)) { 
			$controller->$action(...$args);
		}else{
			echo "method not find";
		}
		

	});


	$router->map( 'GET', '/todo/index', function() {
		
		$controller = new \app\controllers\TodoController();
		$controller->index();

	});

	$router->map( 'GET', '/todo/remove', function() {
		
		$controller = new \app\controllers\TodoController();
		$controller->remove();

	});


	/**
	 *	/todo/index
	 */




	// match current request url
	$match = $router->match();

	// call closure or throw 404 status
	if( $match && is_callable( $match['target'] ) ) {
		call_user_func_array( $match['target'], $match['params'] ); 
	} else {
		// no route was matched
		header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
	}

	

?>