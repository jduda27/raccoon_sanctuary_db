ALTER TABLE Raccoon
    ADD enclosure_id INT NOT NULL,
    ADD FOREIGN KEY (enclosure_id) REFERENCES Enclosure(enclosure_id);