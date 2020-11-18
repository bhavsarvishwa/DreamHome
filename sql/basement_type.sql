
DROP TABLE IF EXISTS basement_type CASCADE;

CREATE TABLE basement_type(
	value  SMALLINT PRIMARY KEY,
	property VARCHAR(40) NOT NULL
);
ALTER TABLE basement_type OWNER TO 	group17_admin;

INSERT INTO basement_type(value, property) VALUES(
	1, 'Unfinished'
);
INSERT INTO basement_type(value, property) VALUES(
	2, 'Finished '
);
INSERT INTO basement_type(value, property) VALUES(
	4, 'Partially finished'
);
INSERT INTO basement_type(value, property) VALUES(
	8, 'Fully finished basement'
);

SELECT * FROM basement_type;
