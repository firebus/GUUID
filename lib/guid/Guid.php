<?php

class Guid {
	
	private $database;
	
	public function __construct($database) {
		$this->database = $database;
	}
	
	public function guid() {
		$recycledGuid = $this->database->guid();
		if ($recycledGuid) {
			$uuid = $recycledGuid['guid'];
		} elseif (function_exists('com_create_guid')) {
			$uuid = com_create_guid();
		} else {
			mt_srand((double)microtime() * 10000); //optional for php 4.2.0 and up.
			$charid = strtoupper(md5(uniqid(rand(), true)));
			$hyphen = chr(45); // "-"
			$uuid = chr(123) // "{"
					.substr($charid, 0, 8).$hyphen
					.substr($charid, 8, 4).$hyphen
					.substr($charid,12, 4).$hyphen
					.substr($charid,16, 4).$hyphen
					.substr($charid,20,12)
					.chr(125); // "}"
		}
		
		return $uuid;
	}
}