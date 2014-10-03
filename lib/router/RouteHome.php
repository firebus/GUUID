<?php

require_once('IRoute.php');

class RouteHome implements IRoute {
	
	public function register() {
		return 'DEFAULT';
	}
	
	public function execute($request, $database, $uuid) {
		return <<<EOT
<h1>GUUID</h1>
	
<div>GUUID is the Green Unique Identifier System.</div>

<div>
	The current use of GUIDs and UUIDs is very wasteful.<br>
	Most developers generate UUIDs as needed and then discard them without thinking.<br>
	GUUID is an API that lets developers register their UUIDs, and then release them when they are no longer in use.<br>
	When a new UUID is needed, developers can request a new one from GUUID, and GUUID will provision a recycled UUID if possible.<br>
	If everyone uses GUUID and is conscientious about releasing their UUIDs when they are no longer in use, we can greatly reduce
	waste.<br>
</div>
		
<h2>Using GUUID</h2>

<ul>
    <li>
        To use GUUID you need a unique identifier that will identify all the UUIDs you register. This ID is also a UUID! You can
		use your own, or ask GUUID to provide one (if possible, a recycled GUUID will be provided!). Use the identify end-point to
		identify yourself.
	</li>
	<li>
		To register or unregister a UUID with GUUID, use the guid endpoint. Like identify, you can provide a UUID to register, or
		have GUUID provide you with one.
	</li>
	<li>
		GUUIDs should be passed with hyphens and curly-braces, e.g. {33BA55AF-3A2D-033D-BD16-64247A1722C6}
	</li>
</ul>
		
<h2>API endpoints</h2>

<dl>
	<dt>GET /api/1.0/identify</dt>
	<dd>Provision a new identifier.</dd>
	<dt>PUT /api/1.0/identify/UUID</dt>
	<dd>Register your own UUID as an identifier.</dd>
	<dt>GET /api/1.0/guid?identity=UUID</dt>
	<dd>Register a new UUID - GUUID will provide it.</dd>
	<dt>PUT /api/1.0/guid/UUID?identity=UUID</dt>
	<dd>Register your own UUID.</dt>
	<dt>DELETE /api/1.0/guid/UUID?identity=UUID</dt>
	<dd>Release a GUUID you've previously registered.</dd>
</dl>

<h2>API Responses</h2>

<ul>
	<li>
		On success, you'll receive a JSON-encoded array containing the following keys
		<ul>
			<li>guid: the guid you've identified as or registered or released.</li>
			<li>use_count: the number of times this guid has been used.</li>
		</ul>
	</li>
	<li>
		On error, you'll receive a JSON-encoded array containing the following keys
		<ul>
			<li>error: a helpful error message.</li>
		</ul>
	</li>
</ul>

<a href="https://github.com/firebus/GUUID"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/e7bbb0521b397edbd5fe43e7f760759336b5e05f/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f677265656e5f3030373230302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_green_007200.png"></a>
EOT;
	}
}