ALTER TABLE Treatment
    ADD Raccoon_ID INT,
    ADD FOREIGN KEY (Raccoon_ID) REFERENCES Raccoon(Raccoon_ID);