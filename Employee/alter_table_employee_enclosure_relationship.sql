ALTER TABLE Employee
    ADD Enclosure_ID INT,
    ADD FOREIGN KEY (Enclosure_ID) REFERENCES Enclosure(Enclosure_ID);