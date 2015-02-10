CREATE TABLE nodes (
	id integer not null auto_increment primary key,
	title text not null,
	type varchar(255) not null default 'node',
	slug varchar(255),
	created_at timestamp default current_timestamp,
	updated_at timestamp /* default current_timestamp */
);

CREATE TABLE node_bodies (
	node_id integer not null primary key,
	content text not null,
	created_at timestamp default current_timestamp,
	updated_at timestamp /* default current_timestamp */
);