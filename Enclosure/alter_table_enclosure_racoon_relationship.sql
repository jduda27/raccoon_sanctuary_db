ALTER TABLE Enclosure
    ADD Racoon_ID int,
    ADD FOREIGN KEY (Racoon_ID) REFERENCES Racoon(Racoon_ID);