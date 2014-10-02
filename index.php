<?php

require_once('lib/config/Config.php');
$config = new Config('config.ini');

require_once('lib/request/Request.php');
// TODO: Get this from config
$request = new Request($config);

require_once('lib/database/Database.php');
$database = new Database($config);

require_once('lib/guid/Guid.php');
$guid = new Guid($database);

require_once('lib/router/Router.php');
$router = new Router(array('Home', 'Guid', 'Identify'));
print $router->route($request, $database, $guid);