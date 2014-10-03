<?php

class Database {

	private $dbh;
	
	public function __construct($config) {
		$dsn = "mysql:host={$config->config['mysql_host']};dbname={$config->config['mysql_database']}";
		$this->dbh = new PDO($dsn, $config->config['mysql_username'], $config->config['mysql_password']);
	}
	
	public function registerRow($uuid, $identity) {
		$sth = $this->dbh->prepare("INSERT INTO guuid (created_time, uuid, identity)"
			. " VALUES (CURRENT_TIMESTAMP, ?, ?)"
			. " ON DUPLICATE KEY UPDATE identity = ?, use_count = use_count + 1");
		$sth->execute(array($uuid, $identity, $identity));
		
		$row = $this->getRow($uuid);
		return array('uuid' => $uuid, 'use_count' => $row['use_count']);
	}
	
	public function releaseRow($uuid, $identity) {
		$sth = $this->dbh->prepare("UPDATE guuid SET identity = '' WHERE uuid = ? AND identity = ?");
		$sth->execute(array($uuid, $identity));
		
		$row = $this->getRow($uuid);
		return array('guid' => $uuid, 'use_count' => $row['use_count']);
	}

	public function getRow($uuid) {
		$sth = $this->dbh->prepare("SELECT * FROM guuid WHERE uuid = ?");
		$sth->execute(array($uuid));
		return $sth->fetch();
	}
	
	public function uuid() {
		$sth = $this->dbh->query("SELECT uuid FROM guuid WHERE identity = '' ORDER BY use_count DESC LIMIT 1");
		return $sth->fetch();		
	}
}