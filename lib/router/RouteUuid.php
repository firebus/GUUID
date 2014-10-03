<?php

require_once('IRoute.php');

class RouteUuid implements IRoute {
	
	public function register() {
		return 'api/1.0/guid';
	}
	
	public function execute($request, $database, $uuid) {
		switch ($request->method) {
			case 'GET':
				$id = $uuid->uuid();
				$identity = $request->parameters['identity'];
				$result = $database->registerRow($id, $identity);
				break;
			case 'PUT':
				$id = $request->api_id;
				$identity = $request->parameters['identity'];
				$result = $database->registerRow($id, $identity);
				break;
			case 'DELETE':
				$id = $request->api_id;
				$identity = $request->parameters['identity'];
				$result = $database->releaseRow($id, $identity);
				break;
		}
		
		return json_encode($result);
	}
}