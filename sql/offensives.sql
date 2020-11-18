
DROP TABLE IF EXISTS offensives CASCADE;

CREATE TABLE offensives(
	user_id VARCHAR(20) NOT NULL REFERENCES users (user_id),
	listing_id INT NOT NULL REFERENCES listings (listing_id),
	reported_on DATE NOT NULL,
	status CHAR(1) NOT NULL,
	PRIMARY KEY (user_id, listing_id)
);

ALTER TABLE offensives OWNER TO group17_admin;

INSERT INTO offensives(user_id, listing_id, reported_on, status) VALUES(
	'simlera', 10003, '2018-01-12', 'c');

SELECT * FROM offensives;
