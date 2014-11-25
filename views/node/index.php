<h2><?php echo $node->title; ?></h2>
<?php foreach ($this->model as $node): ?>
<div class="node">
	<h3></h3>
	<div class="body">
		<?php echo $node->node_body->content; ?>
	</div>
</div>
<?php endforeach; ?>