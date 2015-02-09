<?php
/*
CREATE TABLE nodes (
	id integer not null auto_increment primary key,
	title text not null,
	type varchar(255) not null default 'node',
	slug varchar(255),
	created_at timestamp default current_timestamp,
	updated_at timestamp default current_timestamp
);
*/

class Node extends ActiveRecord\Model
{
	static $has_one = array(
		array('node_body')
	);

	function get_url() {
		if (strlen($this->slug) == 0)
			return '/node/' . $this->id;
		if (substr($this->slug, 0, 1) == '/')
			return $this->slug;
		return '/node/' . $this->slug;
	}
}