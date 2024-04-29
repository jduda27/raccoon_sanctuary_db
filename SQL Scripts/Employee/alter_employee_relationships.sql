ALTER TABLE Employee
    ADD address_id INT NOT NULL,
    ADD role_id INT NOT NULL,
    ADD FOREIGN KEY (address_id) REFERENCES Address(address_id),
    ADD FOREIGN KEY (role_id) REFERENCES Role(role_id);