
DROP TABLE IF EXISTS bedrooms CASCADE;

CREATE TABLE bedrooms(
	value  SMALLINT PRIMARY KEY,
	property VARCHAR(15) NOT NULL
);
ALTER TABLE bedrooms OWNER TO group17_admin;

INSERT INTO bedrooms(value, property) VALUES(
	1, '1 bedroom'
);
INSERT INTO bedrooms(value, property) VALUES(
	2, '2 bedrooms'
);
INSERT INTO bedrooms(value, property) VALUES(
	4, '3 bedrooms'
);
INSERT INTO bedrooms(value, property) VALUES(
	8, '4 bedrooms'
);
INSERT INTO bedrooms(value, property) VALUES(
	16, '5 bedrooms'
);
INSERT INTO bedrooms(value, property) VALUES(
	32, '6 bedrooms'
);
INSERT INTO bedrooms(value, property) VALUES(
	64, '7 bedrooms'
);
INSERT INTO bedrooms(value, property) VALUES(
	128, '8 bedrooms'
);
INSERT INTO bedrooms(value, property) VALUES(
	256, '9 bedrooms'
);
INSERT INTO bedrooms(value, property) VALUES(
	512, '10 bedrooms'
);

SELECT * FROM bedrooms;
