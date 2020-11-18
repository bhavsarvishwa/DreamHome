
DROP TABLE IF EXISTS persons CASCADE;

CREATE TABLE persons(
	user_id VARCHAR(32) NOT NULL,
	salutation VARCHAR(10),
	first_name VARCHAR(128) NOT NULL,
	last_name VARCHAR(128) NOT NULL,
	street_address1 VARCHAR(128) NULL,
	street_address2 VARCHAR(128) NULL,
	city VARCHAR(64) NULL,
	province VARCHAR(2) NULL,
	postal_code VARCHAR(6) NULL,
	primary_phone_number VARCHAR(15) NOT NULL,
	secondary_phone_number VARCHAR(15) NULL,
	fax_number VARCHAR(15) NULL,
	preferred_contact_method CHAR(1) NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(user_id)
);

ALTER TABLE persons OWNER TO group17_admin;

INSERT INTO persons VALUES('bhavsarv', 'Ms.', 'Vishwa', 'Bhavsar', '24 Samual Street', '',
					 'Whitby',
					'ON',
					'L3T26Y',
					'(416)-333-4444',
					'(905)-111-2222',
					'',
					'e');

SELECT * FROM persons;
