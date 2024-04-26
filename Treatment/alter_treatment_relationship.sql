ALTER TABLE Treatment
    ADD role_id INT NOT NULL,
    ADD FOREIGN KEYd (role_id) REFERENCES Responsibility(role_id);