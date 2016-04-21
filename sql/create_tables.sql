CREATE TABLE Player(
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	password varchar(50) NOT NULL
);

CREATE TABLE Category(
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL
); 

CREATE TABLE Task(
	id SERIAL PRIMARY KEY,
	player_id INTEGER REFERENCES Player(id),
	name varchar(50) NOT NULL,
	done boolean DEFAULT FALSE,
	description varchar(400),
	category INTEGER REFERENCES Category(id),
	importance INTEGER,
	added DATE
);
