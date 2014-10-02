<?php

require_once('IRoute.php');

class RouteHome implements IRoute {
	
	public function register() {
		return 'DEFAULT';
	}
	
	public function execute($request, $database, $guid) {
		return <<<EOT
<h1>GUID</h1>
	
<div>GUID is the Green Unique Identifier System.</div>

<div>
	The current use of GUIDs and UUIDs is very wasteful.<br>
	Most developers generate UIDs as needed and then discard them without thinking.<br>
	GUID is an API that lets developers register their UIDs, and then release them when they are no longer in use.<br>
	When a new UID is needed, developers can request a new one from GUID, and GUID will provision a recycled UID if possible.<br>
	If everyone uses GUID and is conscientious about releasing their UIDs when they are no longer in use, we can greatly reduce
	waste.<br>
</div>
		
<h2>Using GUID</h2>

<ul>
    <li>
        To use GUID you need a unique identifier that will indentify all the UIDs you register. This ID is also a UID! You can
		use your own, or ask GUID to provide one (if possible, a recycled GUID will be provided!). Use the identify end-point to
		indentify yourself
	</li>
	<li>
		To register or unregister a UID with GUID, use the guid endpoint. Like identify, you can provide a UID to register, or
		have GUID provide you with one.
	</li>
	<li>
		GUIDs should be passed with hyphens and curly-braces, e.g. {33BA55AF-3A2D-033D-BD16-64247A1722C6}
	</li>
</ul>
		
<h2>API endpoints</h2>

<dl>
	<dt>GET /api/1.0/identify</dt>
	<dd>Provision a new identifier.</dd>
	<dt>PUT /api/1.0/identify/UID</dt>
	<dd>Register your own UID as an identifier</dd>
	<dt>GET /api/1.0/guid?identity=UID</dt>
	<dd>Register a new UID - GUID will provide it.</dd>
	<dt>PUT /api/1.0/guid/UID?identity=UID</dt>
	<dd>Register your own UID</dt>
	<dt>DELETE /api/1.0/guid/UID?identity=UID</dt>
	<dd>Release a GUID you've previously registered</dd>
</dl>

<h2>API Responses</h2>

<ul>
	<li>
		On success, you'll receive a JSON-encoded array containing the following keys
		<ul>
			<li>guid: the guid you've identified as or registered or released</li>
			<li>use_count: the number of times this guid has been used!</li>
		</ul>
	</li>
	<li>
		On error, you'll receive a JSON-encoded array containing the following keys
		<ul>
			<li>error: a helpful error message.</li>
		</ul>
	</li>
EOT;
	}
}