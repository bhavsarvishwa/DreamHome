
DROP TABLE IF EXISTS storeys CASCADE;

CREATE TABLE storeys(
	value SMALLINT PRIMARY KEY,
	property VARCHAR(10) NOT NULL
);
ALTER TABLE storeys OWNER TO group17_admin;

INSERT INTO storeys(value, property) VALUES(
	1, '1 storey'
);
INSERT INTO storeys(value, property) VALUES(
	2, '2 storeys'
);
INSERT INTO storeys(value, property) VALUES(
	4, '3 storeys'
);
INSERT INTO storeys(value, property) VALUES(
	8, '4 storeys'
);


SELECT * FROM storeys;
