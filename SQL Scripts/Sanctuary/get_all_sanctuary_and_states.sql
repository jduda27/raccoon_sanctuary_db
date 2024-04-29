SELECT Sanctuary.sanctuary_name as Sanctuary_Name, Address.state as State
	FROM Sanctuary
    RIGHT OUTER JOIN Address
    ON Sanctuary.address_id=Address.address_id
    ORDER BY State;