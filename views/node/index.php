<h2>Content</h2>
<div class="actions">
	<?php if ($this->is_logged_in()): ?>
	<a href="/node/new">new</a>
	<?php endif; ?>
</div>
<?php foreach ($this->model as $node): ?>
<div class="node node-<?php echo $node->id; ?>">
	<h3><a href="<?php echo $node->get_url(); ?>"><?php echo $node->title; ?></a></h3>
	<div class="actions">
		<?php if ($this->is_logged_in()): ?>
		<a href="/node/<?php echo $node->id; ?>/edit">edit</a> |
		<a href="/node/<?php echo $node->id; ?>/delete">delete</a>
		<?php endif; ?>
	</div>
	<div class="body">
		<?php if ($node->node_body): ?>
		<?php echo $node->node_body->content; ?>
		<?php endif; ?>
	</div>
</div>
<?php endforeach; ?>