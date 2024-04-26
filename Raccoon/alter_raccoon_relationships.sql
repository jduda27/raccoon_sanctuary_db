ALTER TABLE Raccoon
    ADD treatment_id INT,
    ADD enclosure_id INT,
    ADD FOREIGN KEY (treatment_id) REFERENCES Raccoon_Treatment_History(treatment_id),
    ADD FOREIGN KEY (enclosure_id) REFERENCES Enclosure(enclosure_id);