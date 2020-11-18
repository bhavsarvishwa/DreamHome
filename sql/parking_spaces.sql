
DROP TABLE IF EXISTS parking_spaces CASCADE;

CREATE TABLE parking_spaces(
	value SMALLINT PRIMARY KEY,
	property VARCHAR(25) NOT NULL
);
ALTER TABLE parking_spaces OWNER TO group17_admin;

INSERT INTO parking_spaces(value, property) VALUES(
	1, '1 parking space'
);
INSERT INTO parking_spaces(value, property) VALUES(
	2, '2 parking spaces'
);
INSERT INTO parking_spaces(value, property) VALUES(
	4, '3 parking spaces'
);
INSERT INTO parking_spaces(value, property) VALUES(
	8, '4 parking spaces'
);
INSERT INTO parking_spaces(value, property) VALUES(
	16, '5 parking spaces'
);
INSERT INTO parking_spaces(value, property) VALUES(
	32, '6 parking spaces'
);
INSERT INTO parking_spaces(value, property) VALUES(
	64, '7 parking spaces'
);
INSERT INTO parking_spaces(value, property) VALUES(
	128, '8 parking spaces'
);
INSERT INTO parking_spaces(value, property) VALUES(
	256, '9 parking spaces'
);
INSERT INTO parking_spaces(value, property) VALUES(
	512, '10 parking spaces'
);

SELECT * FROM parking_spaces;
