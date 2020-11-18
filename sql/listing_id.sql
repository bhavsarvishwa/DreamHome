SELECT listings.listing_id FROM listings 
WHERE 1 = 1 AND (listings.city = 4 OR listings.city = 8 OR listings.city = 64) 
AND (listings.bedrooms = 16 OR listings.bedrooms = 32) 
AND (listings.property_type = 2 OR listings.property_type = 8 OR listings.property_type = 128) 
AND listings.price >= 125000 AND listings.price <= 300000 
AND listings.listing_status = 'o'
ORDER BY listings.listing_id DESC LIMIT 200	