<?php
class NodeController extends \Pails\Controller
{
	use PailsAuthentication;
	use FormBuilder;

	public $before_actions = array(
		'require_login' => array('only' => array('new', 'create', 'update', 'delete')),
		'require_permission' => array('only' => array('new', 'create', 'update', 'delete'), 'options' => 'manage-content')
	);

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

	function update ()
	{
		$node = Node::find($_POST['id']);
		$node->title = $_POST['title'];
		$node->slug = $_POST['slug'];
		$node->save();

		if ($node->node_body)
		{
			$node->node_body->content = $_POST['body'];
			$node->node_body->save();
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

	function delete ()
	{
		$node = Node::find($_POST['id']);
		$node->node_body->delete();
		$node->delete();

		$this->model = '/node';
		return 302;
	}

	//Handle everything else
	function __call($name, $arguments) {
		if ($name == 'new') {
			$this->require_login();
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
			return $this->notFound();
		}

		if (count($arguments) > 0)
		{
			$opts = $arguments[0];
			if ($opts[0] == 'edit')
			{
				$this->require_login();
				$this->require_permission(['manage-content']);
				return $this->view('node/edit');
			}
			elseif ($opts[0] == 'delete')
			{
				$this->require_login();
				$this->require_permission(['manage-content']);
				return $this->view('node/delete');
			}
			else
				return $this->view('node/show');
		}
		else
		{
			if ($this->model->type != '' && $this->model->type != 'node')
				return $this->redirect('/'.$this->model->type.'/'.$name);

			if ($this->model->slug != '') {
				if (substr($this->model->slug, 0, 1) === '/')
					$expected_url = $this->model->slug;
				else
					$expected_url = '/node/'.$this->model->slug;

				$actual_url = parse_url($_SERVER['REQUEST_URI'])['path'];

				if ($expected_url != $actual_url)
					return $this->redirect($expected_url);
			}

			return $this->view('node/show');
		}
	}
}