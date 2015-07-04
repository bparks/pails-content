<?php
//Include relevant models
require_once(__DIR__.'/models/Node.php');
require_once(__DIR__.'/models/NodeBody.php');

//Controllers and views get included automatically

function content_config($app)
{
	$app->registerRouter(function ($uri) {
		$req = new Pails\Request();
		if (Node::find_by_slug($uri))
		{
			$req->controller = 'node';
			$req->action = $uri;
			$req->raw_parts = array($req->controller, $req->action);
			return $req;
		}
		return false;
	});

	if (defined('ADMIN_MENU_SLUG'))
	{
		Menu::add_static_item(ADMIN_MENU_SLUG, 'Content', '/node');
	}
}