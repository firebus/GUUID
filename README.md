GUID
====

GUID is the Green Unique Identifier System.

The current use of GUIDs and UUIDs is very wasteful.
Most developers generate UIDs as needed and then discard them without thinking.
GUID is an API that lets developers register their UIDs, and then release them when they are no longer in use.
When a new UID is needed, developers can request a new one from GUID, and GUID will provision a recycled UID if possible.
If everyone uses GUID and is conscientious about releasing their UIDs when they are no longer in use, we can greatly reduce waste.

## Using GUID

* To use GUID you need a unique identifier that will identify all the UIDs you register. This ID is also a UID! You can use your
  own, or ask GUID to provide one (if possible, a recycled GUID will be provided!). Use the identify end-point to identify
  yourself.

* To register or unregister a UID with GUID, use the guid endpoint. Like identify, you can provide a UID to register, or have
  GUID provide you with one.

* GUIDs should be passed with hyphens and curly-braces, e.g. {33BA55AF-3A2D-033D-BD16-64247A1722C6}

## API endpoints

* GET /api/1.0/identify
** Provision a new identifier - GUID will provide the UID.
* PUT /api/1.0/identify/UID
** Register your own UID as an identifier.
* GET /api/1.0/guid?identity=UID
** Register a new UID - GUID will provide the UID.
* PUT /api/1.0/guid/UID?identity=UID
** Register your own UID.
* DELETE /api/1.0/guid/UID?identity=UID
** Release a GUID you've previously registered.

## API Responses

* On success, you'll receive a JSON-encoded array containing the following keys
** guid: the guid you've identified as or registered or released.
** use_count: the number of times this guid has been used.
* On error, you'll receive a JSON-encoded array containing the following keys
** error: a helpful error message.

## Deploying your own GUID

* Please don't do this, it will ruin everything if multiple people run GUID services.