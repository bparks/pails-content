<h2>Content</h2>
<div class="actions">
	<?php if ($this->is_logged_in()): ?>
	<a href="/node/new">new</a>
	<?php endif; ?>
</div>
<?php foreach ($this->model as $node): ?>
<div class="<?php echo $node->type; ?> <?php echo $node->type; ?>-<?php echo $node->id; ?>">
	<?php $this->render_partial($node->type.'/_'.$node->type.'_summary', $node); ?>
</div>
<?php endforeach; ?>