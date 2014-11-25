<?php
/*
CREATE TABLE node_bodies (
	node_id integer not null primary key,
	content text not null,
	created_at timestamp default current_timestamp,
	updated_at timestamp default current_timestamp
);
*/

class NodeBody extends ActiveRecord\Model
{
	static $belongs_to = array(
		array('node')
	);
}