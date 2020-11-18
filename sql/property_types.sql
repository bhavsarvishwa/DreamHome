
DROP TABLE IF EXISTS property_types;

CREATE TABLE property_types(
value INT PRIMARY KEY,
property VARCHAR(30) NOT NULL
);

ALTER TABLE property_types OWNER TO group17_admin;

INSERT INTO property_types (value, property) VALUES (1, 'Detached ');

INSERT INTO property_types (value, property) VALUES (2, 'Townhouse');

INSERT INTO property_types (value, property) VALUES (4, 'Bungalow');

INSERT INTO property_types (value, property) VALUES (8, 'Semi-Detached');

INSERT INTO property_types (value, property) VALUES (16, 'Cottage');


SELECT * FROM property_types;
