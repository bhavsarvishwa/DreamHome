
DROP TABLE IF EXISTS salutations;

CREATE TABLE salutations(
	value CHAR(6)
);

ALTER TABLE salutations OWNER TO group17_admin;

INSERT INTO salutations VALUES ('Mr.');
INSERT INTO salutations VALUES ('Mrs.');
INSERT INTO salutations VALUES ('Miss');
INSERT INTO salutations VALUES ('Ms.');
INSERT INTO salutations VALUES ('Master');


SELECT * FROM salutations;
