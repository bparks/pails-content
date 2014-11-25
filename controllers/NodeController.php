<?php
class NodeController extends \Pails\Controller
{
	function index ()
	{
		$this->model = Node::all();
	}

	//Handle everything else
	function __call($name, $arguments) {
		if (is_int($name))
			$this->model = Node::find($name);
		else
			$this->model = Node::find_by_id($name);
		$this->view = 'node/show';
	}
}