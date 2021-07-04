
<?php 

if( isset( $_GET['rt'] ) )
	$route = $_GET['rt'];
else
	$route = 'index';

// $route == 'con/act' => $controllerName='con', $action='act'
$parts = explode( '/', $route );

$controllerName = $parts[0] . 'Controller';
if( isset( $parts[1] ) )
	$action = $parts[1];
else
	$action = 'index';

// Controller $controllerName se nalazi poddirektoriju controller
$controllerFileName = 'controller/' . $controllerName . '.php';

require_once $controllerFileName;

$con = new $controllerName; 

//ako nema akcije onda je ona index
if( !method_exists( $con, $action ) )
	$action = 'index';

	
$con->$action();

?>