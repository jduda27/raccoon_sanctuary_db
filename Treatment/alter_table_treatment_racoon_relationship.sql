ALTER TABLE Treatment
    ADD Racoon_ID INT,
    ADD FOREIGN KEY (Racoon_ID) REFERENCES Racoon(Racoon_ID);