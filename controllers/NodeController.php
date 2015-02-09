<?php
class NodeController extends \Pails\Controller
{
	use PailsAuthentication;
	use FormBuilder;

	function index ()
	{
		$this->model = Node::all();
	}

	function create ()
	{
		$node = Node::create(array(
			'title' => $_POST['title'],
			'slug' => $_POST['slug']
		));

		$node_body = NodeBody::create(array(
			'content' => $_POST['body'],
			'node_id' => $node->id
		));

		$this->model = $node->get_url();
		return 302;
	}

	function update()
	{
		$node = Node::find($_POST['id']);
		$node->title = $_POST['title'];
		$node->slug = $_POST['slug'];
		$node->save();

		if ($node->node_body)
		{
			$node->node_body->content = $_POST['body'];
		}
		else
		{
			NodeBody::create(array(
				'content' => $_POST['body'],
				'node_id' => $node->id
			));
		}

		$this->model = $node->get_url();
		return 302;
	}

	//Handle everything else
	function __call($name, $arguments) {
		if ($name == 'new') {
			$this->view = 'node/new';
			return;
		}

		if (intval($name) > 0)
			$this->model = Node::find_by_id($name);
		else
			$this->model = Node::find_by_slug($name);

		if (!($this->model))
		{
			$this->view = false;
			return 404;
		}

		if (count($arguments) > 0)
		{
			$opts = $arguments[0];
			if ($opts[0] == 'edit')
				$this->view = 'node/edit';
			else
				$this->view = 'node/show';
		}
		else
		{
			$this->view = 'node/show';
		}
	}
}