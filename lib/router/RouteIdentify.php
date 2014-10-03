<?php

require_once('IRoute.php');

class RouteIdentify implements IRoute {
	
	public function register() {
		return 'api/1.0/identify';
	}
	
	public function execute($request, $database, $uuid) {
		switch ($request->method) {
			case 'GET':
				$id = $uuid->uuid();
				$result = $database->registerRow($id, 'IDENTITY');
				break;
			case 'PUT':
				$id = urldecode($request->api_id);
				$result = $database->registerRow($id, 'IDENTITY');
				break;
		}
		
		return json_encode($result);
	}	
}