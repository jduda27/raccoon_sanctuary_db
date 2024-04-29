ALTER TABLE Storage_Room
    ADD supply_id INT,
    ADD FOREIGN KEY (supply_id) REFERENCES Supply(supply_id);