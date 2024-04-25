ALTER TABLE Raccoon
    ADD Treatment_ID INT,
    ADD FOREIGN KEY (Treatment_ID) REFERENCES Treatment(Treatment_ID);