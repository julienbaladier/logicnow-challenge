CREATE DATABASE logicnow
	CHARACTER SET 'utf8'
	COLLATE 'utf8_bin';

USE logicnow;

CREATE TABLE contact (
	id INT PRIMARY KEY,
	first_name VARCHAR(100) NOT NULL,
	last_name VARCHAR(100) NOT NULL
) ENGINE=InnoDB;