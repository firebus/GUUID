<?php

class Config {
	
	private $config;
	
	public function __construct($configFile) {
		$this->config = parse_ini_file($configFile);
	}
	
	public function __get($name) {
		return $this->$name;
	}
}