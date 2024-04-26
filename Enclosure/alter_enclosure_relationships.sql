ALTER TABLE Enclosure
    ADD storage_id INT,
    ADD raccoon_id INT,
    ADD FOREIGN KEY (storage_id) REFERENCES Storage_Room(storage_id),
    ADD FOREIGN KEY (raccoon_id) REFERENCES Raccoon(raccoon_id);