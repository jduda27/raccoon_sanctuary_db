ALTER TABLE Enclosure
    ADD Raccoon_ID int,
    ADD FOREIGN KEY (Raccoon_ID) REFERENCES Raccoon(Raccoon_ID);