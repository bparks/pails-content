<form action="/node/update" method="POST">
<?php echo $this->input_for('id', '', array('type' => 'hidden', 'value' => $this->model->id)); ?>
<?php echo $this->input_for('title', 'Title', array('value' => $this->model->title)); ?>
<?php echo $this->input_for('slug', 'Slug', array('value' => $this->model->slug)); ?>
<?php echo $this->input_for('body', 'Content', array('type' => 'textarea', 'value' => ($this->model->node_body ? $this->model->node_body->content : ''))); ?>
<input type="submit" value="Save" />
</form>