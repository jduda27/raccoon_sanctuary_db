ALTER TABLE Treatment
    ADD role_id INT NOT NULL,
    ADD FOREIGN KEY (role_id) REFERENCES Responsibility(role_id);