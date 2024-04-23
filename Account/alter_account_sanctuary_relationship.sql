ALTER TABLE Account
    ADD Sanctuary_ID int,
    ADD FOREIGN KEY (Sanctuary_ID) REFERENCES Sanctuary(Sanctuary_ID);