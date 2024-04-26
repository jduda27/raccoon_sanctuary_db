ALTER TABLE Employee
    ADD address_id INT NOT NULL,
    ADD shift_id INT,
    ADD role_id INT NOT NULL,
    ADD FOREIGN KEY (address_id) REFERENCES Address(address_id),
    ADD FOREIGN KEY (shift_id) REFERENCES Shift(shift_id),
    ADD FOREIGN KEY (role_id) REFERENCES Responsibility(role_id);