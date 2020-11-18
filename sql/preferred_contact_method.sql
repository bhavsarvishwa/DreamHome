
DROP TABLE IF EXISTS preferred_contact_method CASCADE;

CREATE TABLE preferred_contact_method(
	value SMALLINT PRIMARY KEY,
	property VARCHAR(30) NOT NULL
);
ALTER TABLE preferred_contact_method OWNER TO group17_admin;

INSERT INTO preferred_contact_method(value, property) VALUES(
	1, 'E-mail'
);
INSERT INTO preferred_contact_method(value, property) VALUES(
	2, 'Phone Call'
);
INSERT INTO preferred_contact_method(value, property) VALUES(
	4, 'Letter Post'
);
SELECT * FROM preferred_contact_method;
