CREATE SCHEMA main;
--< Catalogs
CREATE TABLE main.positions
(
	id SERIAL NOT NULL PRIMARY KEY,
	name VARCHAR NOT NULL UNIQUE
);

CREATE TABLE main.degrees
(
	id SERIAL NOT NULL PRIMARY KEY,
	name VARCHAR NOT NULL UNIQUE
);

CREATE TABLE main.titles
(
	id SERIAL NOT NULL PRIMARY KEY,
	name VARCHAR NOT NULL UNIQUE
);

CREATE TABLE main.departments
(
	id SERIAL NOT NULL PRIMARY KEY,
	name VARCHAR NOT NULL UNIQUE
);

CREATE TABLE main.staff_types
(
	id SERIAL NOT NULL PRIMARY KEY,
	name VARCHAR NOT NULL UNIQUE,
	is_member BOOL NOT NULL DEFAULT TRUE
);

CREATE TABLE main.check_states
(
	id SERIAL NOT NULL PRIMARY KEY,
	name VARCHAR NOT NULL UNIQUE
);
-->

CREATE TABLE main.staff 
(
	id SERIAL NOT NULL PRIMARY KEY,
	firstname VARCHAR NOT NULL,
	lastname VARCHAR NOT NULL,
	birth_date TIMESTAMP NOT NULL,
	inn VARCHAR NOT NULL UNIQUE,
	photo TEXT
);

CREATE TABLE main.department_staff
(
	id SERIAL NOT NULL PRIMARY KEY,
	department INT REFERENCES main.departments
	ON UPDATE CASCADE ON DELETE CASCADE,
	employee INT NOT NULL REFERENCES main.staff
	ON UPDATE CASCADE ON DELETE CASCADE,
	emp_position INT REFERENCES main.positions
	ON UPDATE CASCADE ON DELETE CASCADE,
	degree INT REFERENCES main.degrees 
	ON UPDATE CASCADE ON DELETE CASCADE,
	title INT REFERENCES main.titles
	ON UPDATE CASCADE ON DELETE CASCADE,
	emp_type INT REFERENCES main.staff_types
	ON UPDATE CASCADE ON DELETE CASCADE,
	wage_rate DECIMAL,
	date_from TIMESTAMP,
	date_to TIMESTAMP
);

CREATE TABLE main.users
(
	id INT NOT NULL PRIMARY KEY 
	REFERENCES main.department_staff ON UPDATE CASCADE ON DELETE CASCADE,
	email VARCHAR NOT NULL UNIQUE,
	password TEXT NOT NULL 
);

CREATE TABLE main.admins
(
	id INT NOT NULL PRIMARY KEY 
	REFERENCES main.users ON UPDATE CASCADE ON DELETE CASCADE	 
);

CREATE TABLE main.researches
(
	id SERIAL NOT NULL PRIMARY KEY,
	name TEXT NOT NULL,
	published TIMESTAMP NOT NULL,
	size DECIMAL NOT NULL,
	is_abroad BOOL NOT NULL DEFAULT FALSE,
	is_scopus BOOL NOT NULL DEFAULT FALSE,
	is_vak BOOL NOT NULL DEFAULT FALSE,
	UNIQUE(name, published)
);

CREATE TABLE main.research_authors 
(
	id SERIAL NOT NULL PRIMARY KEY,
	research INT NOT NULL REFERENCES main.researches
	ON UPDATE CASCADE ON DELETE CASCADE,
	author INT NOT NULL REFERENCES main.department_staff
	ON UPDATE CASCADE ON DELETE CASCADE,
	bulk DECIMAL NOT NULL,
	UNIQUE(research, author)	 
);

CREATE TABLE main.research_check
(
	id SERIAL NOT NULL PRIMARY KEY,
	research INT NOT NULL REFERENCES main.researches
	ON UPDATE CASCADE ON DELETE CASCADE,
	checker INT NOT NULL REFERENCES main.admins
	ON UPDATE CASCADE ON DELETE CASCADE,
	check_date TIMESTAMP NOT NULL DEFAULT current_timestamp
);


