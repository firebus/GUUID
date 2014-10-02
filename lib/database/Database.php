<?php

class Database {

	private $dbh;
	
	public function __construct($config) {
		$dsn = "mysql:host={$config->config['mysql_host']};dbname={$config->config['mysql_database']}";
		$this->dbh = new PDO($dsn, $config->config['mysql_username'], $config->config['mysql_password']);
	}
	
	public function registerRow($guid, $identity) {
		$sth = $this->dbh->prepare("INSERT INTO guid (created_time, guid, identity)"
			. " VALUES (CURRENT_TIMESTAMP, ?, ?)"
			. " ON DUPLICATE KEY UPDATE identity = ?, use_count = use_count + 1");
		$sth->execute(array($guid, $identity, $identity));
		
		$row = $this->getRow($guid);
		print_r($row);
		return array('guid' => $guid, 'use_count' => $row['use_count']);
	}
	
	public function releaseRow($guid, $identity) {
		$sth = $this->dbh->prepare("UPDATE guid SET identity = '' WHERE guid = ? AND identity = ?");
		$sth->execute(array($guid, $identity));
		
		$row = $this->getRow($guid);
		return array('guid' => $guid, 'use_count' => $row['use_count']);
	}

	public function getRow($guid) {
		$sth = $this->dbh->prepare("SELECT * FROM guid WHERE guid = ?");
		$sth->execute(array($guid));
		return $sth->fetch();
	}
	
	public function guid() {
		$sth = $this->dbh->query("SELECT guid FROM guid WHERE identity = '' ORDER BY use_count DESC LIMIT 1");
		return $sth->fetch();		
	}
}