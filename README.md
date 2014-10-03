GUUID
====

GUUID is the Green Universal Unique Identifier System.

The current use of GUIDs and UUIDs is very wasteful.
Most developers generate UUIDs as needed and then discard them without thinking.
GUUID is an API that lets developers register their UUIDs, and then release them when they are no longer in use.
When a new UUIDs is needed, developers can request a new one from GUUID, and GUUID will provision a recycled UUID if possible.
If everyone uses GUUID and is conscientious about releasing their UUIDs when they are no longer in use, we can greatly reduce waste.

## Using GUUID

* To use GUUID you need a unique identifier that will identify all the UUIDs you register. This ID is also a UUID! You can use your
  own, or ask GUUID to provide one (if possible, a recycled GUUID will be provided!). Use the identify end-point to identify
  yourself.

* To register or unregister a UUID with GUUID, use the uuid endpoint. Like identify, you can provide a UUID to register, or have
  GUUID provide you with one.

* UUIDs should be passed with hyphens and curly-braces, e.g. {33BA55AF-3A2D-033D-BD16-64247A1722C6}

## API endpoints

* GET /api/1.0/identify
** Provision a new identifier - GUUID will provide the UUID.
* PUT /api/1.0/identify/UID
** Register your own UUID as an identifier.
* GET /api/1.0/uuid?identity=UUID
** Register a new UUID - GUUID will provide the UUID.
* PUT /api/1.0/uuid/UUID?identity=UUID
** Register your own UUID.
* DELETE /api/1.0/uuid/UUID?identity=UUID
** Release a UUID you've previously registered.

## API Responses

* On success, you'll receive a JSON-encoded array containing the following keys
** uuid: the uuid you've identified as or registered or released.
** use_count: the number of times this uuid has been used.
* On error, you'll receive a JSON-encoded array containing the following keys
** error: a helpful error message.

## Deploying your own GUUID

* Please don't do this, it will ruin everything if multiple people run GUUID services.