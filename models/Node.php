<?php
/*
CREATE TABLE nodes (
	id integer not null auto_increment primary key,
	title text not null,
	created_at timestamp default current_timestamp,
	updated_at timestamp default current_timestamp
);
*/

class Node extends ActiveRecord\Model
{
	static $has_one = array(
		array('node_body')
	);
}