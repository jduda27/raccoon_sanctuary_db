ALTER TABLE Role
    ADD responsibility_id INT NOT NULL,
    ADD treatment_id INT,
    ADD FOREIGN KEY (treatment_id) REFERENCES Treatment(treatment_id),
    ADD FOREIGN KEY (responsibility_id) REFERENCES Responsibility(responsibility_id)