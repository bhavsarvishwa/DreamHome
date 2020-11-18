
DROP TABLE IF EXISTS listings CASCADE;

DROP SEQUENCE if exists listing_id_seq;
CREATE SEQUENCE listing_id_seq;
SELECT setval('listing_id_seq', 10000);
GRANT all on SEQUENCE listing_id_seq to group17_admin;

CREATE TABLE listings(
	listing_id INT NOT NULL PRIMARY KEY default nextval('listing_id_seq'),
	user_id VARCHAR(32) NOT NULL REFERENCES users (user_id),
	listing_status VARCHAR(2) NOT NULL,
	price NUMERIC NOT NULL,
	headline VARCHAR(100) NOT NULL,
	description VARCHAR(1000) NOT NULL,
	postal_code CHAR(6) NOT NULL,
	images SMALLINT NOT NULL DEFAULT 0,
	city INT NOT NULL,
	property_options INT NOT NULL,
	property_type INT NOT NULL,
	bedrooms INT NOT NULL,
	bathrooms INT NOT NULL,
	-- PLUS 6 more
	parking_spaces INT DEFAULT 0 NOT NULL,
	land_size INT NOT NULL DEFAULT 0,
	floor_space INT NOT NULL DEFAULT 0,
	fireplace INT NOT NULL DEFAULT 0,
	storeys INT NOT NULL DEFAULT 0,
	built_in INT NOT NULL DEFAULT 0,
	basement_type VARCHAR(30) NOT NULL,
	heating_type VARCHAR(30) NOT NULL
);



ALTER TABLE listings OWNER TO group17_admin;

INSERT INTO listings (listing_id, user_id, listing_status, price, headline, description, postal_code,
			images, city, property_options, property_type, bedrooms, bathrooms, parking_spaces, land_size, floor_space,
			fireplace, storeys, built_in, basement_type, heating_type)
			VALUES (nextval('listing_id_seq'), 'johnsmith', 'O', 800000, 'Freehold', 'Single Family', 'L7Y4E3', 0,
			10, 1, 1, 4, 3, 4, 3400, 2800, 1, 3, 1990, 'Finished', 'Forced Air');

SELECT * FROM listings;
