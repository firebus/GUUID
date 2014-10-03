<?php

class Router {
	
	private $routeRegistry;
	
	public function __construct($routes) {
		foreach ($routes as $route) {
			$routeClassName = "Route$route";
			require_once("$routeClassName.php");
			$routeInstance = new $routeClassName;
			$this->routeRegistry[$route] = array(
				'route' => $routeInstance,
				'path' => $routeInstance->register(),
			);
		}
	}
	
	public function route($request, $database, $uuid) {
		// Find a matching path
		foreach ($this->routeRegistry as $route) {
			if (strpos($request->path, $route['path']) === 0) {
				$match = $route;
			}
			
			if ($route['path'] == 'DEFAULT') {
				$default = $route;
			}
		}

		if (isset($match)) {
			$return = $match['route']->execute($request, $database, $uuid);
		} elseif (isset($default)) {
			$return = $default['route']->execute($request, $database, $uuid);
		} else {
			$return = "No route found for this path\n";
		}
		
		return $return;
	}
}