
DROP TABLE IF EXISTS bathrooms CASCADE;

CREATE TABLE bathrooms(
	value  SMALLINT PRIMARY KEY,
	property VARCHAR(15) NOT NULL
);
ALTER TABLE bathrooms OWNER TO group17_admin;

INSERT INTO bathrooms(value, property) VALUES(
	1, '1 bathroom'
);
INSERT INTO bathrooms(value, property) VALUES(
	2, '2 bathrooms'
);
INSERT INTO bathrooms(value, property) VALUES(
	4, '3 bathrooms'
);
INSERT INTO bathrooms(value, property) VALUES(
	8, '4 bathrooms'
);
INSERT INTO bathrooms(value, property) VALUES(
	16, '5 bathrooms'
);
INSERT INTO bathrooms(value, property) VALUES(
	32, '6 bathrooms'
);
INSERT INTO bathrooms(value, property) VALUES(
	64, '7 bathrooms'
);
INSERT INTO bathrooms(value, property) VALUES(
	128, '8 bathrooms'
);
INSERT INTO bathrooms(value, property) VALUES(
	256, '9 bathrooms'
);
INSERT INTO bathrooms(value, property) VALUES(
	512, '10 bathrooms'
);

SELECT * FROM bathrooms;
