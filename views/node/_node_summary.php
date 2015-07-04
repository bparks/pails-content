	<h3><a href="<?php echo $model->get_url(); ?>"><?php echo $model->title; ?></a></h3>
	<div class="actions">
		<?php if ($this->is_logged_in()): ?>
		<a href="/node/<?php echo $model->id; ?>/edit">edit</a> |
		<a href="/node/<?php echo $model->id; ?>/delete">delete</a>
		<?php endif; ?>
	</div>
	<div class="body">
		<?php if ($model->node_body): ?>
		<?php echo $model->node_body->content; ?>
		<?php endif; ?>
	</div>