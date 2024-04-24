ALTER TABLE Employee
    ADD Sanctuary_ID INT NOT NULL,
    ADD FOREIGN KEY (Sanctuary_ID) REFERENCES Sanctuary(Sanctuary_ID);