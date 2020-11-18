
DROP TABLE IF EXISTS prices CASCADE;

CREATE TABLE prices(
	value  SMALLINT PRIMARY KEY,
	property int NOT NULL
);
ALTER TABLE prices OWNER TO group17_admin;

INSERT INTO prices(value, property) VALUES(
	1, 0
);
INSERT INTO prices(value, property) VALUES(
	2, 100000
);
INSERT INTO prices(value, property) VALUES(
	4, 200000
);
INSERT INTO prices(value, property) VALUES(
	8, 300000
);
INSERT INTO prices(value, property) VALUES(
	16, 400000
);
INSERT INTO prices(value, property) VALUES(
	32, 500000
);
INSERT INTO prices(value, property) VALUES(
	64, 600000
);
INSERT INTO prices(value, property) VALUES(
	128, 700000
);
INSERT INTO prices(value, property) VALUES(
	256, 800000
);
INSERT INTO prices(value, property) VALUES(
	512, 800000
);
INSERT INTO prices(value, property) VALUES(
	1024, 900000
);
INSERT INTO prices(value, property) VALUES(
	2048, 1000000
);

SELECT * FROM prices;
