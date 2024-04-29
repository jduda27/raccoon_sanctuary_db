ALTER TABLE Sanctuary
    ADD address_id INT,
    ADD FOREIGN KEY (address_id) REFERENCES Address(address_id);