
DROP TABLE IF EXISTS users CASCADE;

CREATE TABLE users(
	user_id VARCHAR(50) PRIMARY KEY,
	password VARCHAR(32) NOT NULL,
	email_address VARCHAR(256) NOT NULL,
	user_type VARCHAR(2) NOT NULL,
	enrol_date DATE NOT NULL,
	last_access DATE NOT NULL
);
ALTER TABLE users OWNER TO group17_admin;

INSERT INTO users VALUES(
	'abala',
	md5('password1'),
	'abala@dcmail.ca',
	's',
	'2017-1-1',
	'2018-2-2');
INSERT INTO users(user_id, password, email_address, user_type,
 enrol_date, last_access) VALUES(
	'johnsmith',
	md5('password2'),
	'jsmith@dcmail.ca',
	'a',
	'2017-1-1',
	'2018-2-2');
INSERT INTO users(user_id, password, email_address, user_type,
 enrol_date, last_access) VALUES(
	'marysmith',
	md5('password3'),
	'msmith@dcmail.ca',
	'c',
	'2017-1-1',
	'2018-2-2');
INSERT INTO users VALUES(
	'samclark',
	md5('password4'),
	'samc@dcmail.ca',
	'p',
	'2017-1-1',
	'2018-2-2');
INSERT INTO users VALUES(
	'savaliyad',
	md5('password5'),
	'savaliyad@dcmail.ca',
	'a',
	'2016-1-1',
	'2018-2-2');

INSERT INTO users VALUES(
	'savaliyan',
	md5('password6'),
	'savaliyan@dcmail.ca',
	'pa',
	'2018-1-1',
	'2018-2-2');

SELECT * FROM users;
