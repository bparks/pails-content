<form action="/node/create" method="POST">
<?php echo $this->input_for('title', 'Title'); ?>
<?php echo $this->input_for('slug', 'Slug'); ?>
<?php echo $this->input_for('body', 'Content', array('type' => 'textarea')); ?>
<input type="submit" value="Save" />
</form>