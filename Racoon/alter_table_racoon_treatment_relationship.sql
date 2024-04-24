ALTER TABLE Racoon
    ADD Treatment_ID INT,
    ADD FOREIGN KEY (Treatment_ID) REFERENCES Treatment(Treatment_ID);