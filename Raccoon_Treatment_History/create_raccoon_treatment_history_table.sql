CREATE TABLE Raccoon_Treatment_History(
    raccoon_id INT NOT NULL,
    treatment_id INT,
    treatment_time DATETIME NOT NULL,
    FOREIGN KEY (raccoon_id) REFERENCES Raccoon(raccoon_id),
    FOREIGN KEY (treatment_id) REFERENCES Treatment(treatment_id),
    PRIMARY KEY (raccoon_id,treatment_id,treatment_time)
);