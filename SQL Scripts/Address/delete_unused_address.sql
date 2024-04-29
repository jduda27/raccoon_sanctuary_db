DELETE FROM Address
WHERE address_id NOT IN (SELECT address_id FROM Sanctuary) OR (SELECT address_id FROM Employee);
