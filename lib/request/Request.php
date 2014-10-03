<?php

class Request{
	
	private $path;
	private $method;
	private $api_version;
	private $api_endpoint;
	private $api_id;
	private $parameters;
	
	public function __construct($config) {
		$this->path = preg_replace(
			'/^' . preg_quote($config->config['path_prefix'], '/') . '/', '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
		$this->method = $_SERVER['REQUEST_METHOD'];
		if (strpos($this->path, 'api') === 0) {
			$pathParts = explode('/', $this->path);
			$this->api_version = $pathParts[1];
			$this->api_endpoint = $pathParts[2];
			$this->api_id = isset($pathParts[3]) ? $pathParts[3] : NULL;
			$this->parameters = $_GET;
		}
	}
	
	public function __get($name) {
		return $this->$name;	
	}
}