ALTER TABLE Raccoon_Treatment_History
    ADD raccoon_id INT NOT NULL,
    ADD treatment_id INT,
    ADD FOREIGN KEY (raccoon_id) REFERENCES Raccoon(raccoon_id),
    ADD FOREIGN KEY (treatment_id) REFERENCES Treatment(treatment_id),
    DROP PRIMARY KEY,
    ADD PRIMARY KEY (raccoon_id,treatment_id,treatment_time)