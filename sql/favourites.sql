
DROP TABLE IF EXISTS favourites CASCADE;

CREATE TABLE favourites(
	user_id VARCHAR(20) NOT NULL REFERENCES users (user_id),
	listing_id INT NOT NULL REFERENCES listings (listing_id)
);

ALTER TABLE favourites OWNER TO group17_admin;

INSERT INTO favourites(user_id, listing_id) VALUES(
	'savaliyad', 11505
);


SELECT * FROM favourites;
