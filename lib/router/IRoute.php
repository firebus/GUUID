<?php

interface IRoute {
	public function register();
	public function execute($request, $database, $guid);
}