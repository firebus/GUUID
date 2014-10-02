<?php

require_once('IRoute.php');

class RouteIdentify implements IRoute {
	
	public function register() {
		return 'api/1.0/identify';
	}
	
	public function execute($request, $database, $guid) {
		switch ($request->method) {
			case 'GET':
				$id = $guid->guid();
				$result = $database->registerRow($id, 'IDENTITY');
				break;
			case 'PUT':
				$id = $request->api_id;
				$result = $database->registerRow($id, 'IDENTITY');
				break;
		}
		
		return json_encode($result);
	}	
}